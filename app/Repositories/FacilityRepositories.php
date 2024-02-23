<?php

namespace App\Repositories;

use App\Models\Facility;

class FacilityRepositories
{
  public function __construct(
    protected readonly Facility $facility
  ) {}

  public function findAll()
  {
    return $this->facility->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->facility->latest()->paginate(10);
  }

  public function findById(int $facility_id): facility
  {
    return $this->facility->where('id', $facility_id)->first();
  }

  public function store($request): facility
  {
    return $this->facility->create($request);
  }

  public function update($request, $facility): bool
  {
    return $facility->update($request);
  }

  public function delete($facility): bool
  {
    return $facility->delete();
  }
}