<?php

namespace App\Repositories;

use App\Models\RegionCategory;

class RegionCategoryRepositories
{
  public function __construct(
    protected readonly RegionCategory $regioncategory
  ) {}

  public function findAll()
  {
    return $this->regioncategory->with(['region', 'category'])->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->regioncategory->with(['region', 'category'])->latest()->paginate(10);
  }

  public function findById(int $regioncategory_id): regioncategory
  {
    return $this->regioncategory->with(['region', 'category'])->where('id', $regioncategory_id)->first();
  }

  public function store($request): regioncategory
  {
    $request['categories_id'] = implode(',', $request['categories_id']);
    return $this->regioncategory->create($request);
  }

  public function update($request, $regioncategory): bool
  {
    $request['categories_id'] = implode(',', $request['categories_id']);
    return $regioncategory->update($request);
  }

  public function delete($regioncategory): bool
  {
    return $regioncategory->delete();
  }
}