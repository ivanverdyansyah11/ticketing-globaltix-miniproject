@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-4">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Category</h5>
                <a href="{{ route('category.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                    <span>Add Category</span>
                    <i class="ti ti-circle-plus"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4 border-bottom">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">#</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Description</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($categories->count() == 0)
                            <tr>
                                <td>Data Not Found!</td>
                            </tr>
                        @else
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $category->id }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $category->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $category->description }}</p>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <a href="{{ route('category.detail', $category->id) }}" class="btn btn-secondary">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger">
                                            <span>
                                                <i class="ti ti-trash"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{ $categories->links() }} --}}
</div>    
@endsection