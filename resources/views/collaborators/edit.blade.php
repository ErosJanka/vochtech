@extends('layouts.app')

@section('title', 'Editar Colaborador')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Colaborador</h1>

@include('partials._form_errors')

<form action="{{ route('collaborators.update', $collaborator) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nome</label>
        <input type="text" name="name" value="{{ old('name', $collaborator->name) }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', $collaborator->email) }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">CPF</label>
        <input type="text" name="cpf" value="{{ old('cpf', $collaborator->cpf) }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Unidade</label>
        <select name="unit_id" class="w-full border p-2 rounded" required>
            <option value="">Selecione</option>
            @foreach($units as $u)
                <option value="{{ $u->id }}" {{ old('unit_id', $collaborator->unit_id) == $u->id ? 'selected' : '' }}>{{ $u->nome_fantasia }} ({{ $u->brand->name ?? '' }})</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center">
        <a href="{{ route('collaborators.index') }}" class="mr-4">Cancelar</a>
        <button class="px-4 py-2 bg-green-600 text-white rounded">Atualizar</button>
    </div>
</form>
@endsection