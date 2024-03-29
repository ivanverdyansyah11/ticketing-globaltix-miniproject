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
                                        <h6 class="mb-0 fw-normal">{{ Str::limit($facilityName, '60') }}</h6>
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
                </table>
                <div class="mt-3">
                    {{ $tourist_site_facilities->links() }}
                </div>
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
                url: '/touristsitefacility/' + id,
                success: function(touristsitefacility) {
                    if (touristsitefacility.status == 'success') {
                        $('[data-value="tourist_sites_id"]').val(touristsitefacility.data[0].touristsite.name);

                        let facilityArray = touristsitefacility.data[0].facilities_id.split(",");
                        facilityArray = facilityArray.map(function(string) {
                            return parseInt(string);
                        });

                        touristsitefacility.data[1].forEach(facility => {
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
            $('#buttonEditTouristSiteFacility').attr('action', '/touristsitefacility/' + id);
            $.ajax({
                type: 'get',
                url: '/touristsitefacility/' + id,
                success: function(touristsitefacility) {
                    if (touristsitefacility.status == 'success') {
                        touristsitefacility.data[2].forEach(tourist_site => {
                            if (tourist_site.id === touristsitefacility.data[0].tourist_sites_id) {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${tourist_site.id}" selected>${tourist_site.name}</option>`
                                );
                            } else {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${tourist_site.id}">${tourist_site.name}</option>`
                                );
                            }
                        });

                        let facilityArray = touristsitefacility.data[0].facilities_id.split(",");
                        facilityArray = facilityArray.map(function(string) {
                            return parseInt(string);
                        });

                        touristsitefacility.data[1].forEach(facility => {
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
            $('#buttonDeleteTouristSiteFacility').attr('action', '/touristsitefacility/' + id);
        });
    </script>
@endpush
@endsection