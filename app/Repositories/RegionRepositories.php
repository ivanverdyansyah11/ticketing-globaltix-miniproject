<?php

namespace App\Repositories;

use App\Models\Region;

class RegionRepositories
{
  public function __construct(
    protected readonly Region $region
  ) {}

  public function findAll()
  {
    return $this->region->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->region->with(['language'])->latest()->paginate(10);
  }

  public function findById(int $region_id): region
  {
    return $this->region->with(['language'])->where('id', $region_id)->first();
  }

  public function store($request): region
  {
    return $this->region->create($request);
  }

  public function update($request, $region): bool
  {
    return $region->update($request);
  }

  public function delete($region): bool
  {
    return $region->delete();
  }
}