<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionCategoryRequest;
use App\Http\Requests\UpdateRegionCategoryRequest;
use App\Models\RegionCategory;
use App\Repositories\CategoryRepositories;
use App\Repositories\RegionCategoryRepositories;
use App\Repositories\RegionRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegionCategoryController extends Controller
{
    public function __construct(
        protected readonly RegionCategoryRepositories $regioncategory,
        protected readonly RegionRepositories $region,
        protected readonly CategoryRepositories $category,
    ) {}

    public function index() : View {
        return view('region-category.index', [
            'title' => 'Region Category Page',
            'region_categories' => $this->regioncategory->findAllPaginate(),
            'regions' => $this->region->findAll(),
            'categories' => $this->category->findAll(),
        ]);
    }

    public function show(RegionCategory $regioncategory) : JsonResponse {
        $regioncategory = $this->regioncategory->findById($regioncategory->id);
        $regions = $this->region->findAll();
        $categories = $this->category->findAll();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$regioncategory, $categories, $regions],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Region Category with ID ' . $regioncategory->id,
            ], 500);
        }
    }

    public function store(StoreRegionCategoryRequest $request) : RedirectResponse {
        try {
            $this->regioncategory->store($request->validated());

            return redirect(route('regioncategory.index'))->with('success', 'Successfully Add New Region Category!');
        } catch (\Throwable $th) {
            return redirect(route('regioncategory.index'))->with('failed', 'Failed Add New Region Category!');
        }
    }

    public function update(UpdateRegionCategoryRequest $request, RegionCategory $regioncategory) : RedirectResponse {
        try {
            $this->regioncategory->update($request->validated(), $regioncategory);

            return redirect(route('regioncategory.index'))->with('success', 'Successfully Update Region Category!');
        } catch (\Throwable $th) {
            return redirect(route('regioncategory.index'))->with('failed', 'Failed Update Region Category!');
        }
    }

    public function destroy(RegionCategory $regioncategory) : RedirectResponse {
        try {
            $this->regioncategory->delete($regioncategory);
            return redirect(route('regioncategory.index'))->with('success', 'Successfully Delete Region Category!');
        } catch (\Exception $e) {            
            return redirect(route('regioncategory.index'))->with('failed', 'Failed Delete Region Category!');
        }
    }
}
