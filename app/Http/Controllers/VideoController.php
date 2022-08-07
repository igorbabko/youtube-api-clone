<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $period = Period::tryFrom(request('period'));

        return Video::fromPeriod($period)
            ->search(request('query'))
            ->limit(request('limit'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->get();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
