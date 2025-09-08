<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memo;
use Illuminate\Http\Request;

class MemoApiController extends Controller
{
    public function store(Request $request) {
        $validated = $request->validate([
            'text' => 'required',
        ]);
        $memo = Memo::create([
            'text' => $validated['text'],
        ]);
        return response()-> json([
            'message' => 'メモを保存しました',
            'memo' => $memo,
        ]);
    }
}
