@extends('layouts.app')

@section('title', 'Editar Bandeira')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Bandeira</h1>

@include('partials._form_errors')

<form action="{{ route('brands.update', $brand) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nome</label>
        <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Grupo</label>
        <select name="group_id" class="w-full border p-2 rounded" required>
            <option value="">Selecione</option>
            @foreach($groups as $g)
                <option value="{{ $g->id }}" {{ old('group_id', $brand->group_id) == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="flex items-center">
        <a href="{{ route('brands.index') }}" class="mr-4">Cancelar</a>
        <button class="px-4 py-2 bg-green-600 text-white rounded">Atualizar</button>
    </div>
</form>
@endsection