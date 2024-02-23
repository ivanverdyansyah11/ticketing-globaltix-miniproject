<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;
use App\Models\Language;
use App\Models\Region;
use App\Repositories\LanguageRepositories;
use App\Repositories\RegionRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegionController extends Controller
{
    public function __construct(
        protected readonly RegionRepositories $region,
        protected readonly LanguageRepositories $language,
    ) {}

    public function index() : View {
        return view('region.index', [
            'title' => 'Language Page',
            'regions' => $this->region->findAllPaginate(),
            'languages' => $this->language->findAll(),
        ]);
    }

    public function show(Region $region) : JsonResponse {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->region->findById($region->id),
                'languages' => $this->language->findAll(),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Region with ID ' . $region->id,
            ], 500);
        }
    }

    public function store(StoreRegionRequest $request) : RedirectResponse {
        try {
            $this->region->store($request->validated());
            return redirect(route('region.index'))->with('success', 'Successfully Add New Region!');
        } catch (\Exception $e) {  
            logger($e->getMessage());
            return redirect(route('region.index'))->with('failed', 'Failed Add New Region!');
        }
    }

    public function update(UpdateRegionRequest $request, Region $region) : RedirectResponse {
        try {                     
            $this->region->update($request->validated(), $region);
            return redirect(route('region.index'))->with('success', 'Successfully Update Region!');
        } catch (\Exception $e) {
            return redirect(route('region.index'))->with('failed', 'Failed Update Region!');
        }
    }

    public function destroy(Region $region) : RedirectResponse {
        try {
            $this->region->delete($region);
            return redirect(route('region.index'))->with('success', 'Successfully Delete Region!');
        } catch (\Exception $e) {            
            return redirect(route('region.index'))->with('failed', 'Failed Delete Region!');
        }
    }
}
