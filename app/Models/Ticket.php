<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = ['id'];

    public function touristSiteFacility() {
        return $this->belongsTo(TouristSiteFacility::class, 'tourist_site_facilities_id');
    }

    public function category() {
        return $this->belongsTo(TicketCategory::class, 'ticket_categories_id');
    }
}
