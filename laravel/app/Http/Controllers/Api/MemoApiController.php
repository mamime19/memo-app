<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Memo;
use App\Models\Memopad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemoApiController extends Controller
{
    public function index($user_id, $memopad_id) {
        $memopad = Memopad::where('id', $memopad_id)
            ->where('user_id', $user_id)
            ->first();
        if($memopad == null) {
            return response()->json([
                'status' => 'error',
            ]);
        } else {
            $memos = $memopad->memos()->get();
            return response()->json([
                'status' => 'success',
                'memos' => $memos,
            ]);
        }
    }
    public function store(Request $request, $memopad_id, $user_id) {
        $memopad = Memopad::where('id', $memopad_id)
            ->where('user_id', $user_id)
            ->first();
        $data = [
            'text' => $request['text']
        ];
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('image','public');
            $url = Storage::url($path);
            $data['image'] = $url;
        }
        $memo = $memopad->memos()->create($data);
        return response()-> json([
            'message' => 'メモを保存しました',
            'memo' => $memo,
        ]);
    }
    public function delete(Request $request, $memopad_id, $user_id) {
        $memopad = Memopad::where('id', $memopad_id)
            ->where('user_id', $user_id)
            ->first();
        $memo = $memopad->memos()->find($request['memo_id']);
        $memo->delete();
        return response()-> json([
            'message' => 'メモを削除しました',
            'memo' => $memo,
        ]);
    }
    public function update(Request $request, $memopad_id, $user_id) {
        $memopad = Memopad::where('id', $memopad_id)
            ->where('user_id', $user_id)
            ->first();
        $memo = $memopad->memos()->find($request['memo_id']);
        $memo->text = $request['text'];
        $memo->save();
        return response()-> json([
            'message' => 'メモを編集しました',
            'memo' => $memo,
        ]);
    }
}
