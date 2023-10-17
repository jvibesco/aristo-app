<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use App\Models\FlowProses;
use Illuminate\Http\Request;
use App\Models\ActualProduksi;
use App\Models\FlowProsesDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActualProduksiController extends Controller
{
    public function index()
    {
        $flowprosesdone = FlowProses::whereDoesntHave('actuals', function ($query) {
            $query->whereHas('proses', function ($query) {
                $query->where('namaProses', 'DELIVERY');
            })->orderBy('id', 'desc')->limit(1);
        })->orderBy('id', 'desc')->get();

        return view('actualProduksi.index', [
            'flowproseses' => $flowprosesdone,
            'proseses' => Proses::all(),
            'actuals' => ActualProduksi::where('operator', Auth::user()->nama)->orderBy('id', 'desc')->get(),
        ]);
    }


    public function store(Request $request)
    {
        if (isset($request->namaProses)) {
            $proses = Proses::firstWhere('namaProses', $request->namaProses);
            $attributes['proses_id'] = $proses->id;
            $attributes['flowproses_id'] = $request->flowproses_id;
            $attributes['tanggal'] = Carbon::now()->toDateString();
            $attributes['jam_mulai'] = Carbon::now();
            $attributes['operator'] = Auth::user()->nama;
            ActualProduksi::create($attributes);
            return back()->with('success', 'Sukses');
        }

        $attributes = $request->validate([
            'flowproses_id' => ['required'],
            'proses_id' => ['required'],
        ]);
        $attributes['tanggal'] = Carbon::now()->toDateString();
        $attributes['jam_mulai'] = Carbon::now();
        $attributes['operator'] = Auth::user()->nama;

        ActualProduksi::create($attributes);
        return back()->with('success', 'Sukses');
    }

    public function update(Request $request, ActualProduksi $actual)
    {
        $joborder = $actual->flowproses->joborder->no_jo;
        $jam_mulai = $actual->jam_mulai;
        $jam_selesai = carbon::now();
        ActualProduksi::where('id', $actual->id)->update([
            'ket_selesai' => $request->ket_selesai,
            'jam_selesai' => $jam_selesai,
            'durasi' => $jam_selesai->diffInMinutes($jam_mulai),
        ]);
        return back()->with('success', "Job Order $joborder Telah Selesai Proses");
    }

    public function destroy(ActualProduksi $actual)
    {
        ActualProduksi::destroy($actual->id);
        return back()->with('Sukses', 'Data Produksi Telah Dihapus!');
    }

    public function getFlowProses(Request $request)
    {
        $id = $request->id;
        $actual = ActualProduksi::where('flowproses_id', $id)->get();
        $flowproses = FlowProsesDetail::join('proses', 'proses.id', '=', 'flow_proses_details.proses_id')
            ->where('flow_proses_details.flowproses_id', $id)->get();
        $optionHtml = '';
        foreach ($flowproses as $flow) {
            if ($flow->namaProses != 'QC' && $flow->namaProses != 'DELIVERY') {
                if ($actual->where('proses_id', $flow->proses_id)->isNotEmpty()) {
                    $optionHtml .= '<option value="' . $flow->proses_id . '">' . $flow->urutan . '. ' . $flow->namaProses . ' &#9989;</option>';
                } else {
                    $optionHtml .= '<option value="' . $flow->proses_id . '">' . $flow->urutan . '. ' . $flow->namaProses . '</option>';
                }
            }
        }
        return response()->json([
            'data' => $optionHtml,
        ]);
    }

    // //AJAX
    // public function getPart($id)
    // {
    //     $part = part::where('id', $id)->first();
    //     // $part = DB::table('parts')->where('id', $id)->first();
    //     $material = $part->material->namaMaterial;
    //     $qtyMaterial = $part->qtyMaterial;
    //     return response()->json([
    //         'material' => $material,
    //         'qtyMaterial' => $qtyMaterial,
    //     ]);
    // }
}
