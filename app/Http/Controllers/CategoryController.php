<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        protected readonly CategoryRepositories $category,
    ) {}

    public function index() : View {
        $categories = $this->category->findAllPaginate();
        return view('category.index', [
            'title' => 'Category Page',
            'categories' => $categories,
        ]);
    }

    public function show(Category $category) : JsonResponse {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->category->findById($category->id),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Category with ID ' . $category->id,
            ], 500);
        }
    }

    public function store(StoreCategoryRequest $request) : RedirectResponse {
        try {
            $this->category->store($request->validated());
            return redirect(route('category.index'))->with('success', 'Successfully Add New Category!');
        } catch (\Exception $e) {  
            logger($e->getMessage());
            return redirect(route('category.index'))->with('failed', 'Failed Add New Category!');
        }
    }

    public function update(UpdateCategoryRequest $request, Category $category) : RedirectResponse {
        try {                     
            $this->category->update($request->validated(), $category);
            return redirect(route('category.index'))->with('success', 'Successfully Update Category!');
        } catch (\Exception $e) {
            return redirect(route('category.index'))->with('failed', 'Failed Update Category!');
        }
    }

    public function destroy(Category $category) : RedirectResponse {
        try {
            $this->category->delete($category);
            return redirect(route('category.index'))->with('success', 'Successfully Delete Category!');
        } catch (\Exception $e) {            
            return redirect(route('category.index'))->with('failed', 'Failed Delete Category!');
        }
    }
}
