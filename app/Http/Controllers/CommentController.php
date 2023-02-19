<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with('parent', 'user', 'video')->get();
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'text' => 'required|string',
            'parent_id' => 'exists:comments,id',
            'video_id' => 'required_without:parent_id|exists:videos,id',
        ]);

        $attributes['user_id'] = $request->user()->id;

        if ($request->parent_id) {
            $attributes['video_id'] = Comment::find($request->parent_id)->video_id;
        }

        return Comment::create($attributes);
    }

    public function update(Comment $comment, Request $request)
    {
        throw_if($request->user()->isNot($comment->user), AuthorizationException::class);

        $attributes = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->fill($attributes)->save();
    }
}
