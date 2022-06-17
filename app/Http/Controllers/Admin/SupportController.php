<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Support;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    public function index()
    {
        $supports = Support::query()->paginate(10);

        return view('admin.support.index', ['supports' => $supports]);
    }

    public function show(int $id)
    {
        $support = Support::query()->findOrFail($id);

        return view('admin.support.show', ['support' => $support]);
    }

    public function update(int $id): \Illuminate\Http\RedirectResponse
    {
        Support::query()->where('id',$id)->update(['status' => true]);

        return redirect()->route('supports.index')->with(['success' => 'Заявка обработана'])->withInput();
    }

    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        Support::query()->findOrFail($id)->delete();

        return redirect()->back()->with(['success' => 'Успешно удаленно'])->withInput();
    }
}