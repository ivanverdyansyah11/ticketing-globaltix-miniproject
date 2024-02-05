@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Detail Category</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input readonly type="text" class="form-control" id="name" value="{{ $category->name }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input readonly type="text" class="form-control" id="description" value="{{ $category->description }}">
                </div>
                <div class="wrapper d-flex gap-2">
                    <a href="{{ route('category') }}" class="btn btn-dark">Back to Category Page</a>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection