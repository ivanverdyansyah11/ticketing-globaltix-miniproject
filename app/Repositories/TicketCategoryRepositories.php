<?php

namespace App\Repositories;

use App\Models\TicketCategory;

class TicketCategoryRepositories
{
  public function __construct(
    protected readonly TicketCategory $ticketcategory
  ) {}

  public function findAll()
  {
    return $this->ticketcategory->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->ticketcategory->latest()->paginate(10);
  }

  public function findById(int $ticketcategory_id): ticketcategory
  {
    return $this->ticketcategory->where('id', $ticketcategory_id)->first();
  }

  public function store($request): ticketcategory
  {
    return $this->ticketcategory->create($request);
  }

  public function update($request, $ticketcategory): bool
  {
    return $ticketcategory->update($request);
  }

  public function delete($ticketcategory): bool
  {
    return $ticketcategory->delete();
  }
}