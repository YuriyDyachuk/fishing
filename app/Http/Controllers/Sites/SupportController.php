<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sites;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupportRequest;

class SupportController extends Controller
{
    public function create()
    {
        return view('sites.support.create');
    }

    public function store(SupportRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->user()->supports()->create(['message' => $request->input('message')]);

        return redirect()->route('main')->with(['success' => 'Заявка отправленна'])->withInput();
    }
}