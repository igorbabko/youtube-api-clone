<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return Video::with('channel', 'categories')->get();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
