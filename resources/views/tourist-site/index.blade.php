@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Tourist Site</h5>
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span>Add Tourist Site</span>
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
                                <h6 class="fw-semibold mb-0">Region</h6>
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
                        @if ($tourist_sites->count() == 0)
                            <tr>
                                <td>Data Tourist Site Not Found!</td>
                            </tr>
                        @else
                            @foreach ($tourist_sites as $i => $tourist_site)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $tourist_site->regioncategory->region->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $tourist_site->name }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ Str::limit($tourist_site->description, '60') }}</p>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $tourist_site->id }}">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $tourist_site->id }}">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $tourist_site->id }}">
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
                    {{ $tourist_sites->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.tourist-site')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '/touristsite/' + id,
                success: function(touristsite) {
                    if (touristsite.status == 'success') {
                        $('[data-value="region_categories_id"]').val(touristsite.data[0].regioncategory.region.name);
                        $('[data-value="name"]').val(touristsite.data[0].name);
                        $('[data-value="description"]').html(touristsite.data[0].description);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#editModal"]', function() {
            let id = $(this).data('id');
            $('[data-element="row-edit-select"] option').remove();
            $('#buttonEditTouristSite').attr('action', '/touristsite/' + id);
            $.ajax({
                type: 'get',
                url: '/touristsite/' + id,
                success: function(touristsite) {
                    if (touristsite.status == 'success') {
                        touristsite.data[1].forEach(region_category => {
                            if (region_category.id === touristsite.data[0].region_categories_id) {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${region_category.region.id}" selected>${region_category.region.name}</option>`
                                );
                            } else {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${region_category.region.id}">${region_category.region.name}</option>`
                                );
                            }
                        });

                        $('[data-value="name"]').val(touristsite.data[0].name);
                        $('[data-value="description"]').html(touristsite.data[0].description);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteTouristSite').attr('action', '/touristsite/' + id);
        });
    </script>
@endpush
@endsection