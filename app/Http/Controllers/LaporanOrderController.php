<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FlowProses;
use Illuminate\Http\Request;
use App\Models\FlowProsesDetail;
use Illuminate\Support\Facades\DB;

class LaporanOrderController extends Controller
{
    public function index(Request $request)
    {
        $data['start_date'] = $request->query('start_date');

        $data['end_date'] = $request->query('end_date');

        $data['customers'] = Customer::all();

        $data['customer_id'] = $request->query('customer_id');

        if ($request->query('customer_id')) {
            $cust = Customer::where('id', $request->query('customer_id'))->first();
            $data['namaCustomer'] = $cust->namaCustomer;
        }

        // $query = part::select('parts.*', 'job_orders.*', 'proses.*', 'orders.*', 'customers.*', 'materials.*', 'actual_produksis.proses_id', 'actual_produksis.operator')
        //     ->join('job_orders', 'job_orders.id', '=', 'parts.joborder_id')
        //     ->join('materials', 'materials.id', '=', 'parts.material_id')
        //     ->join('orders', 'orders.id', '=', 'job_orders.order_id')
        //     ->join('customers', 'customers.id', '=', 'orders.customer_id')
        //     ->leftJoin('actual_produksis', 'actual_produksis.part_id', '=', 'parts.id')
        //     ->leftJoin('proses', 'proses.id', '=', 'actual_produksis.proses_id')
        //     ->where('actual_produksis.id', function ($query) {
        //         $query->select(DB::raw('MAX(id)'))
        //             ->from('actual_produksis')
        //             ->whereRaw('actual_produksis.part_id = parts.id');
        //     });


        // $query = FlowProses::select('flow_proses.*', 'job_orders.*', 'proses.*', 'orders.*', 'customers.*', 'materials.*', 'actual_produksis.proses_id', 'actual_produksis.operator', 'actual_produksis.tanggal')
        //     ->join('job_orders', 'job_orders.id', '=', 'flow_proses.joborder_id')
        //     ->join('materials', 'materials.id', '=', 'flow_proses.material_id')
        //     ->join('orders', 'orders.id', '=', 'job_orders.order_id')
        //     ->join('customers', 'customers.id', '=', 'orders.customer_id')
        //     ->leftJoin('actual_produksis', 'actual_produksis.flowproses_id', '=', 'flow_proses.id')
        //     ->leftJoin('proses', 'proses.id', '=', 'actual_produksis.proses_id')
        //     ->where('actual_produksis.id', function ($query) {
        //         $query->select(DB::raw('MAX(id)'))
        //             ->from('actual_produksis')
        //             ->whereRaw('actual_produksis.flowproses_id = flow_proses.id');
        //     })->orWhereNull('actual_produksis.id');

        $query = FlowProses::select('flow_proses.*', 'flow_proses.id as flowproses_id', 'job_orders.*', 'proses.*', 'orders.*', 'customers.*', 'materials.*', 'actual_produksis.proses_id', 'actual_produksis.operator', 'actual_produksis.tanggal')
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
            });

        if ($data['customer_id'])
            $query->where('orders.customer_id', '=', $data['customer_id']);

        if ($data['start_date'])
            $query->where('orders.tglPo', '>=', $data['start_date']);

        if ($data['end_date'])
            $query->where('orders.tglPo', '<=', $data['end_date']);

        $data['parts'] = $query
            ->orderBy('tglPoAkhir', 'asc')
            ->orderBy('noPo', 'desc')
            ->orderBy('no_jo', 'asc')->get();
            // ->paginate(4)
            // ->appends([
            //     'start_date' => $data['start_date'],
            //     'end_date' => $data['end_date'],
            //     'customer_id' => $data['customer_id'],
            // ]);
        // dd($data['parts']);

        return view('laporan.statusorder', $data);
    }
}
