<?php

namespace App\Http\Controllers;

use App\AdminHistory;
use App\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history()
    {
        $achievements = AdminHistory::where('admin_id', auth()->id())->get();
        return response()->json($achievements);
    }
    public function historyuser(Request $request)
    {
        $achievements = User::where('id', $request->get('user'));
        dd($achievements);
        return response()->json($achievements);
    }
    public function userwinningshistory(Request $request)
    {
        $winnings = History::where('user_id', auth()->id())->get();
        return response()->json($winnings);
    }
}
