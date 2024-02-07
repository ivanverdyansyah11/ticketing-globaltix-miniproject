<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRegionCategoryRequest;
use App\Http\Requests\UpdateRegionCategoryRequest;
use App\Models\Category;
use App\Models\Region;
use App\Models\RegionCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegionCategoryController extends Controller
{
    public function index() : View {
        return view('region-category.index', [
            'title' => 'Region Category Page',
            'region_categories' => RegionCategory::orderBy('created_at', 'DESC')->paginate(10),
            'regions' => Region::all(),
            'categories' => Category::all(),
        ]);
    }

    public function detail($id) : JsonResponse {
        $regionCategory = RegionCategory::with(['region', 'category'])->where('id', $id)->first();
        $categories = Category::all();
        $regions = Region::all();
        try {
            return response()->json([
                'status' => 'success',
                'data' => [$regionCategory, $categories, $regions],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Region Category with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreRegionCategoryRequest $request) : RedirectResponse {
        try {
            $request['categories_id'] = implode(',', $request['categories_id']);
            RegionCategory::create($request->all());

            return redirect(route('region_category'))->with('success', 'Successfully Add New Region Category!');
        } catch (\Throwable $th) {
            return redirect(route('region_category'))->with('failed', 'Failed Add New Region Category!');
        }
    }

    public function update(UpdateRegionCategoryRequest $request, $id) : RedirectResponse {
        $regionCategory = RegionCategory::where('id', $id)->first();

        try {
            $request['categories_id'] = implode(',', $request['categories_id']);
            $regionCategory->update($request->all());

            return redirect(route('region_category'))->with('success', 'Successfully Update Region Category!');

        } catch (\Throwable $th) {
            return redirect(route('region_category'))->with('failed', 'Failed Update Region Category!');
        }
    }

    public function delete($id) : RedirectResponse {
        $regionCategory = RegionCategory::where('id', $id)->first();

        try {
            $regionCategory->delete();

            return redirect(route('region_category'))->with('success', 'Successfully Delete Region Category!');
        } catch (\Throwable $th) {
            return redirect(route('region_category'))->with('failde', 'Failed Delete Region Category!');
        }
    }
}
