<?php
use App\Http\Controllers\Api\MemoApiController;
use App\Http\Controllers\Api\MemopadApiController;
use Illuminate\Support\Facades\Route;

Route::post('memopads/{memopad_id}/memos', [MemoApiController::class, 'store']);
Route::get('memopads/{memopad_id}/memos', [MemoApiController::class, 'index']);
Route::delete('memopads/{memopad_id}/memos/{memo_id}', [MemoApiController::class, 'delete']);
Route::post('memopads/{memopad_id}/memos/{memo_id}', [MemoApiController::class, 'update']);
Route::post('memopads', [MemopadApiController::class, 'store']);
