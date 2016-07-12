<?php

namespace App\Http\Controllers\Backend\Raid;

use App\Http\Controllers\Controller;
use App\Models\Raid;
use Illuminate\Http\Request;
use Carbon\Carbon;


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
        return view('backend.raid.index');
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
}