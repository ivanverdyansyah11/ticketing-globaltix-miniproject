@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Add New Category</h5>
        @if (session()->has('failed'))
            <div class="alert alert-danger w-100 mb-3" role="alert">
                {{ session('failed') }}
            </div>
        @endif
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form action="{{ route('category.store') }}" method="POST">
              @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                </div>
                <div class="wrapper d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Add New</button>
                    <a href="{{ route('category') }}" class="btn btn-dark">Cancel Add</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection