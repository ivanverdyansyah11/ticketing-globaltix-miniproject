<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index() : View {
        return view('category.index', [
            'title' => 'Category Page',
            'categories' => Category::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) : JsonResponse {
        $category = Category::where('id', $id)->first();
        try {
            return response()->json([
                'status' => 'success',
                'data' => $category,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Category with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreCategoryRequest $request) : RedirectResponse {
        try {
            Category::create($request->all());

            return redirect(route('category'))->with('success', 'Successfully Add New Category!');
        } catch (\Throwable $th) {
            return redirect(route('category'))->with('failed', 'Failed Add New Category!');
        }
    }

    public function update(UpdateCategoryRequest $request, $id) : RedirectResponse {
        $category = Category::where('id', $id)->first();

        try {
            $category->update($request->all());

            return redirect(route('category'))->with('success', 'Successfully Update Category!');

        } catch (\Throwable $th) {
            return redirect(route('Category'))->with('failed', 'Failed Update Category!');
        }
    }

    public function delete($id) : RedirectResponse {
        $category = Category::where('id', $id)->first();

        try {
            $category->delete();

            return redirect(route('category'))->with('success', 'Successfully Delete Category!');
        } catch (\Throwable $th) {
            return redirect(route('category'))->with('failde', 'Failed Delete Category!');
        }
    }
}
