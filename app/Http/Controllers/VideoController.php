<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $period = Period::tryFrom(request('period'));

        return Video::with(request('with', []))
            ->fromPeriod($period)
            ->search(request('query'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->simplePaginate(request('limit'));
    }

    public function show(Video $video)
    {
        return $video->load(request('with', []));
    }
}
