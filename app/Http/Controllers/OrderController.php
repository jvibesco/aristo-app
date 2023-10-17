<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\JobOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        return view('joborder.index', [
            'orders' => Order::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('joborder.create', [
            'customers' => Customer::all(),
            'dateNow' => Carbon::now('Asia/Jakarta')->toDateString(),
            'barangs' => JobOrder::distinct()->pluck('nama_barang'),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData1 = $request->validate([
            'customer_id' => 'required',
            'noPo' => 'required|unique:orders',
            'tglPo' => 'required|date',
            'tglPoAkhir' => 'required|date',
            'totalPo' => 'required|numeric',
            'dokumen' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ]);

        if ($request->file('dokumen')) {
            $validatedData1['dokumen'] = $request->file('dokumen')->store('drawing-jo');
        }

        $validatedData2 = $request->validate([
            'no_jo.*' => 'required|string|unique:job_orders,no_jo',
            'nama_barang.*' => 'required',
            'qty.*' => 'required|numeric',
            'harga_satuan.*' => 'required|numeric',
            'total_harga.*' => 'required|numeric',
        ]);
        Order::create($validatedData1);

        $order = Order::firstWhere('noPo', $request->noPo);

        foreach ($validatedData2['no_jo'] as $key => $value) {
            $joborder = new JobOrder;
            $joborder->order_id = $order->id;
            $joborder->no_jo = $validatedData2['no_jo'][$key];
            $joborder->nama_barang = $validatedData2['nama_barang'][$key];
            $joborder->qty = $validatedData2['qty'][$key];
            $joborder->harga_satuan = $validatedData2['harga_satuan'][$key];
            $joborder->total_harga = $validatedData2['total_harga'][$key];
            $joborder->save();
        }

        Customer::where('id', $request->customer_id)->update([
            'joAkhir' =>  $joborder->no_jo
        ]);

        return redirect(route('joborder.index'))->with('success', 'Order Berhasil Disimpan');
    }

    public function edit(Order $order)
    {
        return view('joborder.edit', [
            'order' => $order,
            'customers' => Customer::all(),
            'joborders' => JobOrder::where('order_id', $order->id)->get(),
            'barangs' => JobOrder::distinct()->pluck('nama_barang'),
        ]);
    }

    public function show(Order $order)
    {
        return view('joborder.show', [
            'order' => $order,
            'joborders' => JobOrder::where('order_id', $order->id)->get(),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $validatedData1 = $request->validate([
            'customer_id' => 'required',
            'noPo' => 'required|unique:orders,noPo,' . $order->id,
            'tglPo' => 'required|date',
            'tglPoAkhir' => 'required|date',
            'totalPo' => 'required|numeric',
            'dokumen' => 'mimes:doc,docx,pdf,xls,xlsx,ppt,pptx',
        ]);

        $rules = [
            'no_jo.*' => 'required|string',
            'nama_barang.*' => 'required',
            'qty.*' => 'required|numeric',
            'harga_satuan.*' => 'required|numeric',
            'total_harga.*' => 'required|numeric',
        ];

        $validatedData2 = $request->validate($rules);
        $validatedData2['no_jo'] = $request->no_jo;

        foreach ($request->nama_barang as $item => $value) {
            if ($request->joborder_id[$item]) {
                $joborder = JobOrder::where('id', $request->joborder_id[$item])->first();
                JobOrder::where('id', $joborder->id)->update([
                    'no_jo' => $validatedData2['no_jo'][$item],
                    'nama_barang' => $validatedData2['nama_barang'][$item],
                    'qty' => $validatedData2['qty'][$item],
                    'harga_satuan' => $validatedData2['harga_satuan'][$item],
                    'total_harga' => $validatedData2['total_harga'][$item],
                ]);
            } else {
                JobOrder::create([
                    'order_id' => $order->id,
                    'no_jo' => $validatedData2['no_jo'][$item],
                    'nama_barang' => $validatedData2['nama_barang'][$item],
                    'qty' => $validatedData2['qty'][$item],
                    'harga_satuan' => $validatedData2['harga_satuan'][$item],
                    'total_harga' => $validatedData2['total_harga'][$item],
                ]);
            }
            $joborder = $validatedData2['no_jo'][$item];
        }

        Customer::where('id', $request->customer_id)->update([
            'joAkhir' =>  $joborder,
        ]);

        if ($request->file('dokumen')) {
            if ($request->oldDokumen) {
                Storage::delete($request->oldDokumen);
            }
            $validatedData1['dokumen'] = $request->file('dokumen')->store('drawing-jo');
        }

        Order::where('id', $order->id)->update($validatedData1);
        return back()->with('success', 'Order Berhasil Diupdate');
    }

    public function destroy(Order $order)
    {
        // $tabel1s = Order::withCount(['joborders as jumlah_fp' => function ($query) {
        //     $query->whereHas('flowproses');
        // }])->get();
        $cek = Order::where('id', $order->id)->has('joborders.flowproses')->get();
        if ($cek->count() == 0) {
            foreach ($order->joborders as $joborder) {
                JobOrder::destroy($joborder->id);
            }
            if ($order->dokumen) {
                Storage::delete($order->dokumen);
            }
            Order::destroy($order->id);

            return redirect(route('joborder.index'))->with('success', 'Order Berhasil Dihapus');
        }
        return back()->with('failed', 'Order tidak bisa dihapus karena sedang diproses!');
    }

    public function getGambar(Order $order)
    {
        $pathToFile = public_path() . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . $order->dokumen;
        return response()->file($pathToFile);
    }


    //AJAX
    public function getNoJo($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        if ($customer == null) {
            $no = 1;
        } else {
            $no = (int) substr($customer->joAkhir, -4) + 1;
        }
        $no_jo = $customer->kodeCustomer . '-' . Carbon::now()->format('ym') . str_pad($no, 4, "0", STR_PAD_LEFT);
        return response()->json([
            'no_jo' => $no_jo
        ]);
    }
}
