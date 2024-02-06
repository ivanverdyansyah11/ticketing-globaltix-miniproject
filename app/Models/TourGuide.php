<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGuide extends Model
{
    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'users_id');
    }

    // public function language($id) {
    //     return Language::whereIn('id', [$id])->get();
    // }
}
