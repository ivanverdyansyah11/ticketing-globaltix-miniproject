@extends('layouts.main')

@section('content-dashboard')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="card">
                    <div class="card-body px-3">
                        @if (auth()->user()->role != 'super_admin')
                            @if (file_exists(public_path('assets/images/profile/' . $profile->user->image)))
                                <img src="{{ asset('assets/images/profile/' . $profile->user->image) }}" alt="Profile Image" class="img-fluid rounded">
                            @else
                                <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Image" class="img-fluid" style="width: 100%; border-radius: 9999px;">
                            @endif
                        @else
                            <img src="{{ asset('assets/images/profile/profile-not-found.jpg') }}" alt="Profile Image" class="img-fluid" style="width: 100%; border-radius: 9999px;">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body px-3 px-md-4">
                        <h5 class="card-title fw-semibold mb-4">Data Profile</h5>
                        @if (session()->has('success'))
                            <div class="alert alert-success w-100 mb-4" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif(session()->has('failed'))
                            <div class="alert alert-danger w-100 mb-4" role="alert">
                                {{ session('failed') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body px-3 px-md-4">
                                <form>
                                    @if (auth()->user()->role != 'super_admin')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input readonly name="name" type="text" class="form-control" id="name" value="{{ $profile->name }}">
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input readonly name="email" type="email" class="form-control" id="email" value="{{ auth()->user()->role != 'super_admin' ? $profile->user->email : $profile->email }}">
                                    </div>
                                    @if (auth()->user()->role != 'super_admin')
                                        <div class="mb-3">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <input readonly name="phone_number" type="number" class="form-control" id="phone_number" value="{{ $profile->phone_number }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="place_of_birth" class="form-label">Place Of Birth</label>
                                            <input readonly name="place_of_birth" type="text" class="form-control" id="place_of_birth" value="{{ $profile->place_of_birth }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="date_of_birth" class="form-label">Date Of Birth</label>
                                            <input readonly name="date_of_birth" type="date" class="form-control" id="date_of_birth" value="{{ $profile->date_of_birth }}">
                                        </div>
                                    @endif
                                    @if (auth()->user()->role == 'tourguide')
                                        @php
                                            $languageArray = explode(',', $profile->languages_id);
                                            $languageSelect = [];
                                        @endphp
                                        @foreach ($languages as $i => $language)
                                            @if (in_array($language->id, $languageArray))
                                                @php
                                                    $languageSelect[] = $language->name;
                                                    $languageName = implode(', ', $languageSelect);
                                                @endphp
                                            @endif
                                        @endforeach
                                        <div class="mb-3">
                                            <label for="languages_id" class="form-label">Languages</label>
                                            <input readonly name="languages_id" type="text" class="form-control" id="languages_id" value="{{ $languageName }}">
                                        </div>
                                    @endif
                                    @if (auth()->user()->role == 'staff')
                                        <div class="mb-3">
                                            <label for="position" class="form-label">Position</label>
                                            <input readonly name="position" type="text" class="form-control" id="position" value="{{ $profile->position }}">
                                        </div>
                                    @endif
                                    @if (auth()->user()->role == 'customer')
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea readonly name="address" rows="4" class="form-control" id="address">{{ $profile->address }}</textarea>
                                        </div>
                                    @endif
                                    <div class="wrapper d-flex gap-2 mt-3">
                                        <a href="{{ route('profile.edit') }}" class="btn btn-warning">Update Profile</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection