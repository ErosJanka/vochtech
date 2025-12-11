<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCollaboratorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Para funcionar tanto no CREATE quanto no UPDATE
        $collaboratorId = $this->route('collaborator') ? $this->route('collaborator')->id : null;
        
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:collaborators,email,' . $collaboratorId,
            'cpf'     => [
                'required',
                'string',
                'unique:collaborators,cpf,' . $collaboratorId,
                function ($attribute, $value, $fail) {
                    // Remove formatação
                    $cpf = preg_replace('/[^0-9]/', '', $value);
                    
                    // Verifica se tem 11 dígitos
                    if (strlen($cpf) !== 11) {
                        $fail('CPF deve ter 11 dígitos.');
                        return;
                    }
                    
                    // Verifica se todos os dígitos são iguais
                    if (preg_match('/(\d)\1{10}/', $cpf)) {
                        $fail('CPF inválido (números repetidos).');
                        return;
                    }
                    
                    // Validação do CPF usando algoritmo
                    if (!$this->validarCPF($cpf)) {
                        $fail('CPF inválido.');
                    }
                }
            ],
            'unit_id' => 'required|exists:units,id',
        ];
    }

    /**
     * Função para validar CPF usando algoritmo oficial
     */
    private function validarCPF(string $cpf): bool
    {
        // Algoritmo de validação de CPF
        $digitos = str_split($cpf);
        
        // Primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 9; $i++) {
            $soma += $digitos[$i] * (10 - $i);
        }
        
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;
        
        if ($digitos[9] != $digito1) {
            return false;
        }
        
        // Segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 10; $i++) {
            $soma += $digitos[$i] * (11 - $i);
        }
        
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;
        
        return $digitos[10] == $digito2;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Informe um email válido.',
            'email.unique' => 'Este email já está cadastrado.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'unit_id.required' => 'A unidade é obrigatória.',
            'unit_id.exists' => 'A unidade selecionada não existe.',
        ];
    }
}