<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::withRelationships(request('with'))
            ->fromPeriod(Period::tryFrom(request('period')))
            ->search(request('query'))
            ->orderBy(request('sort', 'created_at'), request('order', 'desc'))
            ->simplePaginate(request('limit'));
    }

    public function show(Comment $comment)
    {
        return $comment->loadRelationships(request('with'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'text' => 'required|string',
            'parent_id' => 'exists:comments,id',
            'video_id' => 'required_without:parent_id|exists:videos,id',
        ]);

        return Comment::create($attributes);
    }

    public function update(Comment $comment, Request $request)
    {
        Gate::allowIf(fn (User $user) => $comment->isOwnedBy($user));

        $attributes = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->fill($attributes)->save();
    }

    public function destroy(Comment $comment)
    {
        Gate::allowIf(fn (User $user) => $comment->isOwnedBy($user));

        $comment->delete();
    }
}
