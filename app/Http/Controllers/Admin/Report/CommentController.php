<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Report;

class CommentController extends Controller
{
    public function destroy(int $id, int $commentId)
    {
        $report = Report::query()->findOrFail($id);
        $report->comments()->where(['id' => $commentId])->delete();

        return back()->with(['success' => 'Комментарий удален'])->withInput();
    }
}
