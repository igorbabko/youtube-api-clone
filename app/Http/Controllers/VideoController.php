<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $period = Period::tryFrom(request('period'));

        return Video::fromPeriod($period)->get();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
