<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memopad extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
    ];
    public function memos() {
        return $this->hasMany(Memo::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
