@extends('layouts.main')

@section('content-auth')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                @if (session()->has('success'))
                    <div class="alert alert-success w-100 mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div class="alert alert-danger w-100 mb-3" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
                <div class="card mb-0">
                    <div class="card-body">
                        <a class="text-nowrap logo-img text-center d-block py-3 w-100">
                            <img src="{{ asset('assets/images/brand/brand-logo.svg') }}" class="img-fluid" width="86" alt="Brand Logo">
                        </a>
                        <p class="text-center">Your Ticket Tour Destination</p>
                        <form action="{{ route('login.authenticate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Login Account</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection