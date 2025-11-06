<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function register(Request $request){
        $fields = $request->validate([
            'name'=> 'required|string|unique:users,name',
            'username'=> 'required|string|unique:users,username',
            'password' => 'required|string|confirmed',
        ]);
        $user = User::create([
            'name'=> $fields['name'],
            'username'=> $fields['username'],
            'password'=> Hash::make($fields['password']),
        ]);
        $token = $user->createToken('usertoken')->plainTextToken;

        $response = [
            'token'=> $token,
        ];
        return response($response,201);
    }
    public function login(Request $request){
        $fields = $request->validate([
            'username'=> 'required|string',
            'password' => 'required|string', 
            ]);
        $user = User::where('username', $fields['username'])->first();
        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response(['message' => 'Bad credentials'],401);
        }
        $token = $user->createToken('usertoken')->plainTextToken;
        $response = [
            'name' => $user->name,
            'token'=> $token,
        ];
        return response($response,201);

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return ['message' => 'Logged out'];
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
