<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $guarded = ['id'];

    public function touristsitefacility() {
        return $this->hasMany(TouristSiteFacility::class, 'id');
    }
}
