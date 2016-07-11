<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Jleagle\BattleNet\Warcraft;
use App\Models\Access\Role\Role;

/**
 * Class FrontendController
 * @package App\Http\Controllers
 */
class FrontendController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        javascript()->put([
            'test' => 'it works!',
        ]);

        $warcraft = new Warcraft(
            env('BLIZZ_API_KEY'),
            'EU',
            'EN_GB'
        );

        $realms = $warcraft->getRealms();

        return view('frontend.index');
    }

    public function roster()
    {
        // Get the list of members of the raiders group and display them
        $users = Role::where('name', '=', 'Raider')->firstOrFail()->users;

        $tanks = $users->filter(function ($item) {
            if($item->character_role == 'tank') {
                return true;
            }
        });

        $healers = $users->filter(function ($item) {
            if($item->character_role == 'healer') {
                return true;
            }
        });

        $dps = $users->filter(function($item) {
            if($item->character_role != 'tank' && $item->character_role != 'healer') {
                return true;
            }
        });

        return view('frontend.roster')
            ->with('tanks', $tanks)
            ->with('healers', $healers)
            ->with('dps', $dps);


    }
}
