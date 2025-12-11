<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Brand;
use App\Http\Requests\StoreUnitRequest;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('brand')->paginate(15);
        return view('units.index', compact('units'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('units.create', compact('brands'));
    }

    public function store(StoreUnitRequest $request)
    {
        Unit::create($request->validated());
        return redirect()->route('units.index')->with('success', 'Unidade criada com sucesso.');
    }

    public function show(Unit $unit)
    {
        $unit->load('brand', 'collaborators');
        return view('units.show', compact('unit'));
    }

    public function edit(Unit $unit)
    {
        $brands = Brand::all();
        return view('units.edit', compact('unit', 'brands'));
    }

    public function update(StoreUnitRequest $request, Unit $unit)
    {
        // StoreUnitRequest já está configurado para funcionar no update também
        $unit->update($request->validated());
        return redirect()->route('units.index')->with('success', 'Unidade atualizada com sucesso.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unidade removida com sucesso.');
    }
}