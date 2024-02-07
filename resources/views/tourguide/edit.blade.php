@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Edit Tour Guide</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form action="{{ route('tourguide.edit', $tourguide->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="image" class="form-label mb-3">Image Tour Guide</label>
                <br>
                @if (file_exists(public_path('assets/images/profile/' . $tourguide->user->image)))
                    <img src="{{ asset('assets/images/profile/' . $tourguide->user->image) }}" alt="Profile Tour Guide" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @else
                    <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Tour Guide" class="img-preview" width="100" height="100" style="object-fit: cover; border-radius: 9999px;">
                  @endif
                <input class="form-control mt-3 input-file @error('image') is-invalid @enderror" name="image" type="file" id="image">
                @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                <label class="form-label">Language</label>
                <div class="row row-cols-md-2 row-cols-md-3 row-cols-lg-4">
                  @php
                      $language_selected = explode(',', $tourguide->languages_id);
                  @endphp
                  @foreach ($languages as $language)
                    @if (in_array($language->id, $language_selected))
                      <div class="col mb-1">
                        <input type="checkbox" name="languages_id[]" id="{{ $language->name }}" checked value="{{ $language->id }}">
                        <label for="{{ $language->name }}">{{ $language->name }}</label>
                      </div>
                    @else
                      <div class="col mb-1">
                        <input type="checkbox" name="languages_id[]" id="{{ $language->name }}" value="{{ $language->id }}">
                        <label for="{{ $language->name }}">{{ $language->name }}</label>
                      </div>
                    @endif
                  @endforeach
                </div>
                @error('languages_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input required name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $tourguide->name }}">
                  @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input required name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $tourguide->user->email }}">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <input required name="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" value="{{ $tourguide->phone_number }}">
                  @error('phone_number')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="date_of_birth" class="form-label">Date Of Birth</label>
                  <input required name="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" value="{{ $tourguide->date_of_birth }}">
                  @error('date_of_birth')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-4">
                  <label for="place_of_birth" class="form-label">Place Of Birth</label>
                  <input required name="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth" value="{{ $tourguide->place_of_birth }}">
                  @error('place_of_birth')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="wrapper d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('tourguide') }}" class="btn btn-dark">Cancel Edit</a>
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
      </script>
  @endpush
@endsection