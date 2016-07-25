<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;
use App\Models\Raid;
use App\Models\Sign;
use Carbon\Carbon;

/**
 * Class User
 * @package App\Models\Access\User
 */
class User extends Authenticatable
{

    use SoftDeletes, UserAccess, UserAttribute, UserRelationship;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $appends = ['inviteMacro'];

    public function getInviteMacroAttribute()
    {
        if($this->character_server == 'the-shatar') {
            $server_formatted = 'TheSha\'tar';
        } else if($this->character_server == 'steamwheedle-cartel') {
            $server_formatted = 'SteamwheedleCartel';
        } else if($this->character_server == 'moonglade') {
            $server_formatted = 'Moonglade';
        }

        if(isset($server_formatted)) {
            return '/invite '.$this->character_name.'-'.$server_formatted;
        } else {
            return false;
        }
    }

    public function getPendingRaidsAttribute()
    {
        // Get list of raids in the future which the user has yet to sign to
        $now = Carbon::now();
        $raids = Raid::where('date', '>', $now)->get();

        if($raids) {
            $unresponded = 0;
            foreach($raids as $raid) {
                $responded = $raid->signs()
                                ->where('user_id', '=', access()->user()->id)
                                ->first();

                if(!$responded) {
                    $unresponded++;
                }
            }

            return $unresponded;
        } else {
            return false;
        }
    }
}
