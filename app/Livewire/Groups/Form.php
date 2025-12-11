<?php

namespace App\Livewire\Groups;

use Livewire\Component;
use App\Models\Group;

class Form extends Component
{
    public $group;
    public $name;
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255|unique:groups,name',
    ];

    public function mount($group = null)
    {
        if ($group) {
            $this->group = $group;
            $this->name = $group->name;
            $this->isEditing = true;
            $this->rules['name'] = 'required|string|max:255|unique:groups,name,' . $group->id;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditing) {
            $this->group->update(['name' => $this->name]);
            session()->flash('message', 'Grupo atualizado com sucesso.');
        } else {
            Group::create(['name' => $this->name]);
            session()->flash('message', 'Grupo criado com sucesso.');
        }

        return redirect()->route('groups.index');
    }

    public function render()
    {
        return view('livewire.groups.form');
    }
}