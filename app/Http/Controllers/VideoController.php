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
          ->where(function ($query) {
              $query->where('title', 'like', '%'.request('query').'%')
                  ->orWhere('description', 'like', '%'.request('query').'%');
          })
          ->limit(request('limit'))
          // ->take(request('limit))
          ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
          // ->oldest()
          // ->dd()
          ->get();
    }

    public function show(Video $video)
    {
        return $video->load('channel', 'categories');
    }
}
