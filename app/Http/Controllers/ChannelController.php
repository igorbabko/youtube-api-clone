<?php

namespace App\Http\Controllers;

use App\Models\Channel;

class ChannelController extends Controller
{
    public function index()
    {
        return Channel::withRelationships(request('with'))
            ->search(request('query'))
            ->orderBy(request('sort', 'name'), request('order', 'asc'))
            ->simplePaginate(request('limit'));
    }

    public function show(Channel $channel)
    {
        return $channel->loadRelationships(request('with'));
    }
}
