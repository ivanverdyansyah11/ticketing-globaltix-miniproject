@extends('layouts.main')

@section('content-dashboard')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body px-3 px-md-4">
            <div class="wrapper d-flex align-items-center justify-content-between mb-3">
                <h5 class="card-title fw-semibold mb-0 d-none d-md-inline-block">Data All Coupon</h5>
                <button type="button" class="btn btn-primary d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#createModal">
                    <span>Add Coupon</span>
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
                                <h6 class="fw-semibold mb-0">Coupon Code</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Discount Percentage</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Start Date</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Expired Date</h6>
                            </th>
                            <th class="border-bottom-0" style="width:180px !important;">
                                <h6 class="fw-semibold mb-0"></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($coupons->count() == 0)
                            <tr>
                                <td>Data Coupon Not Found!</td>
                            </tr>
                        @else
                            @foreach ($coupons as $i => $coupon)
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $i + 1 }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $coupon->coupon_code }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ $coupon->discount_percentage }}%</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $coupon->start_date)->format('l, j F Y') }}</h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="mb-0 fw-normal">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $coupon->expired_date)->format('l, j F Y') }}</h6>
                                    </td>
                                    <td class="border-bottom-0" style="width:180px !important;">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $coupon->id }}">
                                            <span>
                                                <i class="ti ti-id"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $coupon->id }}">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $coupon->id }}">
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
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.coupon')
@push('js')
    <script>
        $(document).on('click', '[data-bs-target="#detailModal"]', function() {
            let id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '/coupon/detail/' + id,
                success: function(coupon) {
                    if (coupon.status == 'success') {
                        $('[data-value="coupon_code"]').val(coupon.data.coupon_code);
                        $('[data-value="discount_percentage"]').val(coupon.data.discount_percentage);
                        $('[data-value="start_date"]').val(coupon.data.start_date);
                        $('[data-value="expired_date"]').val(coupon.data.expired_date);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#editModal"]', function() {
            let id = $(this).data('id');
            $('#buttonEditCoupon').attr('action', '/coupon/edit/' + id);
            $.ajax({
                type: 'get',
                url: '/coupon/detail/' + id,
                success: function(coupon) {
                    if (coupon.status == 'success') {
                        $('[data-value="coupon_code"]').val(coupon.data.coupon_code);
                        $('[data-value="discount_percentage"]').val(coupon.data.discount_percentage);
                        $('[data-value="start_date"]').val(coupon.data.start_date);
                        $('[data-value="expired_date"]').val(coupon.data.expired_date);
                    }
                }
            });
        });

        $(document).on('click', '[data-bs-target="#deleteModal"]', function() {
            let id = $(this).data('id');
            $('#buttonDeleteCoupon').attr('action', '/coupon/delete/' + id);
        });
    </script>
@endpush
@endsection