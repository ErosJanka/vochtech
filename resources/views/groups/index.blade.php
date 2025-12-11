@extends('layouts.app')

@section('title', 'Grupos')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Grupos</h1>
    <a href="{{ route('groups.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Novo Grupo</a>
</div>

<div class="bg-white shadow rounded p-4">
    <table class="min-w-full">
        <thead>
            <tr class="text-left">
                <th class="py-2">ID</th>
                <th class="py-2">Nome</th>
                <th class="py-2">Bandeiras</th>
                <th class="py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($groups as $group)
                <tr class="border-t">
                    <td class="py-2">{{ $group->id }}</td>
                    <td class="py-2">{{ $group->name }}</td>
                    <td class="py-2">{{ $group->brands->count() }}</td>
                    <td class="py-2">
                        <a href="{{ route('groups.show', $group) }}" class="text-blue-600 mr-2">Ver</a>
                        <a href="{{ route('groups.edit', $group) }}" class="text-yellow-600 mr-2">Editar</a>
                        <form action="{{ route('groups.destroy', $group) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja apagar?')">
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
        {{ $groups->links() }}
    </div>
</div>
@endsection