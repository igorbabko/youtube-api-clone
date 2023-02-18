<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::get();
    }

    public function show(Comment $comment)
    {
        return $comment;
    }
}
