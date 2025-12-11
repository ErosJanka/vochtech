@extends('layouts.app')
@section('title','Colaboradores')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Colaboradores</h1>
    <a href="{{ route('collaborators.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Novo Colaborador</a>
</div>
<div class="bg-white shadow rounded p-4">
    <table class="min-w-full">
        <thead><tr class="text-left"><th class="py-2">ID</th><th class="py-2">Nome</th><th class="py-2">Email</th>
        <th class="py-2">CPF</th><th class="py-2">Unidade</th><th class="py-2">Ações</th></tr></thead>
        <tbody>
            @foreach($collaborators as $c)
            <tr class="border-t"><td class="py-2">{{ $c->id }}</td><td class="py-2">{{ $c->name }}</td>
            <td class="py-2">{{ $c->email }}</td><td class="py-2">{{ $c->cpf }}</td>
            <td class="py-2">{{ $c->unit->nome_fantasia ?? '-' }}</td><td class="py-2">
                <a href="{{ route('collaborators.edit',$c) }}" class="text-yellow-600 mr-2">Editar</a>
                <form action="{{ route('collaborators.destroy',$c) }}" method="POST" class="inline" onsubmit="return confirm('Excluir?')">
                @csrf @method('DELETE')<button class="text-red-600">Excluir</button></form></td></tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $collaborators->links() }}</div>
</div>
@endsection