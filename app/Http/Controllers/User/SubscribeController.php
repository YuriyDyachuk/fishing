<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Follow;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Services\SubscriberService;
use App\Http\Controllers\Controller;

class SubscribeController extends Controller
{
    private UserService $userService;
    private SubscriberService $subscriberService;

    public function __construct(
        UserService $userService,
        SubscriberService $subscriberService
    ){
        $this->userService = $userService;
        $this->subscriberService = $subscriberService;
    }

    public function index()
    {
        return view('sites.profiles.subscribers', ['followers' => $this->userService->getMyFollowers()]);
    }

    public function apply(int $id, int $followId): \Illuminate\Http\RedirectResponse
    {
        $follow = User::query()->findOrFail($followId);
        $existFollow = $follow->follows()
                              ->where(['follow_id' => $id, 'confirmed' => false])
                              ->exists();

        if ($existFollow) {
            $user_follow = User::query()->findOrFail($followId);
            auth()->user()->followers()->where('follower_id', $user_follow->id)->update(['confirmed' => true]);
            auth()->user()->follows()->syncWithoutDetaching([$user_follow->id => ['confirmed' => true]]);
        }else {
            $user_follower = User::query()->findOrFail($followId);
            auth()->user()->follows()->syncWithoutDetaching($user_follower->id);
        }

        return redirect()->back()->with(['success' => 'Заявка подтверждена'])->withInput();
    }

    public function cancel(int $id, int $followId): \Illuminate\Http\RedirectResponse
    {
        $this->subscriberService->destroyFollow($id, $followId);

        return redirect()->back()->with(['success' => 'Заявка отменена'])->withInput();
    }

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

    public function banned(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $request->user()
                    ->followers()
                    ->where(['follower_id' => $request->input('followId')])
                    ->update(['banned' => (bool) $request->input('checked')]);
        }

        return response()->json(['success' => 'ok'],200);
    }
}
