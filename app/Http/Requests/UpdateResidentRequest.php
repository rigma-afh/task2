<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResidentRequest extends FormRequest
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
      // Assuming 'resident' is the route parameter name
        return [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'address' => 'required|string',
        'phone' => 'required|string|max:20',
        'gender' => 'required|in:Male,Female',
        ];
    }
}
