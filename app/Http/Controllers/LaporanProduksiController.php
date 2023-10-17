<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FlowProses;
use Illuminate\Http\Request;
use App\Models\ActualProduksi;

class LaporanProduksiController extends Controller
{
    public function index(Request $request)
    {
        $data['tanggal_awal'] = $request->query('tanggal_awal');

        $data['tanggal_akhir'] = $request->query('tanggal_akhir');

        $data['joborder_id'] = $request->query('joborder_id');

        $data['user_id'] = $request->query('user_id');

        $user = User::where('id', $data['user_id'])->first();

        $data['joborders'] = FlowProses::orderBy('id', 'desc')->get();

        $data['users'] = User::all();

        $query = ActualProduksi::join('flow_proses', 'flow_proses.id', '=', 'actual_produksis.flowproses_id')
            ->join('proses', 'proses.id', '=', 'actual_produksis.proses_id')
            ->join('materials', 'materials.id', '=', 'flow_proses.material_id')
            ->join('job_orders', 'job_orders.id', '=', 'flow_proses.joborder_id')
            ->join('orders', 'orders.id', '=', 'job_orders.order_id');

        if ($data['tanggal_awal'])
            $query->where('actual_produksis.tanggal', '>=', $data['tanggal_awal']);

        if ($data['tanggal_akhir'])
            $query->where('actual_produksis.tanggal', '<=', $data['tanggal_akhir']);

        if ($data['joborder_id'])
            $query->where('flow_proses.joborder_id', $data['joborder_id']);

        if ($data['user_id'])
            $query->where('actual_produksis.operator', $user->nama);

        $data['produksi'] = $query->orderBy('actual_produksis.id', 'desc')->get();

        return view('laporan.produksi', $data);
    }
}
