<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Models\Coupon;
use App\Repositories\CouponRepositories;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct(
        protected readonly CouponRepositories $coupon,
    ) {}

    public function index() : View {
        return view('coupon.index', [
            'title' => 'Coupon Page',
            'coupons' => $this->coupon->findAllPaginate(),
        ]);
    }

    public function show(Coupon $coupon) : JsonResponse {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->coupon->findById($coupon->id),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Coupon with ID ' . $coupon->id,
            ], 500);
        }
    }

    public function store(StoreCouponRequest $request) : RedirectResponse {
        try {
            $this->coupon->store($request->validated());
            return redirect(route('coupon.index'))->with('success', 'Successfully Add New Coupon!');
        } catch (\Throwable $th) {
            return redirect(route('coupon.index'))->with('failed', 'Failed Add New Coupon!');
        }
    }

    public function update(UpdateCouponRequest $request, Coupon $coupon) : RedirectResponse {
        try {
            $this->coupon->update($request->validated(), $coupon);
            return redirect(route('coupon.index'))->with('success', 'Successfully Update Coupon!');
        } catch (\Throwable $th) {
            return redirect(route('coupon.index'))->with('failed', 'Failed Update Coupon!');
        }
    }

    public function destroy(Coupon $coupon) : RedirectResponse {
        try {
            $this->coupon->delete($coupon);
            return redirect(route('coupon.index'))->with('success', 'Successfully Delete Coupon!');
        } catch (\Throwable $th) {
            return redirect(route('coupon.index'))->with('failde', 'Failed Delete Coupon!');
        }
    }
}
