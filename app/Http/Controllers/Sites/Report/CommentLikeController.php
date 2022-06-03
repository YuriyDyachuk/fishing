<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites\Report;

use App\Models\CommentLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentLikeController extends Controller
{
    public function store(Request $request)
    {
        if ($request->ajax()) {
            CommentLike::query()->updateOrCreate([
                'comment_id' => (int) $request->input('commentId'),
                'user_id' => (int) $request->input('userId'),
                'like' => (bool) $request->input('like')
            ])->refresh();
        }

        $count = CommentLike::query()->where(['comment_id' => $request->input('commentId')])->count();

        return response()->json(['data' => $count, 'id' => (int) $request->input('commentId')]);
    }
}
