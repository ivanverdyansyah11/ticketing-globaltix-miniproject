@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card">
      <div class="card-body px-3 px-md-4">
        <h5 class="card-title fw-semibold mb-4">Edit Category</h5>
        <div class="card">
          <div class="card-body px-3 px-md-4">
            <form action="{{ route('category.update', $category->id) }}" method="POST">
              @csrf
              <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input name="name" type="text" class="form-control" id="name" value="{{ $category->name }}">
              </div>
              <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <input name="description" type="text" class="form-control" id="description" value="{{ $category->description }}">
              </div>
              <div class="wrapper d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('category') }}" class="btn btn-dark">Cancel Edit</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection