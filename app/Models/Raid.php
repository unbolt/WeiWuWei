<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Slynova\Commentable\Traits\Commentable;
use App\Models\Access\Role\Role;
use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Cache;

class Raid extends Model
{
    use Commentable;

    protected $table;

    protected $guarded = ['id'];

    protected $dates = ['date', 'created_at', 'updated_at'];

    protected $appends = ['logID', 'log', 'hasResponded', 'raidStarted', 'signsOpen', 'totalSigns', 'tankCount', 'healerCount', 'dpsCount', 'signPercent', 'usersAttending', 'usersNotAttending', 'usersNotResponded'];

    public function signs()
    {
        return $this->hasMany('App\Models\Sign');
    }

    // MANY CUSTOM ATTRIBUTES BEYOND HERE

    // Private function to order signs by groups
    private function orderGroups($groups)
    {
        $order = array('tank', 'healer', 'rdps', 'mdps');

        $groups = $groups->sort(function ($a, $b) use ($order) {
            $pos_a = array_search($a->role, $order);
            $pos_b = array_search($b->role, $order);
            return $pos_a - $pos_b;
        });

        return $groups;
    }

    public function getLogIDAttribute()
    {
        // This function checks the Warcraft Logs API
        // to see if there is a log for this raid.

        // If there is, it caches the log ID for a month and returns it.
        // Otherwise it returns false.

        $logID = Cache::get('log_id_'.$this->id, function() {
            $date = $this->date; // This is 7pm the day of the raid

            // We add 3 0's on the end because WL uses milisecond precision on a UNIX timestamp for some reason.
            $start = $this->date->subHours(2)->timestamp.'000'; // Give ourselves a start window
            $end = $this->date->addHours(5)->timestamp.'000'; // If a raid lasts longer than this I'll top myself

            // We have ourselves a search window, let's use it.

            if($this->date > Carbon::now()) {

                // The raid hasn't started yet, there won't be a log

                return false;

            } else {

                // The raid is going on already

                $api_key = env('WARCRAFT_LOGS_API_KEY');

                $client = new GuzzleHttpClient();

                $url = 'https://www.warcraftlogs.com:443/v1/reports/guild/Wei%20Wu%20Wei/the-shatar/EU?start='.$start.'&end='.$end.'&api_key='.$api_key;

                $request = $client->request('GET', $url, ['verify' => true]);

                if($request->getStatusCode() == 200) {

                    $results = json_decode($request->getBody());

                    if($results) {
                        foreach($results as $result) {
                            $expiresAt = Carbon::now()->addDays(7);
                            Cache::put('log_id_'.$this->id, $result->id, $expiresAt);

                            return $result->id;
                        }
                    } else {

                        // No results yet, check how long ago the raid started at

                        if($this->date->diffInHours(Carbon::now()) > 5) {
                            // This happened a while ago, cache a null result for a week
                            $expiresAt = Carbon::now()->addDays(7);
                        } else {
                            // Could still be a log, cache it for 30 mins
                            $expiresAt = Carbon::now()->addMinutes(30);
                        }

                        Cache::put('log_id_'.$this->id, 'null', $expiresAt);
                    }

                } else {
                    return false;
                }
            }

        });

        if($logID && $logID != 'null') {
            return $logID;
        } else {
            return false;
        }
    }

    public function getLogAttribute()
    {
        // Pretty much the same as the log ID except it retrieves all the fights

        $log = Cache::get('log_'.$this->id, function() {

            $api_key = env('WARCRAFT_LOGS_API_KEY');

            $client = new GuzzleHttpClient();

            $url = 'https://www.warcraftlogs.com:443/v1/report/fights/'.$this->logID.'?api_key='.$api_key;

            $request = $client->request('GET', $url, ['verify' => true]);

            if($request->getStatusCode() == 200) {

                $results = json_decode($request->getBody());

                // If the raid hasn't finished yet then only cache the log for 10 mins
                $raid_end = $this->date->addHours(3);

                if($raid_end > Carbon::now()) {
                    $expiresAt = Carbon::now()->addMinutes(10);
                } else {
                    $expiresAt = Carbon::now()->addDays(7);
                }

                Cache::put('log_'.$this->id, $results, $expiresAt);

                return $results;

            } else {
                return false;
            }
        });

        if($log) {
            return $log;
        } else {
            return false;
        }
    }

    public function getHasRespondedAttribute()
    {
        // Find out if the currently auth'd user has
        // responded to a raid or not, this is for displaying and
        // not for internal checks. Obviously.
        $responded = $this->signs()
                        ->where('user_id', '=', access()->user()->id)
                        ->first();

        if($responded) {
            return true;
        } else {
            return false;
        }
    }

    public function getSignsOpenAttribute()
    {
        // Find out if a raid is open for signs
        // Deduct 10 hours off the raid time, if that is in the future
        // people are allowed to sign. If not, throw ice cream in their faces.
        $now = Carbon::now();

        // THIS AFFECTS EVERYTHING!
        $time = $this->date->subHours(10);

        if($time > $now) {
            return true;
        } else {
            return false;
        }
    }

    public function getRaidStartedAttribute()
    {
        $now = Carbon::now();

        if($this->date > $now) {
            return true;
        } else {
            return false;
        }
    }

    public function getTotalSignsAttribute()
    {
        return count($this->signs()->where('attending', 1)->get());
    }

    public function getTankCountAttribute()
    {
        $tanks = $this->signs()
                        ->where('role', '=', 'tank')
                        ->where('attending', 1)
                        ->get();
        return count($tanks);
    }

    public function getHealerCountAttribute()
    {
        $healers = $this->signs()
                        ->where('role', '=', 'healer')
                        ->where('attending', 1)
                        ->get();
        return count($healers);
    }

    public function getDpsCountAttribute()
    {
        $dps = $this->signs()
                    ->where('role', '!=', 'healer')
                    ->where('role', '!=', 'tank')
                    ->where('attending', 1)
                    ->get();
        return count($dps);
    }

    public function getUsersAttendingAttribute()
    {
        $return = array();

        $attending = $this->signs()
                        ->where('attending', 1)
                        ->orderBy('role', 'DESC')
                        ->get();

        $attending = $this->orderGroups($attending);

        foreach($attending as $item) {
            $return[$item->role][] = $item->user;
        }

        return $return;
    }

    public function getUsersNotAttendingAttribute()
    {
        $return = array();

        $notAttending = $this->signs()
                            ->where('attending', 0)
                            ->get();

        $notAttending = $this->orderGroups($notAttending);

        foreach($notAttending as $item) {
            $return[$item->role][] = $item->user;
        }

        return $return;
    }

    public function getUsersNotRespondedAttribute()
    {
        // Get ID of everyone who has responded
        $responded = $this->signs()->pluck('user_id')->toArray();

        // Get the raiders with the above people excluded
        $notresponded = Role::where('name', '=', 'Raider')->firstOrFail()->users()->whereNotIn('users.id', $responded)->get();

        return $notresponded;
    }

    public function getSignPercentAttribute()
    {
        $signs = $this->totalSigns;

        if($signs >= 20) {
            return '100';
        } else {
            return round(($signs / 20) * 100);
        }
    }

}
