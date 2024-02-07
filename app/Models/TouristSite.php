<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristSite extends Model
{
    protected $guarded = ['id'];

    public function regioncategory() {
        return $this->belongsTo(RegionCategory::class, 'region_categories_id');
    }

    public function touristsitefacility() {
        return $this->belongsTo(TouristSiteFacility::class, 'id');
    }
}
