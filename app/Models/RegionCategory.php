<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionCategory extends Model
{
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function region() {
        return $this->belongsTo(Region::class, 'regions_id');
    }
}
