<?php

namespace App\Http\Controllers\Backend\Raid;

use App\Http\Controllers\Controller;
use App\Models\Raid;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Discord\Discord as Discord;
use Discord\WebSockets\WebSocket as WebSocket;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class RaidController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        // Get the most recent 20 raids

        // TODO: Do some kind of analysis and/or viewing of all the old raids

        $raids = Raid::orderBy('created_at', 'DESC')->limit(20)->get();

        return view('backend.raid.index')
                ->with('raids', $raids);
    }

    public function create() {
        return view('backend.raid.createOrEdit');
    }

    public function store(Request $request) {
        // Add a raid to the db
        $raid = new Raid;

        $raid->title = $request['title'];
        $raid->location = $request['location'];

        $time = Carbon::createFromFormat('Y-m-d', $request['date']);
        $time->hour = 19;
        $time->minute = 0;
        $time->second = 0;

        $raid->date = $time->toDateTimeString();

        $raid->description = $request['description'];

        // Create

        if ($raid->save()) {

            $bot_id = env('DISCORD_BOT_ID');

            // Send message to Discord with the raid details
            $discord = new Discord($bot_id);
            $guild = $discord->guilds->get('id', '208102490422378496');
            $channel = $guild->channels->get('id', '208114703426125825');

            $url = 'http://wwwguild.com/raids/'.$raid->id.'-'.str_slug($raid->title, '-');
            $message = "**Raid Posted:** ". $raid->title . " - ". $raid->description . " " .$url;

            $channel->sendMessage($message);

            return redirect()->route('admin.raid.index')->withFlashSuccess('Raid created.');
        }

        throw new GeneralException('Computer says no. Check the logs.');
    }

    public function edit($id) {
        $raid = Raid::find($id);
        return view('backend.raid.createOrEdit')->with('raid', $raid);
    }

    public function update(Request $request, $id) {

        $raid = Raid::find($id);

        $raid->title = $request->input('title');
        $raid->location = $request->input('location');

        $time = Carbon::createFromFormat('Y-m-d', $request->input('date'));
        $time->hour = 19;
        $time->minute = 0;
        $time->second = 0;

        $raid->date = $time->toDateTimeString();

        $raid->description = $request->input('description');

        // save that mofo
        if ($raid->save()) {
            return redirect()->route('admin.raid.index')->withFlashSuccess('Raid updated.');
        }

        throw new GeneralException('Computer says no. Check the logs.');
    }

    public function destroy($id) {
        $raid = Raid::find($id);
        // Delete any signs associated with this raid
        $raid->signs()->delete();
        // Delete the raid itself
        $raid->delete();
        // Send them back to start.
        return redirect()->route('admin.raid.index')->withFlashSuccess('Raid deleted.');
    }
}
