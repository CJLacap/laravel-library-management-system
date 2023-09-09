<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
            'cover' => ['mimes:jpeg,bmp,png,jpg','max:1000'],
            'title' => ['string', 'max:255'],
            'author' =>  ['string', 'max:255'],
            'isbn' =>  ['string', 'max:13', 'min:10'],
            'publisher' =>['string'],
            'publication_year',
            'copies',
        ];
    }
}
