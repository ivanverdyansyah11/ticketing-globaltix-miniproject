<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index() : View {
        return view('coupon.index', [
            'title' => 'Coupon Page',
            'coupons' => Coupon::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) : JsonResponse {
        $coupon = Coupon::where('id', $id)->first();
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

    public function store(StoreCouponRequest $request) : RedirectResponse {
        try {
            Coupon::create($request->all());

            return redirect(route('coupon'))->with('success', 'Successfully Add New Coupon!');
        } catch (\Throwable $th) {
            return redirect(route('coupon'))->with('failed', 'Failed Add New Coupon!');
        }
    }

    public function update(UpdateCouponRequest $request, $id) : RedirectResponse {
        $coupon = Coupon::where('id', $id)->first();

        try {
            $coupon->update($request->all());

            return redirect(route('coupon'))->with('success', 'Successfully Update Coupon!');

        } catch (\Throwable $th) {
            return redirect(route('coupon'))->with('failed', 'Failed Update Coupon!');
        }
    }

    public function delete($id) : RedirectResponse {
        $coupon = Coupon::where('id', $id)->first();

        try {
            $coupon->delete();

            return redirect(route('coupon'))->with('success', 'Successfully Delete Coupon!');
        } catch (\Throwable $th) {
            return redirect(route('coupon'))->with('failde', 'Failed Delete Coupon!');
        }
    }
}
