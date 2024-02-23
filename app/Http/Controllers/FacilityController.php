<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Facility;
use App\Repositories\FacilityRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function __construct(
        protected readonly FacilityRepositories $facility,
    ) {}

    public function index() : View {
        return view('facility.index', [
            'title' => 'Facility Page',
            'facilities' => $this->facility->findAllPaginate(),
        ]);
    }

    public function show(Facility $facility) : JsonResponse {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->facility->findById($facility->id),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Facility with ID ' . $facility->id,
            ], 500);
        }
    }

    public function store(StoreFacilityRequest $request) : RedirectResponse {
        try {
            $this->facility->store($request->validated());
            return redirect(route('facility.index'))->with('success', 'Successfully Add New Facility!');
        } catch (\Throwable $th) {
            return redirect(route('facility.index'))->with('failed', 'Failed Add New Facility!');
        }
    }

    public function update(UpdateFacilityRequest $request, Facility $facility) : RedirectResponse {
        try {                     
            $this->facility->update($request->validated(), $facility);
            return redirect(route('facility.index'))->with('success', 'Successfully Update Facility!');
        } catch (\Exception $e) {
            return redirect(route('facility.index'))->with('failed', 'Failed Update Facility!');
        }
    }

    public function destroy(Facility $facility) : RedirectResponse {
        try {
            $this->facility->delete($facility);
            return redirect(route('facility.index'))->with('success', 'Successfully Delete Facility!');
        } catch (\Throwable $th) {
            return redirect(route('facility.index'))->with('failed', 'Failed Delete Facility!');
        }
    }
}
