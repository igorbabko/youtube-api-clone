<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        switch (request('period')) {
            case 'year': $date = now()->startOfYear(); break;
            case 'month': $date = now()->startOfMonth(); break;
            case 'week': $date = now()->startOfWeek(); break;
            case 'day': $date = now()->startOfDay(); break;
            case 'hour': $date = now()->startOfHour(); break;
            default: $date = null;
        }

        return $date
            ? Video::where('created_at', '>=', $date)->get()
            : Video::get();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
