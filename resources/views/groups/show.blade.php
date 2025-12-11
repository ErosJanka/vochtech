@extends('layouts.app')

@section('title', 'Detalhes do Grupo')

@section('content')
<h1 class="text-2xl font-bold mb-4">Grupo: {{ $group->name }}</h1>

<div class="bg-white p-4 rounded shadow mb-6">
    <p><strong>ID:</strong> {{ $group->id }}</p>
    <p><strong>Nome:</strong> {{ $group->name }}</p>
    <p><strong>Criado em:</strong> {{ $group->created_at->format('d/m/Y H:i') }}</p>
</div>

<h2 class="text-xl font-semibold mb-2">Bandeiras</h2>
<div class="bg-white p-4 rounded shadow">
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Nome</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($group->brands as $brand)
                <tr class="border-t">
                    <td class="py-2">{{ $brand->id }}</td>
                    <td class="py-2">{{ $brand->name }}</td>
                    <td class="py-2">
                        <a href="{{ route('brands.edit', $brand) }}" class="text-yellow-600 mr-2">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection