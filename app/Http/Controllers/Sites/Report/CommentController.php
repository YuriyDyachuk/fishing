<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites\Report;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Wkhooy\ObsceneCensorRus;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $text = $request->input('comment');
        $isAllowed = ObsceneCensorRus::filterText($text);
        $comment = new Comment;
        $comment->body = $text;
        $comment->is_allowed = $isAllowed;
        $comment->user()->associate($request->user());
        $post = Report::query()->find($request->get('repostId'));
        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request): RedirectResponse
    {
        $text = $request->input('comment_body');
        $isAllowed = ObsceneCensorRus::filterText($text);
        $comment = new Comment;
        $comment->body = $text;
        $comment->is_allowed = $isAllowed;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $comment->parent_id = $request->get('comment_id');
        $post = Report::query()->find($request->get('post_id'));
        $post->comments()->save($comment);

        return back();
    }
}
