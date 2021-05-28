<?php

namespace App\Http\Controllers;

use App\Lobby;
use App\History;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function lobbies()
    {
        $lobbies = Lobby::get();
        return response()->json($lobbies);
    }
    public function stake(Request $request)
    {
        $user = auth()->user();
        $lobby_id = ($request->get('id'));
        $decision = ($request->get('decision'));

        $prize = Lobby::findOrFail($lobby_id)->prize;

        if ($user->balance >= $prize) {
            if ($decision == 'false') {
                $user->balance += $prize * 10;
                $user->wins += 1;
                History::create([
                    'user_id' => $user->id,
                    'winner' => $user->id,
                    'gol' => $prize*10
                ]);
            } else {
                $user->balance -= $prize;
                History::create([
                    'user_id' => $user->id,
                    'winner' => 0,
                    'gol' => $prize
                ]);
            }
        }
        else
        {
            return response('no money', 200);
        }
        $user->save();

    }
}
