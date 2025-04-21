<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuthorRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'max:45', 'required_without_all:email,bio'],
            'email' => ['nullable', 'email', 'unique:authors,email,' . $this->route('author'), 'required_without_all:name,bio'],
            'bio' => ['nullable', 'string', 'max:1000', 'required_without_all:name,email']
        ];
    }
}
