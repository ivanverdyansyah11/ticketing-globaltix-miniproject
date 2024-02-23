<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketCategoryRequest;
use App\Http\Requests\UpdateTicketCategoryRequest;
use App\Models\TicketCategory;
use App\Repositories\TicketCategoryRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketCategoryController extends Controller
{
    public function __construct(
        protected readonly TicketCategoryRepositories $ticketcategory,
    ) {}

    public function index() : View {
        return view('ticket-category.index', [
            'title' => 'Ticket Category Page',
            'ticket_categories' => $this->ticketcategory->findAllPaginate(),
        ]);
    }

    public function show(TicketCategory $ticketcategory) : JsonResponse {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->ticketcategory->findById($ticketcategory->id),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Ticket Category with ID ' . $ticketcategory->id,
            ], 404);
        }
    }

    public function store(StoreTicketCategoryRequest $request) : RedirectResponse {
        try {
            $this->ticketcategory->store($request->validated());
            return redirect(route('ticketcategory.index'))->with('success', 'Successfully Add New Ticket Category!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('ticketcategory.index'))->with('failed', 'Failed Add New Ticket Category!');
        }
    }

    public function update(UpdateTicketCategoryRequest $request, TicketCategory $ticketcategory) : RedirectResponse {
        try {
            $this->ticketcategory->update($request->validated(), $ticketcategory);
            return redirect(route('ticketcategory.index'))->with('success', 'Successfully Update Ticket Category!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('ticketcategory.index'))->with('failed', 'Failed Update Ticket Category!');
        }
    }

    public function destroy(TicketCategory $ticketcategory) : RedirectResponse {
        try {
            $this->ticketcategory->delete($ticketcategory);
            return redirect(route('ticketcategory.index'))->with('success', 'Successfully Delete Ticket Category!');
        } catch (\Exception $e) {
            logger($e->getMessage());
            return redirect(route('ticketcategory.index'))->with('failde', 'Failed Delete Ticket Category!');
        }
    }
}
