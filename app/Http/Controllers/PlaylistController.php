<?php

namespace App\Http\Controllers;

use App\Models\Playlist;

class PlaylistController extends Controller
{
    public function index()
    {
        return Playlist::with(request('with', []))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'));
    }

    public function show(Playlist $playlist)
    {
        return $playlist->load(request('with', []));
    }
}
