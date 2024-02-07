<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTouristSiteRequest;
use App\Http\Requests\UpdateTouristSiteRequest;
use App\Models\RegionCategory;
use App\Models\TouristSite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TouristSiteController extends Controller
{
    public function index() : View {
        return view('tourist-site.index', [
            'title' => 'Tourist Site Page',
            'tourist_sites' => TouristSite::orderBy('created_at', 'DESC')->paginate(10),
            'region_catergories' => RegionCategory::with(['region'])->get(),
        ]);
    }

    public function detail($id) : JsonResponse {
        $tourist_site = TouristSite::with(['regioncategory.region'])->where('id', $id)->first();
        $regionCategory = RegionCategory::with(['region', 'category'])->get();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$tourist_site, $regionCategory],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Tourist Site with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreTouristSiteRequest $request) : RedirectResponse {
        try {
            TouristSite::create($request->all());

            return redirect(route('toursite'))->with('success', 'Successfully Add New Tourist Site!');
        } catch (\Throwable $th) {
            return redirect(route('toursite'))->with('failed', 'Failed Add New Tourist Site!');
        }
    }

    public function update(UpdateTouristSiteRequest $request, $id) : RedirectResponse {
        $tourist_site = TouristSite::where('id', $id)->first();

        try {
            $tourist_site->update($request->all());

            return redirect(route('toursite'))->with('success', 'Successfully Update Tourist Site!');

        } catch (\Throwable $th) {
            return redirect(route('toursite'))->with('failed', 'Failed Update Tourist Site!');
        }
    }

    public function delete($id) : RedirectResponse {
        $tourist_site = TouristSite::where('id', $id)->first();

        try {
            $tourist_site->delete();

            return redirect(route('toursite'))->with('success', 'Successfully Delete Tourist Site!');
        } catch (\Throwable $th) {
            return redirect(route('toursite'))->with('failde', 'Failed Delete Tourist Site!');
        }
    }
}
