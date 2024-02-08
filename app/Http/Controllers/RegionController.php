<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Language;
use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegionController extends Controller
{
    public function index() : View {
        return view('region.index', [
            'title' => 'Region Page',
            'regions' => Region::with(['language'])->orderBy('created_at', 'DESC')->paginate(10),
            'languages' => Language::all(),
        ]);
    }

    public function detail($id) : JsonResponse {
        $region = Region::with(['language'])->where('id', $id)->first();
        $languages = Language::all();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$region, $languages],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Region with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreRegionRequest $request) : RedirectResponse {
        try {
            Region::create($request->all());

            return redirect(route('region'))->with('success', 'Successfully Add New Region!');
        } catch (\Throwable $th) {
            return redirect(route('region'))->with('failed', 'Failed Add New Region!');
        }
    }

    public function update(UpdateRegionRequest $request, $id) : RedirectResponse {
        $region = Region::where('id', $id)->first();

        try {
            $region->update($request->all());

            return redirect(route('region'))->with('success', 'Successfully Update Region!');

        } catch (\Throwable $th) {
            return redirect(route('region'))->with('failed', 'Failed Update Region!');
        }
    }

    public function delete($id) : RedirectResponse {
        $region = Region::where('id', $id)->first();

        try {
            $region->delete();

            return redirect(route('region'))->with('success', 'Successfully Delete Region!');
        } catch (\Throwable $th) {
            return redirect(route('region'))->with('failde', 'Failed Delete Region!');
        }
    }
}
