<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ImageController extends Controller
{

    private function findImage($id) {

        $path = storage_path('app/public/news/'.$id);

        if(file_exists($path.'.jpg')) {
            return $path.'.jpg';
        } elseif (file_exists($path.'.png')) {
            return $path.'.png';
        } else {
            return false;
        }
    }

    public function show($id)
    {
        // Load the specified image from storage and show it
        $image = $this->findImage($id);

        return \Image::make($image)->response();

    }

    public function blur($id) {

        $path = $this->findImage($id);

        $cache = \Image::cache(function($image) use ($path) {
            return $image->make($path)->blur(35);
        }, 999999, true);

        return $cache->response();
    }

    public function small($id) {
        $path = $this->findImage($id);

        $cache = \Image::cache(function($image) use ($path) {
            return $image->make($path)->fit(800, 460);
        }, 999999, true);

        return $cache->response();
    }
}
