@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Detail Transaction</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form>
                <div class="mb-3">
                  <label for="proof_of_payment" class="form-label mb-3">Proof Of Payment</label>
                  <br>
                  @if (file_exists(public_path('assets/images/profile/' . $transaction->proof_of_payment)))
                    <img src="{{ asset('assets/images/transaction/' . $transaction->proof_of_payment) }}" alt="Profile Transaction" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @else
                  <img src="{{ asset('assets/images/transaction/img-not-found.jpg') }}" alt="Profile Transaction" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @endif
                </div>
                @if ($transaction->staff->name)
                  <div class="mb-3">
                    <label for="staffs_id" class="form-label">Staff</label>
                    <input readonly type="text" name="staffs_id" class="form-control" id="staffs_id" value="{{ $transaction->staff->name }}">
                  </div>
                @endif
                <div class="mb-3">
                  <label for="customers_id" class="form-label">Customer</label>
                  <input readonly type="text" name="customers_id" class="form-control" id="customers_id" value="{{ $transaction->staff->name }}">
                </div>
                @if ($transaction->tourguide->name)
                  <div class="mb-3">
                    <label for="tour_guides_id" class="form-label">Tour Guide</label>
                    <input readonly type="text" name="tour_guides_id" class="form-control" id="tour_guides_id" value="{{ $transaction->tourguide->name }}">
                  </div>
                @endif
                <div class="mb-3">
                  <label for="checkout_date" class="form-label">Checkout Date</label>
                  <input readonly type="text" name="checkout_date" class="form-control" id="checkout_date" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d', $transaction->checkout_date)->format('d F Y') }}">
                </div>
                <div class="mb-3">
                  <label for="tourist_site_facilities_id" class="form-label">Tourist Site</label>
                  <input readonly type="text" name="tourist_site_facilities_id" class="form-control" id="tourist_site_facilities_id" value="{{ $transaction->touristSiteFacility->touristsite->name }}">
                </div>
                <div class="mb-3">
                  <label for="tickets_id" class="form-label">Ticket Ordered</label>
                  <input readonly type="text" name="tickets_id" class="form-control" id="tickets_id" value="{{ $transaction->ticket->category->name }}">
                </div>
                <div class="mb-3">
                  <label for="quantity" class="form-label">Quantity</label>
                  <input readonly type="text" name="quantity" class="form-control" id="quantity" value="{{ $transaction->quantity }}">
                </div>
                <div class="mb-3">
                  <label for="coupons_id" class="form-label">Coupon</label>
                  <input readonly type="text" name="coupons_id" class="form-control" id="coupons_id" value="{{ $transaction->coupon->coupon_code }}">
                </div>
                <div class="mb-3">
                  <label for="total_price" class="form-label">Total Price</label>
                  <input readonly type="text" name="total_price" class="form-control" id="total_price" value="Rp. {{ $transaction->total_price }}">
                </div>
                <div class="mb-3">
                  <label for="total_pay" class="form-label">Total Pay</label>
                  <input readonly type="text" name="total_pay" class="form-control" id="total_pay" value="Rp. {{ $transaction->total_pay }}">
                </div>
                <div class="wrapper d-flex gap-2">
                    <a href="{{ route('report') }}" class="btn btn-dark">Back to Report Page</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
