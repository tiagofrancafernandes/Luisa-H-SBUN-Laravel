<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return boolval(auth()?->user()?->isAdmin());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|min:1',
            'quantity' => 'integer|min:1',
            'reference' => 'string|min:1',
            'sinopsis' => 'string|min:1',
            'author_id' => 'required|integer|exists:App\Models\Author,id',
            'category_id' => 'required|integer|exists:App\Models\Category,id',
        ];
    }
}
