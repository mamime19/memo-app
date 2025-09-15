<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memo;
use App\Models\Memopad;
use Illuminate\Http\Request;

class MemoApiController extends Controller
{
    public function index($memopad_id) {
        $memopad = Memopad::find($memopad_id);
        $memos = $memopad->memos()->get();
        return response()->json($memos);
    }
    public function store(Request $request, $memopad_id) {
        $memopad = Memopad::find($memopad_id);
        $memo = $memopad->memos()->create([
            'text' => $request['text'],
        ]);
        return response()-> json([
            'message' => 'メモを保存しました',
            'memo' => $memo,
        ]);
    }
    public function delete(Request $request, $memopad_id) {
        $memopad = Memopad::find($memopad_id);
        $memo = $memopad->memos()->find($request['memo_id']);
        $memo->delete();
        return response()-> json([
            'message' => 'メモを削除しました',
            'memo' => $memo,
        ]);
    }
    public function update(Request $request, $memopad_id) {
        $memopad = Memopad::find($memopad_id);
        $memo = $memopad->memos()->find($request['memo_id']);
        $memo->text = $request['text'];
        $memo->save();
        return response()-> json([
            'message' => 'メモを編集しました',
            'memo' => $memo,
        ]);
    }
}
