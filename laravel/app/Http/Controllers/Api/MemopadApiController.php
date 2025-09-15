<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memopad;
use Illuminate\Http\Request;

class MemopadApiController extends Controller
{
    public function store(Request $request) {
        $memopad = Memopad::create([
            'title' => $request['title'],
        ]);
        return response()-> json([
            'id' => $memopad->id,
            'message' => 'メモ帳を保存しました'
        ]);
    }
}
