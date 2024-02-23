<?php

namespace App\Repositories;

use App\Models\TouristSiteFacility;

class TouristSiteFacilityRepositories
{
  public function __construct(
    protected readonly TouristSiteFacility $touristsitefacility
  ) {}

  public function findAll()
  {
    return $this->touristsitefacility->with(['touristsite', 'facility'])->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->touristsitefacility->with(['touristsite', 'facility'])->latest()->paginate(10);
  }

  public function findById(int $touristsitefacility_id): touristsitefacility
  {
    return $this->touristsitefacility->with(['touristsite', 'facility'])->where('id', $touristsitefacility_id)->first();
  }

  public function store($request): touristsitefacility
  {
    $request['facilities_id'] = implode(',', $request['facilities_id']);
    return $this->touristsitefacility->create($request);
  }

  public function update($request, $touristsitefacility): bool
  {
    $request['facilities_id'] = implode(',', $request['facilities_id']);
    return $touristsitefacility->update($request);
  }

  public function delete($touristsitefacility): bool
  {
    return $touristsitefacility->delete();
  }
}