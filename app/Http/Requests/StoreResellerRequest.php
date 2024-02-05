<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:3',
            'number_phone' => 'required|max:13',
            'address' => 'required',
        ];
    }

    // public function attributes()
    // {
    //     return [
    //         'name' => 'name',
    //         'email' => 'email',
    //         'password' => 'password',
    //         'number_phone' => 'number_phone',
    //         'address' => 'address',
    //     ];
    // }
}
