<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memo;
use Illuminate\Http\Request;

class MemoApiController extends Controller
{
    public function index() {
        $memos = Memo::all();
        return response()->json($memos);
    }
    public function store(Request $request) {
        $memo = Memo::create([
            'text' => $request['text'],
        ]);
        return response()-> json([
            'message' => 'メモを保存しました',
            'memo' => $memo,
        ]);
    }
    public function delete(Request $request) {
        $memo = Memo::find($request['id']);
        $memo->delete();
        return response()-> json([
            'message' => 'メモを削除しました',
            'memo' => $memo,
        ]);
    }
    public function update(Request $request) {
        $memo = Memo::find($request['id']);
        $memo->text = $request['text'];
        $memo->save();
        return response()-> json([
            'message' => 'メモを編集しました',
            'memo' => $memo,
        ]);
    }
}
