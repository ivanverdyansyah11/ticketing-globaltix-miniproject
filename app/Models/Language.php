<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $guarded = ['id'];

    public function tourguide() {
        return $this->belongsTo(TourGuide::class, 'id');
    }

    public function region() {
        return $this->belongsTo(Region::class, 'id');
    }
}
