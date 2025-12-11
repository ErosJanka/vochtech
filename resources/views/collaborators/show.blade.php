@extends('layouts.app')

@section('title', 'Detalhes do Colaborador')

@section('content')
<h1 class="text-2xl font-bold mb-4">Colaborador: {{ $collaborator->name }}</h1>

<div class="bg-white p-4 rounded shadow">
    <p><strong>ID:</strong> {{ $collaborator->id }}</p>
    <p><strong>Nome:</strong> {{ $collaborator->name }}</p>
    <p><strong>Email:</strong> {{ $collaborator->email }}</p>
    <p><strong>CPF:</strong> {{ $collaborator->cpf }}</p>
    <p><strong>Unidade:</strong> {{ $collaborator->unit->nome_fantasia ?? '-' }}</p>
    <p><strong>Bandeira:</strong> {{ $collaborator->unit->brand->name ?? '-' }}</p>
    <p><strong>Grupo:</strong> {{ $collaborator->unit->brand->group->name ?? '-' }}</p>
    <p><strong>Criado em:</strong> {{ $collaborator->created_at->format('d/m/Y H:i') }}</p>
</div>
@endsection