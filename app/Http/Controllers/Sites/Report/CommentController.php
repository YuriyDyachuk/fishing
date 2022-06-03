<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites\Report;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use function back;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $comment = new Comment;
        $comment->body = $request->get('comment');
        $comment->user()->associate($request->user());
        $post = Report::query()->find($request->get('repostId'));
        $post->comments()->save($comment);

        return back();
    }

    public function replyStore(Request $request): RedirectResponse
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = Report::query()->find($request->get('post_id'));
        $post->comments()->save($reply);

        return back();
    }
}
