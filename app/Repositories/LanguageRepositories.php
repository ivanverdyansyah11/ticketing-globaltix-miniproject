<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepositories
{
  public function __construct(
    protected readonly Language $language
  ) {}

  public function findAll()
  {
    return $this->language->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->language->latest()->paginate(10);
  }

  public function findById(int $language_id): language
  {
    return $this->language->where('id', $language_id)->first();
  }

  public function store($request): language
  {
    return $this->language->create($request);
  }

  public function update($request, $language): bool
  {
    return $language->update($request);
  }

  public function delete($language): bool
  {
    return $language->delete();
  }
}