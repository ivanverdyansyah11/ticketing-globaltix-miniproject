@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Detail Tour Guide</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form>
                <div class="mb-3">
                  <label for="image" class="form-label mb-3">Image Tour Guide</label>
                  <br>
                  @if (file_exists(public_path('assets/images/profile/' . $tourguide->user->image)))
                    <img src="{{ asset('assets/images/profile/' . $tourguide->user->image) }}" alt="Profile Tour Guide" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @else
                    <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Tour Guide" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @endif
                </div>
                <div class="mb-3">
                  <label class="form-label">Language</label>
                  <div class="row row-cols-md-2 row-cols-md-3 row-cols-lg-4">
                    @php
                        $language_selected = explode(',', $tourguide->languages_id);
                    @endphp
                    @foreach ($languages as $language)
                      @if (in_array($language->id, $language_selected))
                        <div class="col">
                          <input type="checkbox" name="languages_id[]" id="{{ $language->name }}" checked disabled>
                          <label for="{{ $language->name }}">{{ $language->name }}</label>
                        </div>
                      @else
                        <div class="col">
                          <input type="checkbox" name="languages_id[]" id="{{ $language->name }}" disabled>
                          <label for="{{ $language->name }}">{{ $language->name }}</label>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input readonly type="text" class="form-control" id="name" value="{{ $tourguide->name }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input readonly type="email" class="form-control" id="email" value="{{ $tourguide->user->email }}">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input readonly type="text" class="form-control" id="phone_number" value="{{ $tourguide->phone_number }}">
                </div>
                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date Of Birth</label>
                    <input readonly type="text" class="form-control" id="date_of_birth" value="{{ $tourguide->date_of_birth }}">
                </div>
                <div class="mb-4">
                    <label for="place_of_birth" class="form-label">Place Of Birth</label>
                    <input readonly type="text" class="form-control" id="place_of_birth" value="{{ $tourguide->place_of_birth }}">
                </div>
                <div class="wrapper d-flex gap-2">
                    <a href="{{ route('tourguide') }}" class="btn btn-dark">Back to Tour Guide Page</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
