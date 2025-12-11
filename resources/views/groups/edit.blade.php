@extends('layouts.app')

@section('title', 'Editar Grupo')

@section('content')
<h1 class="text-2xl font-bold mb-4">Editar Grupo</h1>

@include('partials._form_errors')

<form action="{{ route('groups.update', $group) }}" method="POST" class="bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nome</label>
        <input type="text" name="name" value="{{ old('name', $group->name) }}" class="w-full border p-2 rounded" required>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Bandeiras</label>
        @php
            $selected = old('brand_ids', $group->brands->pluck('id')->toArray());
        @endphp
        @if(isset($brands) && $brands->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @foreach($brands as $brand)
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="brand_ids[]" value="{{ $brand->id }}" class="mr-2"
                            {{ in_array($brand->id, $selected) ? 'checked' : '' }}>
                        {{ $brand->name }}
                    </label>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">Nenhuma bandeira disponível. <a href="{{ route('brands.create') }}" class="text-blue-600">Criar bandeira</a></p>
        @endif
    </div>
    <div class="flex items-center">
        <a href="{{ route('groups.index') }}" class="mr-4">Cancelar</a>
        <button class="px-4 py-2 bg-green-600 text-white rounded">Atualizar</button>
    </div>
</form>
@endsection