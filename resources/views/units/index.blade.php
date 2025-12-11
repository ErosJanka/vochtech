@extends('layouts.app')

@section('title', 'Unidades')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Unidades</h1>
    <a href="{{ route('units.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nova Unidade</a>
</div>

<div class="bg-white shadow rounded p-4">
    <table class="min-w-full">
        <thead>
            <tr class="text-left">
                <th class="py-2">ID</th>
                <th class="py-2">Nome Fantasia</th>
                <th class="py-2">CNPJ</th>
                <th class="py-2">Bandeira</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($units as $unit)
                <tr class="border-t">
                    <td class="py-2">{{ $unit->id }}</td>
                    <td class="py-2">{{ $unit->nome_fantasia }}</td>
                    <td class="py-2">{{ $unit->cnpj }}</td>
                    <td class="py-2">{{ $unit->brand->name ?? '-' }}</td>
                    <td class="py-2">
                        <a href="{{ route('units.edit', $unit) }}" class="text-yellow-600 mr-2">Editar</a>
                        <form action="{{ route('units.destroy', $unit) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">
        {{ $units->links() }}
    </div>
</div>
@endsection