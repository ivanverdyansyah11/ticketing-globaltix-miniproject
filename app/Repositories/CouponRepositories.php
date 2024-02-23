<?php

namespace App\Repositories;

use App\Models\Coupon;

class CouponRepositories
{
  public function __construct(
    protected readonly Coupon $coupon
  ) {}

  public function findAll()
  {
    return $this->coupon->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->coupon->latest()->paginate(10);
  }

  public function findById(int $coupon_id): coupon
  {
    return $this->coupon->where('id', $coupon_id)->first();
  }

  public function store($request): coupon
  {
    return $this->coupon->create($request);
  }

  public function update($request, $coupon): bool
  {
    return $coupon->update($request);
  }

  public function delete($coupon): bool
  {
    return $coupon->delete();
  }
}