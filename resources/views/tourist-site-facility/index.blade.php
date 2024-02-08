@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Tourist Site Facility</h5>
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span>Add Tourist Site Facility</span>
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
                                <h6 class="fw-semibold mb-0">Facility</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tourist_site_facilities->count() == 0)
                            <tr>
                                <td>Data Tourist Site Facility Not Found!</td>
                            </tr>
                        @else
                            @foreach ($tourist_site_facilities as $i => $tourist_site_facility)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $tourist_site_facility->touristsite->name }}</h6>
                                    </td>
                                    @php
                                        $facilityArray = explode(',', $tourist_site_facility->facilities_id);
                                        $facilitySelect = [];
                                    @endphp
                                    @foreach ($facilities as $i => $facility)
                                        @if (in_array($facility->id, $facilityArray))
                                            @php
                                                $facilitySelect[] = $facility->name;
                                                $facilityName = implode(', ', $facilitySelect);
                                            @endphp
                                        @endif
                                    @endforeach
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $facilityName }}</h6>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $tourist_site_facility->id }}">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $tourist_site_facility->id }}">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $tourist_site_facility->id }}">
                                            <span>
                                                <i class="ti ti-trash"></i>
                                            </span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    {{-- <tbody>
                        <tr>
                            <td class="border-bottom-0 bg-danger">
                                {{ $tourist_site_facilities->links() }}
                            </td>
                        </tr>
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>
</div>

@include('partials.tourist-site-facility')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $('[data-element="row-detail-checkbox"] .col').remove();
            $.ajax({
                type: 'get',
                url: '/toursitefacility/detail/' + id,
                success: function(toursitefacility) {
                    if (toursitefacility.status == 'success') {
                        $('[data-value="tourist_sites_id"]').val(toursitefacility.data[0].touristsite.name);

                        let facilityArray = toursitefacility.data[0].facilities_id.split(",");
                        facilityArray = facilityArray.map(function(string) {
                            return parseInt(string);
                        });

                        toursitefacility.data[1].forEach(facility => {
                            if (facilityArray.includes(facility.id)) {
                                $('[data-element="row-detail-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="facilities_id[]" id="${facility.name}" value="${facility.name}" checked disabled>
                                        <label for="${facility.name}">${facility.name}</label>
                                    </div>`
                                )
                            } else {
                                $('[data-element="row-detail-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="facilities_id[]" id="${facility.name}" value="${facility.name}" disabled>
                                        <label for="${facility.name}">${facility.name}</label>
                                    </div>`
                                )
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#editModal"]', function() {
            let id = $(this).data('id');
            $('[data-element="row-edit-select] option').remove();
            $('[data-element="row-edit-checkbox"] .col').remove();
            $('#buttonEditTouristSiteFacility').attr('action', '/toursitefacility/edit/' + id);
            $.ajax({
                type: 'get',
                url: '/toursitefacility/detail/' + id,
                success: function(toursitefacility) {
                    if (toursitefacility.status == 'success') {
                        toursitefacility.data[2].forEach(tourist_site => {
                            if (tourist_site.id === toursitefacility.data[0].tourist_sites_id) {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${tourist_site.id}" selected>${tourist_site.name}</option>`
                                );
                            } else {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${tourist_site.id}">${tourist_site.name}</option>`
                                );
                            }
                        });

                        let facilityArray = toursitefacility.data[0].facilities_id.split(",");
                        facilityArray = facilityArray.map(function(string) {
                            return parseInt(string);
                        });

                        toursitefacility.data[1].forEach(facility => {
                            if (facilityArray.includes(facility.id)) {
                                $('[data-element="row-edit-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="facilities_id[]" id="${facility.name}" value="${facility.id}" checked>
                                        <label for="${facility.name}">${facility.name}</label>
                                    </div>`
                                )
                            } else {
                                $('[data-element="row-edit-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="facilities_id[]" id="${facility.name}" value="${facility.id}">
                                        <label for="${facility.name}">${facility.name}</label>
                                    </div>`
                                )
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteTouristSiteFacility').attr('action', '/toursitefacility/delete/' + id);
        });
    </script>
@endpush
@endsection