<?php

namespace App\Http\Controllers\Backend\News;

use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class NewsController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        return view('backend.news.index');
    }

    public function create() {
        return view('backend.news.create');
    }
}
