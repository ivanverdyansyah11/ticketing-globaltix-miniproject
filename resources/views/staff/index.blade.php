@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Staff</h5>
                <a href="{{ route('staff.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                    <span>Add Staff</span>
                    <i class="ti ti-circle-plus"></i>
                </a>
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success w-100 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @elseif(session()->has('failed'))
                <div class="alert alert-danger w-100 mb-4" role="alert">
                    {{ session('failed') }}
                </div>
            @endif
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
                                <h6 class="fw-semibold mb-0">Email</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Position</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Birth Date</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($staffs->count() == 0)
                            <tr>
                                <td>Data Staff Not Found!</td>
                            </tr>
                        @else
                            @foreach ($staffs as $i => $staff)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $staff->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $staff->user->email }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $staff->position }}</p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $staff->place_of_birth }}, {{ \Carbon\Carbon::createFromFormat('Y-m-d', $staff->date_of_birth)->format('d F Y') }}</p>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <a href="{{ route('staff.detail', $staff->id) }}" class="btn btn-secondary">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </a>
                                        <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-warning">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $staff->id }}">
                                            <span>
                                                <i class="ti ti-trash"></i>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $staffs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>    

@include('partials.staff')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteStaff').attr('action', '/staff/delete/' + id);
        });
    </script>
@endpush
@endsection