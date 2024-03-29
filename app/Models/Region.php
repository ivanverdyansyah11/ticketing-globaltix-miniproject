<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = ['id'];

    public function regionCategory() {
        return $this->belongsTo(RegionCategory::class, 'id');
    }

    public function language() {
        return $this->belongsTo(Language::class, 'languages_id');
    }
}
