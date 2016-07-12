<?php

namespace App\Models\Access\User;

use App\Models\Access\User\Traits\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Access\User\Traits\Attribute\UserAttribute;
use App\Models\Access\User\Traits\Relationship\UserRelationship;

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
            $server_formatted = 'theSha\'tar';
        } else if($this->character_server == 'steamwheedle-cartel') {
            $server_formatted = 'SteamwheedleCartel';
        } else if($this->character_server == 'moonglade') {
            $server_formatted = 'Moonglade';
        }

        return '/invite '.$this->character_name.'-'.$server_formatted;
    }
}
