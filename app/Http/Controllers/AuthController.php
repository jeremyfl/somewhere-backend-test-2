<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::attempt($user);
            return response()->json($user, 200);
        }

        return response()->json(['message' => "User details incorrect"], 404);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return response()->json(['status' => "success", "user_id" => $user->id], 201);
    }
    public function authenticate(Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',

        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (Hash::check($request->input('password'), $user->password)) {

            $apikey = base64_encode(str_random(40));

            User::where('email', $request->input('email'))->update(['api_key' => "$apikey"]);

            return response()->json(['status' => 'success', 'api_key' => $apikey]);

        } else {

            return response()->json(['status' => 'fail'], 401);

        }

    }

}
