<?php

namespace App\Http\Controllers;

use App\Models\Collaborator;
use App\Models\Unit;
use App\Http\Requests\StoreCollaboratorRequest;

class CollaboratorController extends Controller
{
    public function index()
    {
        $collaborators = Collaborator::with('unit')->paginate(15);
        return view('collaborators.index', compact('collaborators'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('collaborators.create', compact('units'));
    }

    public function store(StoreCollaboratorRequest $request)
    {
        Collaborator::create($request->validated());
        return redirect()->route('collaborators.index')->with('success', 'Colaborador criado com sucesso.');
    }

    public function show(Collaborator $collaborator)
    {
        $collaborator->load('unit');
        return view('collaborators.show', compact('collaborator'));
    }

    public function edit(Collaborator $collaborator)
    {
        $units = Unit::all();
        return view('collaborators.edit', compact('collaborator', 'units'));
    }

    public function update(StoreCollaboratorRequest $request, Collaborator $collaborator)
    {
        // StoreCollaboratorRequest já está configurado para funcionar no update também
        $collaborator->update($request->validated());
        return redirect()->route('collaborators.index')->with('success', 'Colaborador atualizado com sucesso.');
    }

    public function destroy(Collaborator $collaborator)
    {
        $collaborator->delete();
        return redirect()->route('collaborators.index')->with('success', 'Colaborador removido com sucesso.');
    }
}