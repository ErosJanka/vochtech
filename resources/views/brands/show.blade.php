@extends('layouts.app')

@section('title', 'Detalhes da Bandeira')

@section('content')
<h1 class="text-2xl font-bold mb-4">Bandeira: {{ $brand->name }}</h1>

<div class="bg-white p-4 rounded shadow mb-6">
    <p><strong>ID:</strong> {{ $brand->id }}</p>
    <p><strong>Nome:</strong> {{ $brand->name }}</p>
    <p><strong>Grupo:</strong> {{ $brand->group->name ?? '-' }}</p>
    <p><strong>Criado em:</strong> {{ $brand->created_at->format('d/m/Y H:i') }}</p>
</div>

<h2 class="text-xl font-semibold mb-2">Unidades</h2>
<div class="bg-white p-4 rounded shadow">
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="py-2">ID</th>
                <th class="py-2">Nome Fantasia</th>
                <th class="py-2">CNPJ</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brand->units as $unit)
                <tr class="border-t">
                    <td class="py-2">{{ $unit->id }}</td>
                    <td class="py-2">{{ $unit->nome_fantasia }}</td>
                    <td class="py-2">{{ $unit->cnpj }}</td>
                    <td class="py-2">
                        <a href="{{ route('units.edit', $unit) }}" class="text-yellow-600 mr-2">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection