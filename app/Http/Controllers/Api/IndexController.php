<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Web root of the api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(['message' => 'hello']);
    }
}
