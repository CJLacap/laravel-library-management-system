<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return response()->json('User index');
    }

    public function show(User $user){
        $user = User::where('role', 'user')->findOrFail($user->id);

        return response()->json($user);
    }

    public function store(UserStoreRequest $request){
        User::create($request->validated());
        return response()->json('User Created');
    }

    
    public function update(UserUpdateRequest $request, User $user){

        $user = User::where('role', 'user')->findOrFail($user->id);
            
        $user->update($request->validated());
        return response()->json('User Updated');
    }

   

 
}
