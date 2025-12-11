<div>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Grupos</h1>
        <a href="{{ route('groups.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Novo Grupo
        </a>
    </div>

    <div class="mb-4">
        <input 
            type="text" 
            wire:model.live="search"
            placeholder="Buscar grupo..."
            class="w-full p-2 border rounded"
        >
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Nome</th>
                    <th class="py-3 px-4 text-left">Bandeiras</th>
                    <th class="py-3 px-4 text-left">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($groups as $group)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $group->id }}</td>
                        <td class="py-3 px-4">{{ $group->name }}</td>
                        <td class="py-3 px-4">{{ $group->brands_count }}</td>
                        <td class="py-3 px-4 space-x-2">
                            <a 
                                href="{{ route('groups.show', $group) }}" 
                                class="text-blue-600 hover:text-blue-800"
                            >
                                Ver
                            </a>
                            <a 
                                href="{{ route('groups.edit', $group) }}" 
                                class="text-yellow-600 hover:text-yellow-800"
                            >
                                Editar
                            </a>
                            <button 
                                wire:click="delete({{ $group->id }})" 
                                wire:confirm="Tem certeza que deseja excluir este grupo?"
                                class="text-red-600 hover:text-red-800"
                            >
                                Excluir
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">
                            Nenhum grupo encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $groups->links() }}
    </div>
</div>