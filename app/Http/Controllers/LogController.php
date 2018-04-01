<?php

namespace App\Http\Controllers;

use App\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::all();

        return view("log.index", [
            "logs" => $logs,
        ]);
    }
}
