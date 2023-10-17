<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index', [
            'customers' => Customer::all()
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'namaCustomer' => 'required|max:255|unique:customers',
            'kodeCustomer' => 'required|max:3|unique:customers',
        ];
        $validatedData = $request->validate($rules);
        $validatedData['joAkhir'] = $request->kodeCustomer . '-' . date('y') . date('m') . '0000';

        Customer::create($validatedData);

        return redirect('master/customer')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $attr = $request->validate([
            'namaCustomer' => 'required|max:255|unique:customers,namaCustomer,' . $customer->id,
            'kodeCustomer' => 'required|max:3|unique:customers,kodeCustomer,' . $customer->id,
            'joAkhir' => 'required',
        ]);

        Customer::where('id', $customer->id)->update($attr);
        return redirect(route('customer.index'))->with('success', 'Customer berhasil diubah!');
    }

    public function destroy(Customer $customer)
    {
        Customer::destroy($customer->id);
        return back()->with('success', 'Customer berhasil dihapus');
    }
}
