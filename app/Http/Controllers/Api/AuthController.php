<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $input = $request->all();
        
        $user = User::where('email',$input['email'])->first();

        if(!$user) {
            return response()->json([
                'error' => true,
                'message' => 'usuario nao encontrado'
            ], 422);
        }

        if(!Hash::check($input['password'], $user->password)) {
            return response()->json([
                'error' => true,
                'message' => 'Senha inválida arrombado'
            ], 422);
        }

        $user->tokens()->delete();
        $token = $user->createToken($user->email . '- web')->plainTextToken;

        return response()->json([
            'x-access-token' => $token,
            'user' => $user
        ]);

    }
}
