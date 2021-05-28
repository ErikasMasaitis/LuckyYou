<?php

namespace App\Http\Controllers;

use App\User;
use App\AdminHistory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(
            User::all()
        );
    }

    public function user()
    {
        $user = auth()->user();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $this->validate($request, [
            'role' => ['required'],
        ]);

        /** @var User $user */
        $user = User::findOrFail($id);

        $user->update($data);

        return response(null, 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::findOrFail($request->get('user'));
       // $id = $request->get('id');
        /** @var User $user */
       // $user =  User::findOrFail($id);

        $user->delete();

        return response(null, 204);
    }
    public function giveMoney(Request $request)
    {
        $admin_id = auth()->user()->id;
        $user = User::findOrFail($request->get('user'));

        $money = $request->get('moneyy');

        $useremail = User::findOrFail($request->get('user'))->email;

        $user->balance += $money;

        $user->save();
        AdminHistory::create([
        'user_id' => $request->get('user'),
        'given_sum' => $money,
        'email' => $useremail,
        'admin_id' => $admin_id
        ]);

        return response(null, 204);
    }
    public function changeRole(Request $request) {
        $user = User::findOrFail($request->get('user'));

        $user->role = 'admin';

        $user->save();

        return response(null, 204);
    }
}
