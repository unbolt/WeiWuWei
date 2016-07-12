<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Slynova\Commentable\Traits\Commentable;
use App\Models\Access\Role\Role;
use Carbon\Carbon;

class Raid extends Model
{
    use Commentable;

    protected $table;

    protected $guarded = ['id'];

    protected $dates = ['date', 'created_at', 'updated_at'];

    protected $appends = ['raidStarted', 'signsOpen', 'totalSigns', 'tankCount', 'healerCount', 'dpsCount', 'signPercent', 'usersAttending', 'usersNotAttending', 'usersNotResponded'];

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
