<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => ['string', 'email', 'max:255',  Rule::unique(User::class)->ignore($this->user->id)],
            'address' => ['string', 'max:500'],
            'phone' => ['string', 'max:13'],
            'status' => ['required'],
        ];
    }
}
