<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Para funcionar tanto no CREATE quanto no UPDATE
        $unitId = $this->route('unit') ? $this->route('unit')->id : null;
        
        return [
            'nome_fantasia' => 'required|string|max:255',
            'razao_social'  => 'required|string|max:255',
            'cnpj' => [
                'required',
                'string',
                'unique:units,cnpj,' . $unitId,
                function ($attribute, $value, $fail) {
                    // Remove formatação
                    $cnpj = preg_replace('/[^0-9]/', '', $value);
                    
                    // Verifica se tem 14 dígitos
                    if (strlen($cnpj) !== 14) {
                        $fail('CNPJ deve ter 14 dígitos.');
                        return;
                    }
                    
                    // Verifica se todos os dígitos são iguais
                    if (preg_match('/(\d)\1{13}/', $cnpj)) {
                        $fail('CNPJ inválido (números repetidos).');
                        return;
                    }
                    
                    // Validação do CNPJ usando algoritmo
                    if (!$this->validarCNPJ($cnpj)) {
                        $fail('CNPJ inválido.');
                    }
                }
            ],
            'brand_id' => 'required|exists:brands,id',
        ];
    }

    /**
     * Função para validar CNPJ usando algoritmo oficial
     */
    /**
     * Valida CNPJ usando algoritmo oficial de dígitos verificadores
     * 
     * - Verifica os dois dígitos verificadores usando mod 11
     * - Segue a regra: número inválido = resto < 2 ? 0 : 11 - resto
     */
    private function validarCNPJ(string $cnpj): bool
    {
        $digitos = str_split($cnpj);
        
        // Primeiro dígito verificador
        $soma = 0;
        $pesos = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        
        for ($i = 0; $i < 12; $i++) {
            $soma += $digitos[$i] * $pesos[$i];
        }
        
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;
        
        if ($digitos[12] != $digito1) {
            return false;
        }
        
        // Segundo dígito verificador
        $soma = 0;
        $pesos = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        
        for ($i = 0; $i < 13; $i++) {
            $soma += $digitos[$i] * $pesos[$i];
        }
        
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;
        
        return $digitos[13] == $digito2;
    }

    public function messages(): array
    {
        return [
            'nome_fantasia.required' => 'O nome fantasia é obrigatório.',
            'razao_social.required'  => 'A razão social é obrigatória.',
            'cnpj.required' => 'O CNPJ é obrigatório.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'brand_id.required' => 'A bandeira é obrigatória.',
            'brand_id.exists' => 'A bandeira selecionada não existe.',
        ];
    }
}