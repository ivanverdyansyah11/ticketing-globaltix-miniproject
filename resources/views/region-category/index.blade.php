@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Region Category</h5>
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span>Add Region Category</span>
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
                                <h6 class="fw-semibold mb-0">Category</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($region_categories->count() == 0)
                            <tr>
                                <td>Data Region Not Found!</td>
                            </tr>
                        @else
                            @foreach ($region_categories as $i => $region_category)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $region_category->region->name }}</h6>
                                    </td>
                                    @php
                                        $categoryArray = explode(',', $region_category->categories_id);
                                        $categorySelect = [];
                                    @endphp
                                    @foreach ($categories as $i => $category)
                                        @if (in_array($category->id, $categoryArray))
                                            @php
                                                $categorySelect[] = $category->name;
                                                $categoryName = implode(', ', $categorySelect);
                                            @endphp
                                        @endif
                                    @endforeach
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal">{{ $categoryName }}</p>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $region_category->id }}">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $region_category->id }}">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $region_category->id }}">
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
                    {{ $region_categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.region-category')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $('[data-element="row-detail-checkbox"] .col').remove();
            $.ajax({
                type: 'get',
                url: '/regioncategory/' + id,
                success: function(regionCategory) {
                    if (regionCategory.status == 'success') {
                        $('[data-value="regions_id"]').val(regionCategory.data[0].region.name);
                        let categoriesArray = regionCategory.data[0].categories_id.split(",");
                        categoriesArray = categoriesArray.map(function(string) {
                            return parseInt(string);
                        });
    
                        regionCategory.data[1].forEach(category => {
                            if (categoriesArray.includes(category.id)) {
                                $('[data-element="row-detail-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="categories_id[]" id="${category.name}" value="${category.name}" checked disabled>
                                        <label for="${category.name}">${category.name}</label>
                                    </div>`
                                )
                            } else {
                                $('[data-element="row-detail-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="categories_id[]" id="${category.name}" value="${category.name}" disabled>
                                        <label for="${category.name}">${category.name}</label>
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
            $('[data-element="row-edit-select"] option').remove();
            $('[data-element="row-edit-checkbox"] .col').remove();
            $('#buttonEditRegionCategory').attr('action', '/regioncategory/' + id);
            $.ajax({
                type: 'get',
                url: '/regioncategory/' + id,
                success: function(regionCategory) {
                    if (regionCategory.status == 'success') {
                        regionCategory.data[2].forEach(region => {
                            if (region.id === regionCategory.data[0].regions_id) {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${region.id}" selected>${region.name}</option>`
                                );
                            } else {
                                $('[data-element="row-edit-select"]').append(
                                    `<option value="${region.id}">${region.name}</option>`
                                );
                            }
                        });
    
                        let categoriesArray = regionCategory.data[0].categories_id.split(",");
                        categoriesArray = categoriesArray.map(function(string) {
                            return parseInt(string);
                        });
    
                        regionCategory.data[1].forEach(category => {
                            if (categoriesArray.includes(category.id)) {
                                $('[data-element="row-edit-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="categories_id[]" id="${category.name}" value="${category.id}" checked>
                                        <label for="${category.name}">${category.name}</label>
                                    </div>`
                                )
                            } else {
                                $('[data-element="row-edit-checkbox"]').append(
                                    `<div class="col mb-1">
                                        <input type="checkbox" name="categories_id[]" id="${category.name}" value="${category.id}">
                                        <label for="${category.name}">${category.name}</label>
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
            $('#buttonDeleteRegionCategory').attr('action', '/regioncategory/' + id);
        });
    </script>
@endpush
@endsection