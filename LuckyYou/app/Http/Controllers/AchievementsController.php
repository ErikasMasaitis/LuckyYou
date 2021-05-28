<?php

namespace App\Http\Controllers;

use App\Achievement;
use App\User;
use App\User_achievements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AchievementsController extends Controller
{
    public function achievements()
    {
        $achievements = Achievement::get();
        return response()->json($achievements);
    }

    public function userAchievements()
    {
        $achievements = User_achievements::where('user_id', auth()->id())->get();
        return response()->json($achievements);
    }

    public function updateUserAchievement(Request $request)
    {
        $achievement = User_achievements::findOrFail($request->get('id'));
        $allachievements = Achievement::all();
        foreach ($allachievements as $allachievement) {
            if ($allachievement->id === ($request->get('achievement'))) {
                $rewards = $allachievement->reward;
            }
        }

        $achievement->claimed = 1;
        $achievement->save();

        $user = User::findOrFail($achievement->user_id);
        $user->balance += $rewards;
        $user->save();
    }

    public function checkAchiev()
    {
        $user = auth()->user();
        $user_id = auth()->user()->id;
        $allachievements = Achievement::all();

        foreach ($allachievements as $allachievement) {
            if ($user->balance >= $allachievement->requirement && $allachievement->type === 0) {

                if ($mano = User_achievements::where('achievement_id', $allachievement->id)->count() < 1)
                {
                    User_Achievements::create([
                        'user_id' => auth()->user()->id,
                        'achievement_id' => $allachievement->id,
                        'claimed' => 0,
                    ]);
                }
            }
            if ($user->wins >= $allachievement->requirement && $allachievement->type === 1) {

                if ($mano = User_achievements::where('achievement_id', $allachievement->id)->count() < 1)
                {
                    User_Achievements::create([
                        'user_id' => auth()->user()->id,
                        'achievement_id' => $allachievement->id,
                        'claimed' => 0,
                    ]);
                }
            }
        }
    }
}
