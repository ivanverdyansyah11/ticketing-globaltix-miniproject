<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketCategoryRequest;
use App\Http\Requests\UpdateTicketCategoryRequest;
use App\Models\TicketCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketCategoryController extends Controller
{
    public function index() : View {
        return view('ticket-category.index', [
            'title' => 'Ticket Category Page',
            'ticket_categories' => TicketCategory::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) : JsonResponse {
        $ticket = TicketCategory::where('id', $id)->first();
        try {
            return response()->json([
                'status' => 'success',
                'data' => $ticket,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Ticket Category with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreTicketCategoryRequest $request) : RedirectResponse {
        try {
            TicketCategory::create($request->all());

            return redirect(route('ticketcategory'))->with('success', 'Successfully Add New Ticket Category!');
        } catch (\Throwable $th) {
            return redirect(route('ticketcategory'))->with('failed', 'Failed Add New Ticket Category!');
        }
    }

    public function update(UpdateTicketCategoryRequest $request, $id) : RedirectResponse {
        $ticket = TicketCategory::where('id', $id)->first();

        try {
            $ticket->update($request->all());

            return redirect(route('ticketcategory'))->with('success', 'Successfully Update Ticket Category!');

        } catch (\Throwable $th) {
            return redirect(route('ticketcategory'))->with('failed', 'Failed Update Ticket Category!');
        }
    }

    public function delete($id) : RedirectResponse {
        $ticket = TicketCategory::where('id', $id)->first();

        try {
            $ticket->delete();

            return redirect(route('ticketcategory'))->with('success', 'Successfully Delete Ticket Category!');
        } catch (\Throwable $th) {
            return redirect(route('ticketcategory'))->with('failde', 'Failed Delete Ticket Category!');
        }
    }
}
