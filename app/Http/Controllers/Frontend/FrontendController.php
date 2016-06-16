<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Jleagle\BattleNet\Warcraft;

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
}
