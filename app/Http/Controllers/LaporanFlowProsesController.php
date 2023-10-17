<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\FlowProses;
use Illuminate\Http\Request;
use App\Models\FlowProsesDetail;

class LaporanFlowProsesController extends Controller
{
    public function index(Request $request)
    {
        $joborder_id = $request->query('joborder_id');
        $data['joborders'] = FlowProses::orderBy('id', 'desc')->get();
        $data['joborder_id'] = $request->query('joborder_id');        
        $data['flowproses'] = FlowProses::firstWhere('joborder_id', $joborder_id);
        $data['details'] = FlowProsesDetail::whereHas('flowproses', function ($query) use ($joborder_id) {
            $query->where('joborder_id', $joborder_id);
        })->get();
        // dd($data['details']);
        return view('laporan.flowproses', $data);
    }
}
