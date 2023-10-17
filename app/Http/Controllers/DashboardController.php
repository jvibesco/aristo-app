<?php

namespace App\Http\Controllers;

use App\Models\JobOrder;
use App\Models\FlowProses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->format('m');
        $previousMonth = Carbon::now()->subMonth()->format('m');
        $query1 = FlowProses::select('flow_proses.*', 'flow_proses.id as flowproses_id', 'job_orders.*', 'proses.*', 'orders.*', 'customers.*', 'materials.*', 'actual_produksis.proses_id', 'actual_produksis.operator', 'actual_produksis.tanggal')
            ->join('job_orders', 'job_orders.id', '=', 'flow_proses.joborder_id')
            ->join('materials', 'materials.id', '=', 'flow_proses.material_id')
            ->join('orders', 'orders.id', '=', 'job_orders.order_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftJoin('actual_produksis', 'actual_produksis.flowproses_id', '=', 'flow_proses.id')
            ->leftJoin('proses', 'proses.id', '=', 'actual_produksis.proses_id')
            ->where(function ($query) {
                $query->where('actual_produksis.id', function ($subquery) {
                    $subquery->select(DB::raw('MAX(id)'))
                        ->from('actual_produksis')
                        ->whereRaw('actual_produksis.flowproses_id = flow_proses.id');
                })
                    ->orWhereNull('actual_produksis.id');
            })->whereMonth('tglPo', $currentMonth)->get();

        $query2 = FlowProses::select('flow_proses.*', 'flow_proses.id as flowproses_id', 'job_orders.*', 'proses.*', 'orders.*', 'customers.*', 'materials.*', 'actual_produksis.proses_id', 'actual_produksis.operator', 'actual_produksis.tanggal')
            ->join('job_orders', 'job_orders.id', '=', 'flow_proses.joborder_id')
            ->join('materials', 'materials.id', '=', 'flow_proses.material_id')
            ->join('orders', 'orders.id', '=', 'job_orders.order_id')
            ->join('customers', 'customers.id', '=', 'orders.customer_id')
            ->leftJoin('actual_produksis', 'actual_produksis.flowproses_id', '=', 'flow_proses.id')
            ->leftJoin('proses', 'proses.id', '=', 'actual_produksis.proses_id')
            ->where(function ($query) {
                $query->where('actual_produksis.id', function ($subquery) {
                    $subquery->select(DB::raw('MAX(id)'))
                        ->from('actual_produksis')
                        ->whereRaw('actual_produksis.flowproses_id = flow_proses.id');
                })
                    ->orWhereNull('actual_produksis.id');
            })->whereMonth('tglPo', '=', $previousMonth)
            ->get();

        $query3 = JobOrder::whereHas('order', function ($query) use ($currentMonth) {
            $query->whereMonth('tglPo', $currentMonth);
        })->get();

        $progress = $query1->where('namaProses', '!=', 'DELIVERY');
        $previousProgress = $query2->where('namaProses', '!=', 'DELIVERY');
        $done = $query1->where('namaProses', 'DELIVERY');
        return view('dashboard', [
            'joborder' => $query3,
            'currentMonth' => Carbon::createFromFormat('m', $currentMonth),
            'previousMonth' => Carbon::createFromFormat('m', $previousMonth),
            'previousProgress' => $previousProgress,
            'done' => $done,
            'progress' => $progress,

        ]);
    }
}
