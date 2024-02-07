<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTouristSiteFacilityRequest;
use App\Http\Requests\UpdateTouristSiteFacilityRequest;
use App\Models\Facility;
use App\Models\TouristSite;
use App\Models\TouristSiteFacility;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TouristSiteFacilityController extends Controller
{
    public function index() : View {
        return view('tourist-site-facility.index', [
            'title' => 'Tourist Site Facility Page',
            'tourist_site_facilities' => TouristSiteFacility::with(['touristsite', 'facility'])->orderBy('created_at', 'DESC')->paginate(10),
            'tourist_sites' => TouristSite::with(['regioncategory.region'])->get(),
            'facilities' => Facility::all(),
        ]);
    }

    public function detail($id) : JsonResponse {
        $tourist_site_facility = TouristSiteFacility::with(['touristsite', 'facility'])->where('id', $id)->first();
        $facilities = Facility::all();
        $tourist_sites = TouristSite::with(['regioncategory.region'])->get();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$tourist_site_facility, $facilities, $tourist_sites],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Tourist Site Facility with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreTouristSiteFacilityRequest $request) : RedirectResponse {
        try {
            $request['facilities_id'] = implode(',', $request['facilities_id']);
            TouristSiteFacility::create($request->all());

            return redirect(route('toursitefacility'))->with('success', 'Successfully Add New Tourist Site Facility!');
        } catch (\Throwable $th) {
            return redirect(route('toursitefacility'))->with('failed', 'Failed Add New Tourist Site Facility!');
        }
    }

    public function update(UpdateTouristSiteFacilityRequest $request, $id) : RedirectResponse {
        $tourist_site_facility = TouristSiteFacility::where('id', $id)->first();
        try {
            $request['facilities_id'] = implode(',', $request['facilities_id']);
            $tourist_site_facility->update($request->all());

            return redirect(route('toursitefacility'))->with('success', 'Successfully Update Tourist Site Facility!');

        } catch (\Throwable $th) {
            return redirect(route('toursitefacility'))->with('failed', 'Failed Update Tourist Site Facility!');
        }
    }

    public function delete($id) : RedirectResponse {
        $tourist_site_facility = TouristSiteFacility::where('id', $id)->first();

        try {
            $tourist_site_facility->delete();

            return redirect(route('toursitefacility'))->with('success', 'Successfully Delete Tourist Site Facility!');
        } catch (\Throwable $th) {
            return redirect(route('toursitefacility'))->with('failde', 'Failed Delete Tourist Site Facility!');
        }
    }
}
