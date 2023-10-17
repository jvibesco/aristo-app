<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        return view('material.index', [
            'materials' => Material::all()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'namaMaterial' => 'required|max:255|unique:materials',
        ];
        $validatedData = $request->validate($rules);

        Material::create($validatedData);

        return redirect(route('material.index'))->with('success', 'Material berhasil ditambahkan!');
    }

    public function edit(Material $material)
    {
        return view('material.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $attr = $request->validate([
            'namaMaterial' => 'required|max:255|unique:materials,namaMaterial,' . $material->id,
        ]);

        Material::where('id', $material->id)->update($attr);
        return redirect(route('material.index'))->with('success', 'Material berhasil diubah!');
    }

    public function destroy(Material $material)
    {
        Material::destroy($material->id);
        return back()->with('success', 'Material berhasil dihapus');
    }
}
