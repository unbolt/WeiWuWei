<?php

namespace App\Http\Controllers\Frontend\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use Jleagle\BattleNet\Warcraft;
use App;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Frontend
 */
class ProfileController extends Controller
{
    /**
     * @return mixed
     */
    public function edit()
    {
        return view('frontend.user.profile.edit')
            ->withUser(access()->user());
    }

    /**
     * @param  UserRepositoryContract         $user
     * @param  UpdateProfileRequest $request
     * @return mixed
     */
    public function update(UserRepositoryContract $user, UpdateProfileRequest $request)
    {
        $user->updateProfile(access()->id(), $request->all());
        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(trans('strings.frontend.user.profile_updated'));
    }

    /**
     * -- Character Search function
     * -- Accepts a character name and a realm and searches for that character on the armoury
     *
     **/
     public function characterSearch($server, $name)
     {
         $warcraft = new Warcraft(
             env('BLIZZ_API_KEY'),
             'eu',
             'en_GB'
         );

         if($warcraft) {
             $character = $warcraft->getCharacter($server, $name, ['audit']);

             print_r($character);
             die();

             return response()->json($character);
         }


     }


}
