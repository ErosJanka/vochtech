@extends('layouts.app')
@section('title','Relatório de Colaboradores')
@section('content')
<h1 class="text-2xl font-bold mb-4">Relatório de Colaboradores</h1>
<form method="GET" action="{{ route('reports.collaborators') }}" class="bg-white p-4 rounded shadow mb-4">
    <div class="grid grid-cols-3 gap-4">
        <div><label class="block text-sm">Nome</label>
            <input type="text" name="name" value="{{ request('name') }}" class="w-full border p-2 rounded"></div>
        <div><label class="block text-sm">CNPJ da Unidade</label>
            <input type="text" name="cnpj" value="{{ request('cnpj') }}" class="w-full border p-2 rounded"></div>
        <div class="flex items-end">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filtrar</button>
            <a href="{{ route('reports.collaborators.export', request()->query()) }}" class="ml-4 px-4 py-2 bg-green-600 text-white rounded">Exportar Excel</a>
        </div>
    </div>
</form>
<div class="bg-white p-4 rounded shadow">
    <table class="min-w-full">
        <thead><tr><th class="py-2">ID</th><th class="py-2">Nome</th><th class="py-2">Email</th>
        <th class="py-2">CPF</th><th class="py-2">Unidade</th></tr></thead>
        <tbody>
            @foreach($collaborators as $c)
            <tr class="border-t"><td class="py-2">{{ $c->id }}</td><td class="py-2">{{ $c->name }}</td>
            <td class="py-2">{{ $c->email }}</td><td class="py-2">{{ $c->cpf }}</td>
            <td class="py-2">{{ $c->unit->nome_fantasia ?? '-' }}</td></tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4">{{ $collaborators->links() }}</div>
</div>
@endsection