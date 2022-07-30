<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return Video::with('channel', 'categories')
          ->where('created_at', '>=', now()->startOfYear())
          // ->where('created_at', '>=', now()->startOfMonth())
          // ->where('created_at', '>=', now()->startOfWeek())
          // ->where('created_at', '>=', now()->startOfDay())
          // ->where('created_at', '>=', today())
          // ->where('created_at', '>=', now()->startOfHour())
          ->count();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
