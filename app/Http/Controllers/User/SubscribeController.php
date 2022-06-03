<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $follow = User::query()->findOrFail($request->input('userId'));

        $existFollow = $follow->follows()
                               ->where(['follow_id' => $request->user()->id, 'confirmed' => false])
                               ->exists();

        if ($existFollow) {
            $user_follow = User::query()->findOrFail($request->input('userId'));
            auth()->user()->followers()->where('follower_id', $user_follow->id)->update(['confirmed' => true]);
            $request->user()->follows()->syncWithoutDetaching([$user_follow->id => ['confirmed' => true]]);
        }else {
            $user_follower = User::query()->findOrFail($request->input('userId'));
            auth()->user()->follows()->syncWithoutDetaching($user_follower->id);
        }

        return response()->json(['data' => 'Success'], 200);
    }

    public function destroy()
    {

    }

    public function ban(Request $request)
    {
        if ($request->ajax()) {
            dd($request->all());

            Follow::query()
                ->where([
                    'follower_id' => $request->user()->id,
                    'follow_id' => (int) $request->input('friendId')
                ])
                ->update(['banned' => true]);
        }

        return redirect()->back()->with(['success' => 'Success'])->withInput();
    }

    public function unban(Request $request)
    {
        Follow::query()
            ->where([
                'follower_id' => $request->user()->id,
                'follow_id' => (int) $request->input('friendId')
            ])
            ->update(['banned' => false]);

        return redirect()->back()->with(['success' => 'Success'])->withInput();
    }
}
