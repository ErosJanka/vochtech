<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Group;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 15;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 15]
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $groups = Group::withCount('brands')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->perPage);

        return view('livewire.groups.index', compact('groups'));
    }

    public function delete($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        
        session()->flash('message', 'Grupo deletado com sucesso.');
    }
}