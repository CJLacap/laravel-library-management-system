<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class LibrarianUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        
        return [
            'first_name' => ['string', 'min:2'],
            'last_name' => ['string', 'min:2'],
            'email' => ['string', 'email', 'max:255',  Rule::unique(User::class)->ignore($this->librarian->id)],
            'address' => ['max:255'],
            'phone' => ['max:13'],
            'status' => ['required'],

        ];
    }
}
