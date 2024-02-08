@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Ticket Category</h5>
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span>Add Ticket Category</span>
                    <i class="ti ti-circle-plus"></i>
                </button>
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
                                <h6 class="fw-semibold mb-0">Description</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($ticket_categories->count() == 0)
                            <tr>
                                <td>Data Ticket Category Not Found!</td>
                            </tr>
                        @else
                            @foreach ($ticket_categories as $i => $ticket)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $ticket->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ Str::limit($ticket->description, '60') }}</h6>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $ticket->id }}">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $ticket->id }}">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $ticket->id }}">
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
                    {{ $ticket_categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.ticket-category')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '/ticketcategory/detail/' + id,
                success: function(ticketcategory) {
                    if (ticketcategory.status == 'success') {
                        $('[data-value="name"]').val(ticketcategory.data.name);
                        $('[data-value="description"]').val(ticketcategory.data.description);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#editModal"]', function() {
            let id = $(this).data('id');
            $('#buttonEditTicketCategory').attr('action', '/ticketcategory/edit/' + id);
            $.ajax({
                type: 'get',
                url: '/ticketcategory/detail/' + id,
                success: function(ticketcategory) {
                    if (ticketcategory.status == 'success') {
                        $('[data-value="name"]').val(ticketcategory.data.name);
                        $('[data-value="description"]').val(ticketcategory.data.description);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteTicketCategory').attr('action', '/ticketcategory/delete/' + id);
        });
    </script>
@endpush
@endsection