<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $group = $this->route('group');
        
        return [
            'name' => 'required|string|max:255|unique:groups,name,' . $group->id,
            'brand_ids' => 'nullable|array',
            'brand_ids.*' => 'integer|exists:brands,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do grupo é obrigatório.',
            'name.unique'   => 'Já existe um grupo com este nome.',
        ];
    }
}