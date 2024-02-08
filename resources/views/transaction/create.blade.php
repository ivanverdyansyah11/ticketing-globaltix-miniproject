@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-3">Create Transaction</h5>
        @if(session()->has('failed'))
            <div class="alert alert-danger w-100 mb-4" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form action="{{ route('transaction.create') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="proof_of_payment" class="form-label mb-3">Proof Of Payment</label>
                <br>
                <img src="{{ asset('assets/images/transaction/img-not-found.jpg') }}" alt="Profile Transaction" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                <input required class="form-control mt-3 input-file @error('proof_of_payment') is-invalid @enderror" name="proof_of_payment" type="file" id="proof_of_payment">
                @error('proof_of_payment')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="staffs_id" class="form-label">Staff</label>
                <select required name="staffs_id" class="form-control @error('staffs_id') is-invalid @enderror" id="staffs_id">
                  <option value="-">Choose staff</option>
                  @foreach ($staffs as $staff)
                    <option value="{{ $staff->id }}">{{ $staff->name }}</option>
                  @endforeach
                </select>
                @error('staffs_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="customers_id" class="form-label">Customer</label>
                <select required name="customers_id" class="form-control @error('customers_id') is-invalid @enderror" id="customers_id">
                  <option value="-">Choose customer</option>
                  @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                  @endforeach
                </select>
                @error('customers_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="tour_guides_id" class="form-label">Tour Guide</label>
                <select required name="tour_guides_id" class="form-control @error('tour_guides_id') is-invalid @enderror" id="tour_guides_id">
                  <option value="-">Choose tourguide</option>
                  @foreach ($tourguides as $tourguide)
                    <option value="{{ $tourguide->id }}">{{ $tourguide->name }}</option>
                  @endforeach
                </select>
                @error('tour_guides_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="checkout_date" class="form-label">Checkout Date</label>
                <input required name="checkout_date" type="date" class="form-control @error('checkout_date') is-invalid @enderror" id="checkout_date">
                @error('checkout_date')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="tourist_site_facilities_id" class="form-label">Tourist Site</label>
                  <select required name="tourist_site_facilities_id" class="form-control @error('tourist_site_facilities_id') is-invalid @enderror" id="tourist_site_facilities_id">
                    <option value="-">Choose tourist site</option>
                    @foreach ($touristsitefacilities as $touristsitefacility)
                      <option value="{{ $touristsitefacility->id }}">{{ $touristsitefacility->touristsite->name }}</option>
                    @endforeach
                  </select>
                  @error('tourist_site_facilities_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="tickets_id" class="form-label">Ticket Available</label>
                  <select required name="tickets_id" class="form-control @error('tickets_id') is-invalid @enderror" id="tickets_id">
                    <option value="-">Choose tourist site first!</option>
                  </select>
                  <input type="hidden" id="price">
                  @error('tickets_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <select required name="quantity" class="form-control @error('quantity') is-invalid @enderror" id="quantity">
                  <option value="-">Select checkout data & choose ticket first!</option>
                </select>
                @error('quantity')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="coupons_id" class="form-label">Coupon</label>
                <input name="coupons_id" type="text" class="form-control @error('coupons_id') is-invalid @enderror" id="coupons_id">
                @error('coupons_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="total_price" class="form-label">Total Price</label>
                  <input required name="total_price" type="number" class="form-control @error('total_price') is-invalid @enderror" id="total_price">
                  @error('total_price')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="total_pay" class="form-label">Total Pay</label>
                  <input required name="total_pay" type="number" class="form-control @error('total_pay') is-invalid @enderror" id="total_pay">
                  @error('total_pay')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="wrapper d-flex gap-2">
                <button type="submit" class="btn btn-primary">Checkout Payment</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  @push('js')
      <script>
          const tagImage = document.querySelector('.img-preview');
          const inputImage = document.querySelector('.input-file');

          inputImage.addEventListener('change', function() {
              tagImage.src = URL.createObjectURL(inputImage.files[0]);
          });

          $(document).on('change', '#tourist_site_facilities_id', function() {
            let id = $(this).val();
            $('#tickets_id option').remove();
            $('#quantity option').remove();
            $.ajax({
                type: 'get',
                url: '/transaction/getTickets/' + id,
                success: function(tickets) {
                  if (tickets.status == 'success') {
                    $('#quantity').append(
                        `<option value="-">Select checkout data & choose ticket first!</option>`
                    );
                    $('#total_price').val(' ');

                    if (tickets.data.length == 0 || tickets.data.length == '-') {
                      $('#tickets_id').append(
                        `<option value="-">No Tickets Available!</option>`
                      );
                    } else {
                      $('#tickets_id').append(
                        `<option value="-">Choose ticket</option>`
                      );
                      tickets.data.forEach(ticket => {
                        $('#tickets_id').append(
                            `<option value="${ticket.id}">${ticket.category.name}</option>`
                        );
                      });
                    }
                  }
                }
            });
          });

          $(document).on('change', '#tickets_id', function() {
            let id = $(this).val();
            let checkoutDate = $('#checkout_date').val();
            $('#quantity option').remove();
            $.ajax({
                type: 'get',
                url: '/transaction/getTicket/' + id + '/' + checkoutDate,
                success: function(ticket) {
                  if (ticket.status == 'success') {
                    $('#price').val(ticket.data[0].price);
                    if (ticket.data[1] == 0) {
                      $('#quantity').append(
                        `<option value="-">Tickets at This Tourist Site Have Run Out!</option>`
                      );
                    } else {
                      $('#quantity').append(
                        `<option value="-">Choose quantity ticket</option>`
                      );
                      for (let i = 1; i <= ticket.data[1]; i++) {
                        $('#quantity').append(
                            `<option value="${i}">${i}</option>`
                        );
                      }
                    }
                  }
                }
            });
          });

          $(document).on('change', '#quantity', function() {
            let price = $('#price').val();
            let quantity = $(this).val();
            $('#total_price').val(price * quantity);
          });

          $(document).on('change', '#coupons_id', function() {
            let coupons = $(this).val();
            let total_price = $('#total_price').val();
            $.ajax({
                type: 'get',
                url: '/transaction/getCoupon/' + coupons,
                success: function(coupon) {
                  if (coupon.status == 'success') {
                    if (coupon.data != null) {
                      let total_coupon = total_price * (coupon.data.discount_percentage / 100);

                      $('#total_price').val(total_price - total_coupon);
                    }
                  }
                }
            });
          });
      </script>
  @endpush
@endsection