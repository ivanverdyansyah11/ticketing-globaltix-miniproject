<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{
    public function index() : View {
        return view('language.index', [
            'title' => 'Language Page',
            'languages' => Language::orderBy('created_at', 'DESC')->paginate(10),
        ]);
    }

    public function detail($id) : JsonResponse {
        $language = Language::where('id', $id)->first();
        try {
            return response()->json([
                'status' => 'success',
                'data' => $language,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to get data for Language with ID ' . $id,
            ], 404);
        }
    }

    public function store(StoreLanguageRequest $request) : RedirectResponse {
        try {
            Language::create($request->all());

            return redirect(route('language'))->with('success', 'Successfully Add New Language!');
        } catch (\Throwable $th) {
            return redirect(route('language'))->with('failed', 'Failed Add New Language!');
        }
    }

    public function update(UpdateLanguageRequest $request, $id) : RedirectResponse {
        $language = Language::where('id', $id)->first();

        try {
            $language->update($request->all());

            return redirect(route('language'))->with('success', 'Successfully Update Language!');

        } catch (\Throwable $th) {
            return redirect(route('language'))->with('failed', 'Failed Update Language!');
        }
    }

    public function delete($id) : RedirectResponse {
        $language = Language::where('id', $id)->first();

        try {
            $language->delete();

            return redirect(route('language'))->with('success', 'Successfully Delete Language!');
        } catch (\Throwable $th) {
            return redirect(route('language'))->with('failde', 'Failed Delete Language!');
        }
    }
}
