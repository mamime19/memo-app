<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\Request;

class MemoController extends Controller
{
    public function store(Request $request) {
        Memo::create([
            'text' => $request['text'],
        ]);
        return redirect()->back();
    }
}
