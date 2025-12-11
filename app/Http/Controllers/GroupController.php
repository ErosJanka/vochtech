<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Brand;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::withCount('brands')->paginate(15);
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('groups.create', compact('brands'));
    }

    public function store(StoreGroupRequest $request)
    {
        $data = $request->validated();
        $brandIds = $request->input('brand_ids', []);

        // Usa transação para garantir consistência: cria grupo E associa bandeiras atomicamente
        DB::transaction(function () use ($data, $brandIds, &$group) {
            $group = Group::create($data);

            // Associa as bandeiras selecionadas ao novo grupo
            if (!empty($brandIds)) {
                Brand::whereIn('id', $brandIds)->update(['group_id' => $group->id]);
            }
        });

        return redirect()->route('groups.index')->with('success', 'Grupo criado com sucesso.');
    }

    public function show(Group $group)
    {
        $group->load('brands');
        return view('groups.show', compact('group'));
    }

    public function edit(Group $group)
    {
        $brands = Brand::all();
        return view('groups.edit', compact('group', 'brands'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        $data = $request->validated();
        $brandIds = $request->input('brand_ids', []);

        // Transação garante que nome e bandeiras são atualizados juntos
        DB::transaction(function () use ($group, $data, $brandIds) {
            $group->update($data);

            // Remove associações de bandeiras que não estão mais selecionadas
            Brand::where('group_id', $group->id)
                ->whereNotIn('id', $brandIds ?: [0])
                ->update(['group_id' => null]);

            // Associa as bandeiras selecionadas ao grupo
            if (!empty($brandIds)) {
                Brand::whereIn('id', $brandIds)->update(['group_id' => $group->id]);
            }
        });

        return redirect()->route('groups.index')->with('success', 'Grupo atualizado com sucesso.');
    }

    public function destroy(Group $group)
    {
        $group->delete();
        return redirect()->route('groups.index')->with('success', 'Grupo removido com sucesso.');
    }
}