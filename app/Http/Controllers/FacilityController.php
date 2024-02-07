<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFacilityRequest;
use App\Http\Requests\UpdateFacilityRequest;
use App\Models\Facility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    public function index() : View {
        return view('facility.index', [
            'title' => 'Facility Page',
            'facilities' => Facility::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) : JsonResponse {
        $facility = Facility::where('id', $id)->first();
        try {
            return response()->json([
                'status' => 'success',
                'data' => $facility,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Facility with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreFacilityRequest $request) : RedirectResponse {
        try {
            Facility::create($request->all());

            return redirect(route('facility'))->with('success', 'Successfully Add New Facility!');
        } catch (\Throwable $th) {
            return redirect(route('facility'))->with('failed', 'Failed Add New Facility!');
        }
    }

    public function update(UpdateFacilityRequest $request, $id) : RedirectResponse {
        $facility = Facility::where('id', $id)->first();

        try {
            $facility->update($request->all());

            return redirect(route('facility'))->with('success', 'Successfully Update Facility!');

        } catch (\Throwable $th) {
            return redirect(route('facility.edit', $id))->with('failed', 'Failed Update Facility!');
        }
    }

    public function delete($id) : RedirectResponse {
        $facility = Facility::where('id', $id)->first();

        try {
            $facility->delete();

            return redirect(route('facility'))->with('success', 'Successfully Delete Facility!');
        } catch (\Throwable $th) {
            return redirect(route('facility'))->with('failde', 'Failed Delete Facility!');
        }
    }
}
