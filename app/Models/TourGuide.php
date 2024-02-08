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

    public function languages() {
        return $this->hasMany(Language::class, 'languages_id');
    }

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }
}
