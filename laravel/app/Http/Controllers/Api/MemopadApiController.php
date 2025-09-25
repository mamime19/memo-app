<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memopad;
use App\Models\User;
use Illuminate\Http\Request;

class MemopadApiController extends Controller
{
    public function index($user_id) {
        $user = User::find($user_id);
        $memopads = $user->memopads()->get();
        return response()->json([
            'status' => 'success',
            'memopads' => $memopads,
        ]);
    }
    public function store(Request $request, $user_id) {
        $memopad = Memopad::create([
            'title' => $request['title'],
            'user_id' => $user_id,
        ]);
        return response()-> json([
            'id' => $memopad->id,
            'message' => 'メモ帳を保存しました'
        ]);
    }
    public function get_title($user_id, $memopad_id) {
        $memopad = Memopad::where('id', $memopad_id)
        ->where('user_id', $user_id)
        ->first();
        return response()-> json([
            'title' => $memopad->title,
        ]);
    }
}
