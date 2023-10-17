<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use App\Models\JobOrder;
use App\Models\Material;
use App\Models\Schedule;
use App\Models\FlowProses;
use Illuminate\Http\Request;
use App\Models\FlowProsesDetail;
use Mockery\Undefined;

class FlowController extends Controller
{


    public function index()
    {
        return view('flowproses.index', [
            'joborders' => JobOrder::all(),
            'proseses' => Proses::all(),
            'materials' => Material::all(),
            'flowproseses' => FlowProses::orderBy('id', 'DESC')->get(),
        ]);
    }

    public function store(Request $request)
    {
        FlowProses::create([
            'joborder_id' => $request->joborder_id,
            'material_id' => $request->material_id,
        ]);

        $fp = FlowProses::firstWhere('joborder_id', $request->joborder_id);

        foreach ($request->proses_id as $item => $value) {
            FlowProsesDetail::create([
                'flowproses_id' => $fp->id,
                'urutan' => $request->urutan[$item],
                'proses_id' => $request->proses_id[$item],
                'planningJam' => $request->planningJam[$item],
            ]);
        }
        return back()->with('success', 'Flow Proses berhasil dibuat!');
    }

    public function update(FlowProses $flowproses, Request $request)
    {
        // dd($flowproses->id);
        foreach ($request->proses_id as $item => $value) {
            if (isset($request->detail_id[$item])) {
                FlowProsesDetail::where('id', $request->detail_id[$item])->update([
                    'proses_id' => $request->proses_id[$item],
                    'planningJam' => $request->planningJam[$item],
                ]);
            } else {
                FlowProsesDetail::create([
                    'flowproses_id' => $flowproses->id,
                    'urutan' => $request->urutan[$item],
                    'proses_id' => $request->proses_id[$item],
                    'planningJam' => $request->planningJam[$item],
                ]);
            }
        }

        FlowProses::where('id', $flowproses->id)->update([
            'material_id' =>  $request->material_id,
        ]);
        return back()->with('success', 'Flow Proses berhasil diubah!');
    }

    public function destroy(FlowProses $flowproses)
    {
        if (!$flowproses->actuals->count()) {
            foreach ($flowproses->flowprosesdetails as $detail) {
                FlowProsesDetail::destroy($detail->id);
            }

            foreach ($flowproses->schedules as $schedule) {
                Schedule::destroy($schedule->id);
            }
            FlowProses::destroy($flowproses->id);
            return back()->with('success', 'Flow Proses Berhasil Dihapus!');
        };
        return back()->with('failed', 'Flow Proses Sudah Diproduksi!');
    }

    //AJAX
    public function getProses(Request $request)
    {
        $name = $request->name;
        $count = JobOrder::where('nama_barang', $name)->count();

        if ($count > 1) {
            $min = JobOrder::where('nama_barang', $name)->first();
            $material = FlowProses::where('joborder_id', $min->id)
            ->join('materials', 'materials.id', '=', 'flow_proses.material_id')
            ->first();
            $flowproses = FlowProses::where('joborder_id', $min->id)->first();
            $proses = FlowProsesDetail::where('flowproses_id', $flowproses->id)
            ->join('proses', 'proses.id', '=', 'flow_proses_details.proses_id')
            ->get();
            return response()->json([
                'success' => $proses,
                'material' => $material,
            ]);
        }
    }
}
