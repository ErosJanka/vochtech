@extends('layouts.app')

@section('title', 'Detalhes da Unidade')

@section('content')
<h1 class="text-2xl font-bold mb-4">Unidade: {{ $unit->nome_fantasia }}</h1>

<div class="bg-white p-4 rounded shadow mb-6">
    <p><strong>ID:</strong> {{ $unit->id }}</p>
    <p><strong>Nome Fantasia:</strong> {{ $unit->nome_fantasia }}</p>
    <p><strong>Razão Social:</strong> {{ $unit->razao_social }}</p>
    <p><strong>CNPJ:</strong> {{ $unit->cnpj }}</p>
    <p><strong>Bandeira:</strong> {{ $unit->brand->name ?? '-' }} (Grupo: {{ $unit->brand->group->name ?? '-' }})</p>
    <p><strong>Criado em:</strong> {{ $unit->created_at->format('d/m/Y H:i') }}</p>
</div>

<h2 class="text-xl font-semibold mb-2">Colaboradores</h2>
<div class="bg-white p-4 rounded shadow">
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Nome</th>
                <th class="py-2">Email</th>
                <th class="py-2">CPF</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($unit->collaborators as $collaborator)
                <tr class="border-t">
                    <td class="py-2">{{ $collaborator->id }}</td>
                    <td class="py-2">{{ $collaborator->name }}</td>
                    <td class="py-2">{{ $collaborator->email }}</td>
                    <td class="py-2">{{ $collaborator->cpf }}</td>
                    <td class="py-2">
                        <a href="{{ route('collaborators.edit', $collaborator) }}" class="text-yellow-600 mr-2">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection