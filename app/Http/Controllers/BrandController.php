<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Group;
use App\Http\Requests\StoreBrandRequest;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('group')->paginate(15);
        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        $groups = Group::all();
        return view('brands.create', compact('groups'));
    }

    public function store(StoreBrandRequest $request)
    {
        Brand::create($request->validated());
        return redirect()->route('brands.index')->with('success', 'Bandeira criada com sucesso.');
    }

    public function show(Brand $brand)
    {
        $brand->load('group', 'units');
        return view('brands.show', compact('brand'));
    }

    public function edit(Brand $brand)
    {
        $groups = Group::all();
        return view('brands.edit', compact('brand', 'groups'));
    }

    public function update(StoreBrandRequest $request, Brand $brand)
    {
        // Usando StoreBrandRequest para update (não tem unique, então funciona)
        $brand->update($request->validated());
        return redirect()->route('brands.index')->with('success', 'Bandeira atualizada com sucesso.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Bandeira removida com sucesso.');
    }
}