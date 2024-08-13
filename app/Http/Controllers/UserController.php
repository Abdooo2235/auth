<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request) {
        $input = $request -> validate ([
            'name' => ['string', 'required'],
            'phone' => ['required', 'string', 'unique:users, phone', 'min:9','max:10'],
            'gender' => ['required','in:male,female'],
            'password' => ['required', 'string'],
            'DOB' => ['required','date_format:Ymd'],
            'avatar_url' => ['nullable']
        ]);
        User::create([
            'name' => $input['name'],
            'phone'=> $input['phone'],
            'gender'=> $input['gender'],
            'DOB'=> $input['DOB'],
            'avatar_url'=> $input['avatar_url'] ?? null,
            'password'=> Hash::make($input['password'])
        ]);
        return response()->json([
            'data' => 'user register successfully'
        ]);

    }
}
