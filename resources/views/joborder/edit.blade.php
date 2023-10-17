@extends('layouts.app', ['title' => 'Edit Order'])

@section('konten')
    @if (session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="{{ route('joborder.index') }}" class="btn btn-danger"><i
                            class="fas fa-arrow-left mr-2"></i>Kembali</a>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('joborder.index') }}">Order</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('joborder.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="customer_id" class="form-label">Nama Customer</label>
                                    <select class="form-control" id="customer_id" name="customer_id">
                                        <option value="-" data-nama="" selected disabled>PILIH CUSTOMER</option>
                                        @foreach ($customers as $customer)
                                            @if (old('customer_id', $order->customer_id) == $customer->id)
                                                <option value="{{ $customer->id }}" selected>{{ $customer->namaCustomer }}
                                                </option>
                                            @else
                                                <option value="{{ $customer->id }}">{{ $customer->namaCustomer }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="noPo" class="form-label">No. PO</label>
                                    <input type="text" class="form-control @error('noPo') is-invalid @enderror"
                                        id="noPo" name="noPo" value="{{ old('noPo', $order->noPo) }}">
                                    @error('noPo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <input type="hidden" name="oldDokumen" value="{{ $order->dokumen }}">
                                    <label for="dokumen" class="form-label">Dokumen</label>
                                    <input type="file" class="form-control @error('dokumen') is-invalid @enderror"
                                        id="dokumen" name="dokumen" value="{{ old('dokumen') }}">
                                    @error('dokumen')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            {{-- ./col-md-6 --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tglPo" class="form-label">Tanggal PO</label>
                                    <input type="date" class="form-control @error('tglPo') is-invalid @enderror"
                                        id="tglPo" name="tglPo" value="{{ old('tglPo', $order->tglPo) }}">
                                    @error('tglPo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- ./form-group --}}

                                <div class="form-group">
                                    <label for="tglPoAkhir" class="form-label">Due date</label>
                                    <input type="date" class="form-control @error('tglPoAkhir') is-invalid @enderror"
                                        id="tglPoAkhir" name="tglPoAkhir"
                                        value="{{ old('tglPoAkhir', $order->tglPoAkhir) }}">
                                    @error('tglPoAkhir')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                {{-- ./form-group --}}

                            </div>
                            {{-- ./col-md-6 --}}

                            <div class="table-responsive col-lg-12">
                                <hr>
                                <table id="table-add" class="table table-bordered table-hover table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">
                                                <button id="add" class="btn btn-xs btn-plain" type="button">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </th>
                                            <th class="text-center" scope="col">No</th>
                                            <th class="text-center" scope="col" style="width: 150px">Job Order</th>
                                            <th class="text-center" scope="col">Nama Part</th>
                                            <th class="text-center" scope="col" style="width: 75px">Qty</th>
                                            <th class="text-center" scope="col">Harga/Pcs</th>
                                            <th class="text-center" scope="col">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($joborders as $joborder)
                                            <tr id="row-add-1">
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-plain" type="button" disabled>
                                                        <i class="fas fa-minus text-danger"></i>
                                                    </button>
                                                </td>
                                                <input type="hidden" name="joborder_id[]" value="{{ $joborder->id }}">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center"><input type="text" class="form-control"
                                                        name="no_jo[]" value="{{ $joborder->no_jo }}"></td>
                                                <td class="text-center"><input type="text" class="form-control"
                                                        name="nama_barang[]" value="{{ $joborder->nama_barang }}"
                                                        required></td>
                                                <td class="text-center"><input type="number" class="form-control"
                                                        id="qty-{{ $loop->iteration }}" name="qty[]"
                                                        value="{{ $joborder->qty }}" min="1" required></td>
                                                <td class="text-center"><input type="number" class="form-control"
                                                        id="hrgSatuan-{{ $loop->iteration }}" name="harga_satuan[]"
                                                        value="{{ $joborder->harga_satuan }}" required></td>
                                                <td class="text-center"><input type="number" class="form-control"
                                                        id="totHarga-{{ $loop->iteration }}" name="total_harga[]"
                                                        value="{{ $joborder->total_harga }}" readonly></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="text-center"> TOTAL </td>
                                            <td class="text-center"><input type="text" class="form-control"
                                                    name="totalPo" id="total" value="{{ $order->totalPo }}"
                                                    readonly></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col d-flex justify-content-end mt-0">
                                <button type="submit" class="btn btn-success mt-2"><i
                                        class="fas fa-pen mr-2"></i>Update</button>
                            </div>

                        </div>
                        <!-- /.row -->
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#add").on("click", function() {
                addOrders();
            });

            function addOrders() {
                var index = $("#table-add tbody tr").length + 1;
                var orders =
                    `
                <tr id="row-add-${index}">
                  <td class="text-center" >
                    <button class="btn btn-xs btn-plain" type="button" onclick="hapusRowAdd(${index})" >
                      <i class="fas fa-minus text-danger"></i>
                    </button>
                  </td>
                  <input type="hidden" name="joborder_id[]" value="">
                  <td class="text-center">${index}</td>
                  <td class="text-center"><input type="text" class="form-control" name="no_jo[]"></td>
                  <td>
                    <select class="selectOrder" style="width: 100%" name="nama_barang[]"
                        required>
                        <option value="-" data-nama="" selected></option>
                        @foreach ($barangs as $barang)
                            <option value="{{ $barang }}">
                                {{ $barang }}</option>
                        @endforeach
                    </select>
                    </td>
                  <td class="text-center"><input type="number" class="form-control" id="qty-${index}" name="qty[]" min="1" required></td>
                  <td class="text-center"><input type="number" class="form-control" id="hrgSatuan-${index}" name="harga_satuan[]" required></td>
                  <td class="text-center"><input type="number" class="form-control" id="totHarga-${index}" name="total_harga[]" readonly></td>
                </tr>
                `;
                $("#table-add tbody").append(orders);
                $('.selectOrder').select2({
                    tags: true,
                });
                let lastjo = $(`#table-add tbody tr:eq(${index-2}) td:eq(2) input`).val();
                let first = lastjo.substr(0, 8)
                let last = parseInt(lastjo.substr(8, 4)) + 1
                last = last + ""
                last = last.padStart(4, "0")
                $(`#table-add tbody tr:eq(${index-1}) td:eq(2) input`).val(first + last);
            }

            //tampilin harga otomatis
            $('#table-add').on('keyup', 'input', function(e) {
                var jumlah = 0;
                for (var i = 1; i <= $("#table-add tbody tr").length; i++) {
                    var qty = $(`#qty-${i}`).val();
                    var prc = $(`#hrgSatuan-${i}`).val();
                    var result = parseInt(qty) * parseInt(prc);
                    $(`#totHarga-${i}`).val(result);
                    result = isNaN(result) ? 0 : result;
                    jumlah += result;
                }
                $(`#total`).val(jumlah);
            });

        });

        function getValue(element) {
            // const selectElem = document.getElementById("mySelect");
            // const selectedValue = selectElem.value;
            // console.log(selectedValue); // Output: nilai yang dipilih oleh user, contoh "option2"
            let id = $(element).val()
            let url = "{{ route('getJobOrder', 'param') }}"
            url = url.replace('param', id)

            $.get(url, function(result) {
                let nojo = result.no_jo

                $('#table-add tbody tr:eq(0) td:eq(2) input').val(nojo)
            })
        }

        function hapusRowAdd(noRow) {
            $(`#table-add tbody tr#row-add-${noRow}`).remove();

            let trLength = $('#table-add tbody tr').length;
            let tr;
            for (let i = 0; i < trLength; i++) {
                tr = $(`#table-add tbody tr:eq(${i})`);
                tr.attr('id', `row-add-${(i + 1)}`);
                tr.find('td:eq(0) button').attr('onclick', `hapusRowAdd(${(i + 1)})`);
                tr.find('td:eq(1)').html((i + 1));
                tr.find('td:eq(4) input').attr('id', `qty-${(i + 1)}`);
                tr.find('td:eq(5) input').attr('id', `hrgSatuan-${(i + 1)}`);
                tr.find('td:eq(6) input').attr('id', `totHarga-${(i + 1)}`);
            }
        }
    </script>
@endsection
