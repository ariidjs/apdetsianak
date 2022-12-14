<?php

namespace App\Http\Controllers;
use App\Models\Anak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function insert(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::create([
            'username' => $username,
            'password' => Hash::make($password),
        ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'singupdata' => $user
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'failed'
            ], 400);
        }
    }
}
