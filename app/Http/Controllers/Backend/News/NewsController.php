<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;


/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class NewsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $news = News::orderBy('created_at', 'DESC')->limit(20)->get();

        return view('backend.news.index')
                ->with('news', $news);
    }

    public function create() {
        return view('backend.news.createOrEdit');
    }

    public function store(Request $request) {
        // Add a raid to the db

        $news = new News;

        $news->title = $request['title'];
        $news->content = $request['content'];

        $time = Carbon::createFromFormat('Y-m-d', $request['created_at']);
        $news->created_at = $time->toDateTimeString();

        // Create
        if ($news->save()) {

            // Upload the image
            $imageName = $news->id . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(
                storage_path('app/public/news/'), $imageName
            );

            return redirect()->route('admin.news.index')->withFlashSuccess('News created.');
        }

        throw new GeneralException('Computer says no. Check the logs.');
    }

    public function edit($id) {
        $news = News::find($id);
        return view('backend.news.createOrEdit')->with('news', $news);
    }

    public function update(Request $request, $id) {

        $news = News::find($id);

        $news->title = $request['title'];
        $news->content = $request['content'];

        $time = Carbon::createFromFormat('Y-m-d', $request['created_at']);
        $news->created_at = $time->toDateTimeString();

        // Save
        if ($news->save()) {

            if($request->file('image')) {

                // Upload the image
                $imageName = $news->id . '.' . $request->file('image')->getClientOriginalExtension();

                $request->file('image')->move(
                    storage_path('app/public/news/'), $imageName
                );
            }

            return redirect()->route('admin.news.index')->withFlashSuccess('News edited.');
        }

        throw new GeneralException('Computer says no. Check the logs.');
    }

    public function destroy($id) {
        $news = News::find($id);
        $news->delete();
        // Send them back to start.
        return redirect()->route('admin.news.index')->withFlashSuccess('News deleted.');
    }
}
