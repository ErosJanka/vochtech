<div>
    <h1 class="text-2xl font-bold mb-4">
        {{ $isEditing ? 'Editar Grupo' : 'Criar Grupo' }}
    </h1>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="save" class="bg-white p-6 rounded shadow">
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nome
            </label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="w-full p-2 border rounded @error('name') border-red-500 @enderror"
                placeholder="Digite o nome do grupo"
            >
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center space-x-4">
            <a
                href="{{ route('groups.index') }}"
                class="px-4 py-2 border border-gray-300 text-gray-700 rounded hover:bg-gray-50"
            >
                Cancelar
            </a>
            <button
                type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700"
            >
                {{ $isEditing ? 'Atualizar' : 'Salvar' }}
            </button>
        </div>
    </form>
</div>