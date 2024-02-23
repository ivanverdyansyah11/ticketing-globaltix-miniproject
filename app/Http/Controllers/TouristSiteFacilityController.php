<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTouristSiteFacilityRequest;
use App\Http\Requests\UpdateTouristSiteFacilityRequest;
use App\Models\TouristSiteFacility;
use App\Repositories\FacilityRepositories;
use App\Repositories\TouristSiteFacilityRepositories;
use App\Repositories\TouristSiteRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TouristSiteFacilityController extends Controller
{
    public function __construct(
        protected readonly TouristSiteFacilityRepositories $touristsitefacility,
        protected readonly TouristSiteRepositories $touristsite,
        protected readonly FacilityRepositories $facility,
    ) {}

    public function index() : View {
        return view('tourist-site-facility.index', [
            'title' => 'Tourist Site Facility Page',
            'tourist_site_facilities' => $this->touristsitefacility->findAllPaginate(),
            'tourist_sites' => $this->touristsite->findAll(),
            'facilities' => $this->facility->findAll(),
        ]);
    }

    public function show(TouristSiteFacility $touristsitefacility) : JsonResponse {
        $tourist_site_facility = $this->touristsitefacility->findById($touristsitefacility->id);
        $tourist_sites = $this->touristsite->findAll();
        $facilities = $this->facility->findAll();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$tourist_site_facility, $facilities, $tourist_sites],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Tourist Site Facility with ID ' . $touristsitefacility->id,
            ], 404);
        }
    }

    public function store(StoreTouristSiteFacilityRequest $request) : RedirectResponse {
        try {
            $this->touristsitefacility->store($request->validated());
            return redirect(route('touristsitefacility.index'))->with('success', 'Successfully Add New Tourist Site Facility!');
        } catch (\Throwable $th) {
            return redirect(route('touristsitefacility.index'))->with('failed', 'Failed Add New Tourist Site Facility!');
        }
    }

    public function update(UpdateTouristSiteFacilityRequest $request, TouristSiteFacility $touristsitefacility) : RedirectResponse {
        try {
            $this->touristsitefacility->update($request->validated(), $touristsitefacility);
            return redirect(route('touristsitefacility.index'))->with('success', 'Successfully Update Tourist Site Facility!');
        } catch (\Throwable $th) {
            return redirect(route('touristsitefacility.index'))->with('failed', 'Failed Update Tourist Site Facility!');
        }
    }

    public function destroy(TouristSiteFacility $touristsitefacility) : RedirectResponse {
        try {
            $this->touristsitefacility->delete($touristsitefacility);
            return redirect(route('touristsitefacility.index'))->with('success', 'Successfully Delete Tourist Site Facility!');
        } catch (\Throwable $th) {
            return redirect(route('touristsitefacility.index'))->with('failde', 'Failed Delete Tourist Site Facility!');
        }
    }
}
