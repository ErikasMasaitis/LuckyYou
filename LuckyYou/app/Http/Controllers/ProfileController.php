<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $this->validate($request, [
            'name' => ['string'],
            'email' => ['email', 'unique:users,id,' . auth()->id()],
            'password' => ['nullable', 'min:6', 'confirmed'],
            'photo' => ['nullable', 'image']
        ]);

        $user = auth()->user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->has('password') && $request->has('password_confirmation')) {
            $user->password = bcrypt($request->get('password'));
        }

        if ($file = $request->file('photo')) {
            $path = $file->store('public');
            $user->photo = str_replace('public', 'storage', $path);
        }
        $user->save();
        return response(200);
    }

    public function profile()
    {
        return response()->json(auth()->user());
    }
}
