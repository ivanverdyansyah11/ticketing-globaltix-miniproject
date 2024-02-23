<?php

namespace App\Repositories;

use App\Models\TouristSite;

class TouristSiteRepositories
{
  public function __construct(
    protected readonly TouristSite $toursite
  ) {}

  public function findAll()
  {
    return $this->toursite->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->toursite->with(['regioncategory.region'])->latest()->paginate(10);
  }

  public function findById(int $touristsite_id): touristsite
  {
    return $this->toursite->with(['regioncategory.region'])->where('id', $touristsite_id)->first();
  }

  public function store($request): touristsite
  {
    return $this->toursite->create($request);
  }

  public function update($request, $toursite): bool
  {
    return $toursite->update($request);
  }

  public function delete($toursite): bool
  {
    return $toursite->delete();
  }
}