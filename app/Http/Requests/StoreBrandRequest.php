<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'group_id' => 'required|exists:groups,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da bandeira é obrigatório.',
            'group_id.required' => 'O grupo é obrigatório.',
            'group_id.exists' => 'O grupo selecionado não existe.',
        ];
    }
}