<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // /api/register
    public function register (Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken; //Crée un jeton d'authentification et l'enegistre dans la table

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);  
    }

    public function login (Request $request){
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $tab = ['email' => $data['email'], 'password' => $data['password']];
        
        if (!Auth::attempt($tab)) {
            return response()->json(['message'=>'Invalid login details'],401);
        }

        $user = User::where('email', $data["email"])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function logout (Request $request){

    }
}
