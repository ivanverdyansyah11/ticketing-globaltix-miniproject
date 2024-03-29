<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Customer;
use App\Models\Staff;
use App\Models\Ticket;
use App\Models\TourGuide;
use App\Models\TouristSiteFacility;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    public function index(): View {
        if (auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin') {
            $transactions = Transaction::with(['touristSiteFacility.touristsite', 'ticket', 'customer'])->orderBy('created_at', 'DESC')->paginate(10);
        } elseif(auth()->user()->role == 'staff') {
            $staff = Staff::where('users_id', auth()->user()->id)->first();
            $transactions = Transaction::with(['touristSiteFacility.touristsite', 'ticket', 'customer'])->where('staffs_id', $staff->id)->orderBy('created_at', 'DESC')->paginate(10);
        } elseif(auth()->user()->role == 'tourguide') {
            $tourguide = TourGuide::where('users_id', auth()->user()->id)->first();
            $transactions = Transaction::with(['touristSiteFacility.touristsite', 'ticket', 'customer'])->where('tour_guides_id', $tourguide->id)->orderBy('created_at', 'DESC')->paginate(10);
        } else {
            $customer = Customer::where('users_id', auth()->user()->id)->first();
            $transactions = Transaction::with(['touristSiteFacility.touristsite', 'ticket', 'customer'])->where('customers_id', $customer->id)->orderBy('created_at', 'DESC')->paginate(10);
        };
        return view('transaction.index', [
            'title' => 'Transaction Page',
            'transactions' => $transactions,
        ]);
    }

    public function detail($id) : View {
        return view('transaction.detail', [
            'title' => 'Transaction Page',
            'transaction' => Transaction::with(['touristSiteFacility.touristsite', 'ticket', 'customer', 'staff', 'tourguide'])->where('id', $id)->first(),
        ]);
    }

    public function create() : View {
        return view('transaction.create', [
            'title' => 'Transaction Page',
            'touristsitefacilities' => TouristSiteFacility::with(['touristsite'])->get(),
            'customers' => Customer::all(),
            'tourguides' => TourGuide::all(),
            'staffs' => Staff::all(),
        ]);
    }

    public function getTickets($id) : JsonResponse {
        $ticket = Ticket::with(['category', 'touristSiteFacility.touristsite.regioncategory.region'])->where('tourist_site_facilities_id', $id)->get();
        $tourist_site_facility = TouristSiteFacility::with(['touristsite.regioncategory.region'])->where('id', $id)->first();
        $languagesIds = $tourist_site_facility->touristsite->regioncategory->region->languages_id;
        $tourguides = TourGuide::get(['id', 'languages_id'])->toArray();
        $tourguideLanguage = [];
        foreach ($tourguides as $tourguide) {
            $tourguide['languages_id'] = explode(',', $tourguide['languages_id']);
            if (in_array($languagesIds, $tourguide['languages_id'])) {
                $tourguideLanguage[] = $tourguide['id'];
            }
        }
        $tourguides = TourGuide::whereIn('id', $tourguideLanguage)->get();

        try {
            return response()->json([
                'status' => 'success',
                'data' => $ticket,
                'tourguides' => $tourguides,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Ticket with ID ' . $id,
            ], 404);
        }
    }

    public function getTicket($id, $checkout_date) : JsonResponse {
        $ticket = Ticket::where('id', $id)->first();
        $stockLeft = Transaction::where('tickets_id', $id)->where('checkout_date', $checkout_date)->sum('quantity');
        $ticketStock = 0;
        try {
            if ($stockLeft == 0) {
                $ticketStock = $ticket->stock_per_day;
            } else {
                $ticketStock = $ticket->stock_per_day - $stockLeft;
            }

            return response()->json([
                'status' => 'success',
                'data' => [$ticket, $ticketStock],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Ticket with ID ' . $id,
            ], 404);
        }
    }

    public function getCoupon($id) : JsonResponse {
        $coupon = Coupon::where('coupon_code', $id)->first();
        try {
            return response()->json([
                'status' => 'success',
                'data' => $coupon,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Coupon with ID ' . $id,
            ], 404);
        }
    }

    public function store(Request $request) : RedirectResponse {
        try {
            $validatedData = $request->validate([
                'staffs_id' => 'nullable|integer',
                'customers_id' => 'required|integer',
                'checkout_date' => 'required',
                'tourist_site_facilities_id' => 'required|integer',
                'tour_guides_id' => 'nullable|string',
                'tickets_id' => 'required|integer',
                'quantity' => 'required|integer',
                'coupons_id' => 'nullable',
                'total_price' => 'required|integer',
                'total_pay' => 'required|integer',
                'proof_of_payment' => 'required|file|image|mimes:png,jpg,jpeg,gif,svg,webp|max:2000',
            ]);

            if ($validatedData['coupons_id'] != null) {
                $validatedData['coupons_id'] = Coupon::where('coupon_code', $validatedData['coupons_id'])->first()->id;
            }

            if ($validatedData['tour_guides_id'] == '-') {
                $validatedData['tour_guides_id'] = null;
            }

            if (!empty($request->proof_of_payment)) {
                $image = $request->file('proof_of_payment');
                $imageName = date("Ymdhis") . "_" . $image->getClientOriginalName();
                $image->move(public_path('assets/images/transaction/'), $imageName);
                $validatedData['proof_of_payment'] = $imageName;
            }

            Transaction::create($validatedData);

            return redirect(route('report'))->with('success', 'Successfully Add New Transaction!');

        } catch (\Throwable $th) {
            return redirect(route('transaction.create'))->with('failed', 'Failed Add New Transaction!');
        }
    }
}
