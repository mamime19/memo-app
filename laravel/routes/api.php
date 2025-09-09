<?php
use App\Http\Controllers\Api\MemoApiController;
use Illuminate\Support\Facades\Route;

Route::post('memos', [MemoApiController::class, 'store']);
Route::get('memos', [MemoApiController::class, 'index']);
Route::delete('memos/{id}', [MemoApiController::class, 'delete']);
Route::post('memos/{id}', [MemoApiController::class, 'update']);
