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
          ->paginate(request('limit')); // ->withQueryString();

        // ddd();

        // dd($paginator);
        // return $paginator->total();
        // return $paginator->perPage();
        // return $paginator->url(request('page'));

        // return $paginator;
    }

    public function show(Video $video)
    {
        return $video->load(request('with', []));
    }
}
