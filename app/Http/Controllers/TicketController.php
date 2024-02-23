<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TouristSiteFacility;
use App\Repositories\TicketCategoryRepositories;
use App\Repositories\TicketRepositories;
use App\Repositories\TouristSiteFacilityRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(
        protected readonly TicketRepositories $ticket,
        protected readonly TouristSiteFacilityRepositories $touristsitefacility,
        protected readonly TicketCategoryRepositories $ticketcategory,
    ) {}

    public function index() : View {
        return view('ticket.index', [
            'title' => 'Ticket  Page',
            'tickets' => $this->ticket->findAllPaginate(),
            'tourist_site_facilities' => $this->touristsitefacility->findAll(),
            'categories' => $this->ticketcategory->findAll(),
        ]);
    }

    public function show(Ticket $ticket) : JsonResponse {
        $ticket = $this->ticket->findById($ticket->id);
        $tourist_site_facilities = $this->touristsitefacility->findAll();
        $categories = $this->ticketcategory->findAll();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$ticket, $tourist_site_facilities, $categories],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Ticket  with ID ' . $ticket->id,
            ], 404);
        }
    }

    public function store(StoreTicketRequest $request) : RedirectResponse {
        try {
            $ticketExist = Ticket::where('tourist_site_facilities_id', $request->tourist_site_facilities_id)->where('ticket_categories_id', $request->ticket_categories_id)->first();
            if ($ticketExist) {
                return redirect(route('ticket.index'))->with('failed', 'Ticket is Already Exist!');
            }
            $this->ticket->store($request->validated());
            return redirect(route('ticket.index'))->with('success', 'Successfully Add New Ticket!');
        } catch (\Throwable $th) {
            return redirect(route('ticket.index'))->with('failed', 'Failed Add New Ticket!');
        }
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket) : RedirectResponse {
        try {
            $ticketExist = Ticket::where('tourist_site_facilities_id', $request->tourist_site_facilities_id)->where('ticket_categories_id', $request->ticket_categories_id)->first();
            if ($ticket->id == $ticketExist->id) {
                $this->ticket->update($request->validated(), $ticket);
                return redirect(route('ticket.index'))->with('success', 'Successfully Update Ticket!');
            }
            return redirect(route('ticket.index'))->with('failed', 'Cannot Update Ticket if The Ticket Category Already Exists!');
        } catch (\Throwable $th) {
            return redirect(route('ticket.index'))->with('failed', 'Failed Update Ticket!');
        }
    }

    public function destroy(Ticket $ticket) : RedirectResponse {
        try {
            $this->ticket->delete($ticket);
            return redirect(route('ticket.index'))->with('success', 'Successfully Delete Ticket!');
        } catch (\Throwable $th) {
            return redirect(route('ticket.index'))->with('failde', 'Failed Delete Ticket!');
        }
    }
}
