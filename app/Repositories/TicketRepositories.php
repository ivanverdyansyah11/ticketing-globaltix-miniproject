<?php

namespace App\Repositories;

use App\Models\Ticket;

class TicketRepositories
{
  public function __construct(
    protected readonly Ticket $ticket
  ) {}

  public function findAll()
  {
    return $this->ticket->with(['touristSiteFacility.touristsite', 'category'])->latest()->get();
  }

  public function findAllPaginate()
  {
    return $this->ticket->with(['touristSiteFacility.touristsite', 'category'])->latest()->paginate(10);
  }

  public function findById(int $ticket_id): ticket
  {
    return $this->ticket->with(['touristSiteFacility.touristsite', 'category'])->where('id', $ticket_id)->first();
  }

  public function findByTouristSiteFacilitiesId(int $tourist_site_facilities_id, int $ticket_categories_id): ticket
  {
    return $this->ticket->where('tourist_site_facilities_id', $tourist_site_facilities_id)->where('ticket_categories_id', $ticket_categories_id)->first();
  }

  public function store($request): ticket
  {
    return $this->ticket->create($request);
  }

  public function update($request, $ticket): bool
  {
    return $ticket->update($request);
  }

  public function delete($ticket): bool
  {
    return $ticket->delete();
  }
}