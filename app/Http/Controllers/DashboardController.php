<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Language;
use App\Models\Region;
use App\Models\Staff;
use App\Models\Ticket;
use App\Models\TourGuide;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index() {
        if (auth()->user()->role == 'super admin' || auth()->user()->role == 'admin') {
            $total_order = count(Transaction::all());
            $total_language = count(Language::all());
            $total_region = count(Region::all());
            $total_ticket = count(Ticket::all());
            $datas = [$total_order, $total_language, $total_region, $total_ticket];
        } elseif(auth()->user()->role == 'staff') {
            $staff = Staff::where('users_id', auth()->user()->id)->first();
            $total_order = count(Transaction::where('staffs_id', $staff->id)->get());
            $total_language = count(Language::all());
            $total_region = count(Region::all());
            $total_ticket = count(Ticket::all());
            $datas = [$total_order, $total_language, $total_region, $total_ticket];
        } elseif(auth()->user()->role == 'tourguide') {
            $tourguide = TourGuide::where('users_id', auth()->user()->id)->first();
            $total_required = count(Transaction::where('tour_guides_id', $tourguide->id)->get());
            $total_transaction = Transaction::where('tour_guides_id', $tourguide->id)->get()->sum('total_pay');
            $total_revenue = $total_transaction * 10 / 100;
            $datas = [$total_required, $total_revenue];
        } else {
            $customer = Customer::where('users_id', auth()->user()->id)->first();
            $total_ticket = Transaction::where('customers_id', $customer->id)->get()->sum('quantity');
            $total_expenses = Transaction::where('customers_id', $customer->id)->get()->sum('total_pay');
            $datas = [$total_ticket, $total_expenses];
        };
        return view('dashboard.index', [
            'title' => 'Dashboard Page',
            'datas' => $datas,
        ]);
    }
}
