<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepositories
{
  public function __construct(
    protected readonly Category $category
  ) {}

  public function findAll()
  {
    return $this->category->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->category->latest()->paginate(10);
  }

  public function findById(int $category_id): category
  {
    return $this->category->where('id', $category_id)->first();
  }

  public function store($request): category
  {
    return $this->category->create($request);
  }

  public function update($request, $category): bool
  {
    return $category->update($request);
  }

  public function delete($category): bool
  {
    return $category->delete();
  }
}