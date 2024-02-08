<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = ['id'];

    public function touristSiteFacility() {
        return $this->belongsTo(TouristSiteFacility::class, 'tourist_site_facilities_id');
    }

    public function ticket() {
        return $this->belongsTo(Ticket::class, 'tickets_id');
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class, 'coupons_id');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'customers_id');
    }

    public function staff() {
        return $this->belongsTo(Staff::class, 'staffs_id');
    }

    public function tourguide() {
        return $this->belongsTo(TourGuide::class, 'tour_guides_id');
    }
}
