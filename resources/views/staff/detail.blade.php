@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Detail Staff</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form>
                <div class="mb-3">
                  <label for="image" class="form-label mb-3">Image Staff</label>
                  <br>
                  @if (file_exists(public_path('assets/images/profile/' . $staff->user->image)))
                    <img src="{{ asset('assets/images/profile/' . $staff->user->image) }}" alt="Profile Staff" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @else
                    <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Staff" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @endif
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input readonly type="text" class="form-control" id="name" value="{{ $staff->name }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input readonly type="email" class="form-control" id="email" value="{{ $staff->user->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input readonly type="text" class="form-control" id="phone_number" value="{{ $staff->phone_number }}">
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input readonly type="text" class="form-control" id="position" value="{{ $staff->position }}">
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date Of Birth</label>
                    <input readonly type="text" class="form-control" id="date_of_birth" value="{{ $staff->date_of_birth }}">
                </div>
                <div class="mb-4">
                    <label for="place_of_birth" class="form-label">Place Of Birth</label>
                    <input readonly type="text" class="form-control" id="place_of_birth" value="{{ $staff->place_of_birth }}">
                </div>
                <div class="wrapper d-flex gap-2">
                    <a href="{{ route('staff') }}" class="btn btn-dark">Back to Staff Page</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
