<?php
use App\Http\Controllers\Api\MemoApiController;
use Illuminate\Support\Facades\Route;

Route::post('memos', [MemoApiController::class, 'store'])->name('memos.store');
Route::get('memos', [MemoApiController::class, 'index'])->name('memos.index');
