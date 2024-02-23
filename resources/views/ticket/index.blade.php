@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Ticket</h5>
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span>Add Ticket</span>
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
                                <h6 class="fw-semibold mb-0">Tourist Site Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Ticket Category</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Price</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Stock per Day</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tickets->count() == 0)
                            <tr>
                                <td>Data Ticket Not Found!</td>
                            </tr>
                        @else
                            @foreach ($tickets as $i => $ticket)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $ticket->touristSiteFacility->touristsite->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $ticket->category->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">Rp. {{ $ticket->price }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $ticket->stock_per_day }}</h6>
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
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.ticket')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '/ticket/' + id,
                success: function(ticket) {
                    if (ticket.status == 'success') {
                        $('[data-value="tourist_site_facilities_id"]').val(ticket.data[0].tourist_site_facility.touristsite.name);
                        $('[data-value="ticket_categories_id"]').val(ticket.data[0].category.name);
                        $('[data-value="price"]').val('Rp. ' + ticket.data[0].price);
                        $('[data-value="stock_per_day"]').val(ticket.data[0].stock_per_day);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#editModal"]', function() {
            let id = $(this).data('id');
            $('[data-element="row-edit-select"] option').remove();
            $('[data-element="row-edit-select-category"] option').remove();
            $('#buttonEditTicket').attr('action', '/ticket/' + id);
            $.ajax({
                type: 'get',
                url: '/ticket/' + id,
                success: function(ticket) {
                    if (ticket.status == 'success') {
                        ticket.data[1].forEach(tourist_site_facility => {
                            if (tourist_site_facility.id === ticket.data[0].tourist_site_facilities_id) {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${tourist_site_facility.touristsite.id}" selected>${tourist_site_facility.touristsite.name}</option>`
                                );
                            } else {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${tourist_site_facility.touristsite.id}">${tourist_site_facility.touristsite.name}</option>`
                                );
                            }
                        });

                        ticket.data[2].forEach(ticket_category => {
                            if (ticket_category.id === ticket.data[0].ticket_categories_id) {
                                $('[data-element="row-edit-select-category"]').append(
                                    `<option value="${ticket_category.id}" selected>${ticket_category.name}</option>`
                                );
                            } else {
                                $('[data-element="row-edit-select-category"]').append(
                                    `<option value="${ticket_category.id}">${ticket_category.name}</option>`
                                );
                            }
                        });

                        $('[data-value="price"]').val(ticket.data[0].price);
                        $('[data-value="stock_per_day"]').val(ticket.data[0].stock_per_day);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteTicket').attr('action', '/ticket/' + id);
        });
    </script>
@endpush
@endsection