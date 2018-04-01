<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|min:3|max:50',
            'password' => 'required|string|min:3|max:50',
            'gate' => 'required|string|min:3|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }

        $email = $request->get('email');
        $password = $request->get('password');

        $organizer = Organizer::where('email', $email)->first();

        if ($organizer == null) {
            return response()->json(["error" => 'no user'], 400);
        }

        if (!Hash::check($password, $organizer->password)) {
            return response()->json(["error" => 'bad password'], 400);
        }

        return response()->json(['status' => 'ok']);
    }
}
