<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\TouristSiteFacility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index() : View {
        return view('ticket.index', [
            'title' => 'Ticket  Page',
            'tickets' => Ticket::with(['touristSiteFacility.touristsite', 'category'])->orderBy('created_at', 'DESC')->paginate(10),
            'tourist_site_facilities' => TouristSiteFacility::with(['touristsite'])->get(),
            'categories' => TicketCategory::all(),
        ]);
    }

    public function detail($id) : JsonResponse {
        $ticket = Ticket::with(['touristSiteFacility.touristsite', 'category'])->where('id', $id)->first();
        $tourist_site_facilities = TouristSiteFacility::with(['touristsite'])->get();
        $categories = TicketCategory::all();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$ticket, $tourist_site_facilities, $categories],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Ticket  with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreTicketRequest $request) : RedirectResponse {
        try {
            $ticketExist = Ticket::where('tourist_site_facilities_id', $request->tourist_site_facilities_id)->where('ticket_categories_id', $request->ticket_categories_id)->first();
            if ($ticketExist) {
                return redirect(route('ticket'))->with('failed', 'Ticket is Already Exist!');
            }
            Ticket::create($request->all());

            return redirect(route('ticket'))->with('success', 'Successfully Add New Ticket!');
        } catch (\Throwable $th) {
            return redirect(route('ticket'))->with('failed', 'Failed Add New Ticket!');
        }
    }

    public function update(UpdateTicketRequest $request, $id) : RedirectResponse {
        $ticket = Ticket::where('id', $id)->first();

        try {
            $ticketExist = Ticket::where('tourist_site_facilities_id', $request->tourist_site_facilities_id)->where('ticket_categories_id', $request->ticket_categories_id)->first();
            if ($ticket->id == $ticketExist->id) {
                $ticket->update($request->all());
                return redirect(route('ticket'))->with('success', 'Successfully Update Ticket!');
            }

            return redirect(route('ticket'))->with('failed', 'Cannot Update Ticket if The Ticket Category Already Exists!');
        } catch (\Throwable $th) {
            return redirect(route('ticket'))->with('failed', 'Failed Update Ticket!');
        }
    }

    public function delete($id) : RedirectResponse {
        $ticket = Ticket::where('id', $id)->first();

        try {
            $ticket->delete();

            return redirect(route('ticket'))->with('success', 'Successfully Delete Ticket!');
        } catch (\Throwable $th) {
            return redirect(route('ticket'))->with('failde', 'Failed Delete Ticket!');
        }
    }
}
