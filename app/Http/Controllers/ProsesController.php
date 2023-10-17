<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use Illuminate\Http\Request;

class ProsesController extends Controller
{
    public function index()
    {
        return view('proses.index', [
            'proseses' => Proses::all(),
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'namaProses' => 'required|unique:proses',
        ];
        $validatedData = $request->validate($rules);

        Proses::create($validatedData);

        return redirect(route('proses.index'))->with('success', 'Proses berhasil ditambahkan!');
    }

    public function update(Proses $proses, Request $request)
    {
        $attr = $request->validate([
            'namaProses' => 'required|max:255|unique:proses,namaProses,' . $proses->id,
        ]);

        Proses::where('id', $proses->id)->update($attr);
        return redirect(route('proses.index'))->with('success', 'Proses berhasil diubah!');
    }

    public function destroy(Proses $proses)
    {
        Proses::destroy($proses->id);
        return back()->with('success', 'Proses berhasil dihapus');
    }
}
