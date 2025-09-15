<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memopad extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];
    public function memos() {
        return $this->hasMany(Memo::class);
    }
}
