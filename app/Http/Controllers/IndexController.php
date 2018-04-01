<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function getIndexPage(Request $request)
    {
        if (!Auth::guest())
            return redirect(route('dashboard'));

        return view('index');
    }

    public function eula()
    {
        return view('eula');
    }

    public function afterLogin(Request $request)
    {
        if (Auth::guest())
            return redirect(route('index'));

        return redirect(route('dashboard'));

    }
}
