<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Repositories\LanguageRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function __construct(
        protected readonly LanguageRepositories $language,
    ) {}

    public function index() : View {
        return view('language.index', [
            'title' => 'Language Page',
            'languages' => $this->language->findAllPaginate(),
        ]);
    }

    public function show(Language $language) : JsonResponse {
        try {
            return response()->json([
                'status' => 'success',
                'data' => $this->language->findById($language->id),
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Language with ID ' . $language->id,
            ], 500);
        }
    }

    public function store(StoreLanguageRequest $request) : RedirectResponse {
        try {                        
            $this->language->store($request->validated());
            return redirect(route('language.index'))->with('success', 'Successfully Add New Language!');
        } catch (\Exception $e) {  
            logger($e->getMessage());
            return redirect(route('language.index'))->with('failed', 'Failed Add New Language!');
        }
    }

    public function update(UpdateLanguageRequest $request, Language $language) : RedirectResponse {
        try {                     
            $this->language->update($request->validated(), $language);
            return redirect(route('language.index'))->with('success', 'Successfully Update Language!');
        } catch (\Exception $e) {
            return redirect(route('language.index'))->with('failed', 'Failed Update Language!');
        }
    }

    public function destroy(Language $language) : RedirectResponse {
        try {
            $this->language->delete($language);
            return redirect(route('language.index'))->with('success', 'Successfully Delete Language!');
        } catch (\Exception $e) {            
            return redirect(route('language.index'))->with('failed', 'Failed Delete Language!');
        }
    }
}
