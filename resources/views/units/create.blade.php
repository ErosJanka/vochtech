@extends('layouts.app')

@section('title', 'Criar Unidade')

@section('content')
<h1 class="text-2xl font-bold mb-4">Criar Unidade</h1>

@include('partials._form_errors')

<form action="{{ route('units.store') }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nome Fantasia</label>
        <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia') }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Razão Social</label>
        <input type="text" name="razao_social" value="{{ old('razao_social') }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">CNPJ</label>
        <input type="text" name="cnpj" value="{{ old('cnpj') }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Bandeira</label>
        <select name="brand_id" class="w-full border p-2 rounded" required>
            <option value="">Selecione</option>
            @foreach($brands as $b)
                <option value="{{ $b->id }}" {{ old('brand_id') == $b->id ? 'selected' : '' }}>{{ $b->name }} ({{ $b->group->name ?? '' }})</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center">
        <a href="{{ route('units.index') }}" class="mr-4">Cancelar</a>
        <button class="px-4 py-2 bg-green-600 text-white rounded">Salvar</button>
    </div>
</form>
@endsection