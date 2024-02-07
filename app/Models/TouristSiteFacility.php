<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristSiteFacility extends Model
{
    protected $guarded = ['id'];

    public function touristsite() {
        return $this->belongsTo(TouristSite::class, 'tourist_sites_id');
    }

    public function facility() {
        return $this->belongsTo(Facility::class, 'facilities_id');
    }
}
