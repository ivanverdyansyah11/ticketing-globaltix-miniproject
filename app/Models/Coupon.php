<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = ['id'];

    public function transaction() {
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }
}
