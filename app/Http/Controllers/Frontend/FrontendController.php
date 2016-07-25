<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Jleagle\BattleNet\Warcraft;
use App\Models\Access\Role\Role;
use App\Models\News;

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
        // Get the latest news post
        $latest_news = News::orderBy('created_at', 'desc')->first();

        // Get some other bits of news
        $news = News::orderBy('created_at', 'desc')->skip(1)->take(3)->get();

        return view('frontend.index')
                ->with('latest_news', $latest_news)
                ->with('news', $news);
    }

    public function roster()
    {
        // Get the list of members of the raiders group and display them
        $users = Role::where('name', '=', 'Raider')->firstOrFail()->users;

        $tanks = $users->filter(function ($item) {
            if($item->character_role == 'tank') {
                return true;
            }
        })->shuffle();

        $healers = $users->filter(function ($item) {
            if($item->character_role == 'healer') {
                return true;
            }
        })->shuffle();

        $dps = $users->filter(function($item) {
            if($item->character_role != 'tank' && $item->character_role != 'healer') {
                return true;
            }
        })->shuffle();

        return view('frontend.roster')
            ->with('tanks', $tanks)
            ->with('healers', $healers)
            ->with('dps', $dps);


    }
}
