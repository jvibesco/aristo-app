<?php

namespace App\Http\Controllers;

use App\Models\Proses;
use App\Models\Schedule;
use App\Models\FlowProses;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('scheduleFlowProses.index', [
            'flowproseses' => FlowProses::orderBy('id', 'desc')->get(),
            'schedules' => Schedule::orderBy('planningTanggal', 'desc')->get(),
            'proseses' => Proses::all(),
        ]);
    }

    public function store(Request $request)
    {
        foreach ($request->detail_id as $item => $value) {
            Schedule::create([
                'flowproses_id' => $request->flowproses_id,
                'flow_proses_detail_id' => $request->detail_id[$item],
                'planningTanggal' => $request->planningTanggal[$item],
            ]);
        }
        return back()->with('success', 'Tanggal berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        foreach ($request->planningTanggal as $item => $value) {
            Schedule::where('id', $request->schedule_id[$item])->update([
                'planningTanggal' => $request->planningTanggal[$item],
            ]);
        }
        return back()->with('success', 'Planning Tanggal Berhasil Diubah!');
    }

    public function getData(Request $request)
    {
        $tanggal = $request->tanggal;
        $proses = $request->proses;

        $query = Schedule::join('flow_proses_details as fpd', 'fpd.id', '=', 'schedules.flow_proses_detail_id')
            ->Join('proses', 'proses.id', '=', 'fpd.proses_id')
            ->Join('flow_proses as fp', 'fp.id', '=', 'fpd.flowproses_id')
            // ->Join('actual_produksis as ap', 'fpd.proses_id', '=', 'ap.proses_id')
            ->leftJoin('actual_produksis as ap', function ($join) {
                $join->on('fpd.proses_id', '=', 'ap.proses_id')
                     ->on('fpd.flowproses_id', '=', 'ap.flowproses_id');
            })
            ->leftJoin('job_orders as jo', 'jo.id', '=', 'fp.joborder_id');

        if ($tanggal) 
            $query->where('planningTanggal', '=', $tanggal);

        if ($proses)
            $query->where('fpd.proses_id', '=', $proses);

        $data['schedule'] = $query->get();
        // dd($data['schedule']);

        // dd($data['schedule']);

        return response()->json([
            'data' => $data['schedule'],
        ]);
    }
}
