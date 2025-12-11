@extends('layouts.app')

@section('title', 'Bandeiras')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Bandeiras</h1>
    <a href="{{ route('brands.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Nova Bandeira</a>
</div>

<div class="bg-white shadow rounded p-4">
    <table class="min-w-full">
        <thead>
            <tr class="text-left">
                <th class="py-2">ID</th>
                <th class="py-2">Nome</th>
                <th class="py-2">Grupo</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr class="border-t">
                    <td class="py-2">{{ $brand->id }}</td>
                    <td class="py-2">{{ $brand->name }}</td>
                    <td class="py-2">{{ $brand->group->name ?? '-' }}</td>
                    <td class="py-2">
                        <a href="{{ route('brands.edit', $brand) }}" class="text-yellow-600 mr-2">Editar</a>
                        <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar?')">
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
        {{ $brands->links() }}
    </div>
</div>
@endsection