<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Slynova\Commentable\Models\Comment;
use Jleagle\BattleNet\Warcraft;
use App\Models\Access\Role\Role;
use App\Models\Raid;
use App\Models\Sign;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App;

class RaidController extends Controller
{
    public function index()
    {

        // Get the timestamp for today at midnight
        // Gives a chance for the evenings raids to still show up as "upcoming"
        // Even if we're past the start time technically.

        $time = Carbon::now();
        $time->hour = 0;
        $time->minute = 0;

        // Grab the upcoming raids
        $upcoming_raids = Raid::where('date', '>', $time)
                                ->orderBy('date', 'ASC')
                                ->get();

        // Grab the prior 6 raids - should be two weeks worth
        $past_raids = Raid::where('date', '<', $time)
                            ->orderBy('date', 'DESC')
                            ->get();

        return view('frontend.raid.index')
                ->with('upcoming_raids', $upcoming_raids)
                ->with('past_raids', $past_raids);
    }

    public function show($id)
    {
        // Shows a raid
        $raid = Raid::findOrFail($id);

        // Get all the raiders
        $users = Role::where('name', '=', 'Raider')->firstOrFail()->users;

        // Splice the users that have responded from the users list to get the
        // people who are yet to respond

        return view('frontend.raid.show')
                ->with('raid', $raid);
    }

    public function sign($id, $attending)
    {
        // This adjusts someones sign

        // Grab logged in user
        $user = access()->user();

        // Grab the raid we're going to be signing up to
        $raid = Raid::findOrFail($id);

        // Check if we're trying to attend a raid that is closed
        if($attending == '1' && !$raid->signsOpen) {
            throw new GeneralException('Sign ups are closed to this raid.');
        }


        // Add or update users sign for the raid
        $sign = Sign::firstOrCreate(['user_id' => $user->id, 'raid_id' => $id]);
        $sign->raid_id = $id;
        $sign->user_id = $user->id;
        $sign->role = $user->character_role;
        $sign->attending = $attending;

        if($sign->save()) {
            return back()->withFlashSuccess('Your response to the raid was successful.');
        } else {
            throw new GeneralException('Something went wrong when trying to sign you to the raid...');
        }

    }

    public function comment($id, Request $request)
    {
        $raid = Raid::findOrFail($id);

        $comment = new Comment;
        $comment->user_id = access()->user()->id;
        $comment->body = $request->input('body');

        $raid->comments()->save($comment);

        return back()->withFlashSuccess('Comment posted.');
    }

}
