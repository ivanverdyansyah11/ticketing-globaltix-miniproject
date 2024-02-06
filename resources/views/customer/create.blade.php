@extends('layouts.main')

@section('content-dashboard')
  <div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-3">Create Customer</h5>
        @if(session()->has('failed'))
            <div class="alert alert-danger w-100 mb-4" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form action="{{ route('customer.create') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="image" class="form-label mb-3">Image Customer</label>
                <br>
                <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Customer" class="img-fluid img-preview" width="100">
                <input required class="form-control mt-3 input-file @error('image') is-invalid @enderror" name="image" type="file" id="image">
                @error('image')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input required name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name">
                  @error('name')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input required name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email">
                  @error('email')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input required name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password">
                  @error('password')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="phone_number" class="form-label">Phone Number</label>
                  <input required name="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number">
                  @error('phone_number')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-3">
                  <label for="date_of_birth" class="form-label">Date Of Birth</label>
                  <input required name="date_of_birth" type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth">
                  @error('date_of_birth')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-4">
                  <label for="place_of_birth" class="form-label">Place Of Birth</label>
                  <input required name="place_of_birth" type="text" class="form-control @error('place_of_birth') is-invalid @enderror" id="place_of_birth">
                  @error('place_of_birth')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="mb-4">
                  <label for="address" class="form-label">Address</label>
                  <textarea required name="address" class="form-control @error('address') is-invalid @enderror" id="address" rows="4"></textarea>
                  @error('address')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
              </div>
              <div class="wrapper d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add New Customer</button>
                <a href="{{ route('customer') }}" class="btn btn-dark">Cancel Add</a>
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