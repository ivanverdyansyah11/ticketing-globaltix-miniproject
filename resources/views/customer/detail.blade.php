@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Detail Customer</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form>
                <div class="mb-3">
                  <label for="image" class="form-label mb-3">Image Customer</label>
                  <br>
                  @if (file_exists(public_path('assets/images/profile/' . $customer->user->image)))
                    <img src="{{ asset('assets/images/profile/' . $customer->user->image) }}" alt="Profile Customer" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @else
                    <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Customer" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @endif
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input readonly type="text" class="form-control" id="name" value="{{ $customer->name }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input readonly type="email" class="form-control" id="email" value="{{ $customer->user->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input readonly type="text" class="form-control" id="phone_number" value="{{ $customer->phone_number }}">
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date Of Birth</label>
                    <input readonly type="text" class="form-control" id="date_of_birth" value="{{ $customer->date_of_birth }}">
                </div>
                <div class="mb-4">
                    <label for="place_of_birth" class="form-label">Place Of Birth</label>
                    <input readonly type="text" class="form-control" id="place_of_birth" value="{{ $customer->place_of_birth }}">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea readonly class="form-control" id="address" rows="4">{{ $customer->address }}</textarea>
                </div>
                <div class="mb-4">
                  <label for="status" class="form-label">Status</label>
                  <input readonly type="text" class="form-control text-capitalize" id="status" value="{{ $customer->status == 1 ? 'active' : 'no active' }}">
              </div>
                <div class="wrapper d-flex gap-2">
                    <a href="{{ route('customer') }}" class="btn btn-dark">Back to Customer Page</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
