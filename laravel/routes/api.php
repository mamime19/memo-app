<?php
use App\Http\Controllers\Api\MemoApiController;
use App\Http\Controllers\Api\MemopadApiController;
use App\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

Route::post('users/{user_id}/memopads/{memopad_id}/memos', [MemoApiController::class, 'store']);
Route::get('users/{user_id}/memopads/{memopad_id}/memos', [MemoApiController::class, 'index']);
Route::delete('users/{user_id}/memopads/{memopad_id}/memos/{memo_id}', [MemoApiController::class, 'delete']);
Route::post('users/{user_id}/memopads/{memopad_id}/memos/{memo_id}', [MemoApiController::class, 'update']);
Route::post('users/{user_id}/memopads', [MemopadApiController::class, 'store']);
Route::get('users/{user_id}/memopads/{memopad_id}', [MemopadApiController::class, 'get_title']);
Route::post('users/', [UserApiController::class, 'store']);
Route::get('users/{user_id}/memopads', [MemopadApiController::class, 'index']);
