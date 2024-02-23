<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTouristSiteRequest;
use App\Http\Requests\UpdateTouristSiteRequest;
use App\Models\RegionCategory;
use App\Models\TouristSite;
use App\Repositories\RegionCategoryRepositories;
use App\Repositories\TouristSiteRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TouristSiteController extends Controller
{
    public function __construct(
        protected readonly TouristSiteRepositories $touristsite,
        protected readonly RegionCategoryRepositories $regionCategory,
    ) {}

    public function index() : View {
        return view('tourist-site.index', [
            'title' => 'Tourist Site Page',
            'tourist_sites' => $this->touristsite->findAllPaginate(),
            'region_catergories' => $this->regionCategory->findAll(),
        ]);
    }

    public function show(TouristSite $touristsite) : JsonResponse {
        $tourist_site = $this->touristsite->findById($touristsite->id);
        $regionCategory = $this->regionCategory->findAll();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$tourist_site, $regionCategory],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Tourist Site with ID ' . $touristsite->id,
            ], 500);
        }
    }

    public function store(StoreTouristSiteRequest $request) : RedirectResponse {
        try {
            $this->touristsite->store($request->validated());
            return redirect(route('touristsite.index'))->with('success', 'Successfully Add New Tourist Site!');
        } catch (\Throwable $th) {
            return redirect(route('touristsite.index'))->with('failed', 'Failed Add New Tourist Site!');
        }
    }

    public function update(UpdateTouristSiteRequest $request, TouristSite $touristsite) : RedirectResponse {
        try {
            $this->touristsite->update($request->validated(), $touristsite);
            return redirect(route('touristsite.index'))->with('success', 'Successfully Update Tourist Site!');
        } catch (\Throwable $th) {
            return redirect(route('touristsite.index'))->with('failed', 'Failed Update Tourist Site!');
        }
    }

    public function destroy(TouristSite $touristsite) : RedirectResponse {
        try {
            $this->touristsite->delete($touristsite);
            return redirect(route('touristsite.index'))->with('success', 'Successfully Delete Tourist Site!');
        } catch (\Throwable $th) {
            return redirect(route('touristsite.index'))->with('failde', 'Failed Delete Tourist Site!');
        }
    }
}
