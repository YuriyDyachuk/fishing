<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;

class BannedUserController extends Controller
{

    public function index()
    {
        return view('admin.users.banned');
    }
}
