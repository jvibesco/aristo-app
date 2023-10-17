@extends('layouts.app', ['title' => 'Actual Produksi'])

@section('konten')
    @php
        use Carbon\Carbon;
    @endphp
    @if (session()->has('success'))
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
                    <h1 class="m-0">Actual Produksi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Actual Produksi</li>
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
                    <h3 class="card-title">Data Produksi</h3>
                </div>
                {{-- card-header --}}
                <div class="card-body">
                    <div class="row mb-4">
                        <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-success"><i
                                class="fas fa-plus-square mr-2"></i>Tambah Produksi</a>
                    </div>
                    {{-- /.row --}}
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            <table id="example0" class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Job Order</th>
                                        <th scope="col" class="text-center">Nama Part</th>
                                        <th scope="col" class="text-center">Material</th>
                                        <th scope="col" class="text-center">Qty</th>
                                        <th scope="col" class="text-center">Duedate</th>
                                        <th scope="col" class="text-center">Proses</th>
                                        <th scope="col" class="text-center">Tanggal Proses</th>
                                        <th scope="col" class="text-center">Jam Mulai</th>
                                        <th scope="col" class="text-center">Jam Selesai</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($actuals as $actual)
                                        @if ($actual->proses->namaProses != 'QC' && $actual->proses->namaProses != 'DELIVERY')
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td>{{ $actual->flowproses->joborder->no_jo }}</td>
                                                <td>{{ $actual->flowproses->joborder->nama_barang }}</td>
                                                <td>{{ $actual->flowproses->material->namaMaterial }}</td>
                                                <td class="text-center">{{ $actual->flowproses->joborder->qty }}</td>
                                                <td class="text-center">
                                                    {{ Carbon::parse($actual->flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ $actual->proses->namaProses }}</td>
                                                <td class="text-center">
                                                    {{ Carbon::parse($actual->tanggal)->format('d/m/Y') }}</td>
                                                <td class="text-center">
                                                    {{ Carbon::parse($actual->jam_mulai)->format('H:i') }}
                                                </td>
                                                @if ($actual->jam_selesai)
                                                    <td class="text-center">
                                                        {{ Carbon::parse($actual->jam_selesai)->format('H:i') }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        @if ($actual->jam_selesai === null)
                                                            <div class="mr-2">
                                                                <a href="" data-toggle="modal"
                                                                    data-target="#editModal{{ $actual->id }}"
                                                                    class="btn btn-primary btn-sm"><i
                                                                        class="fas fa-check"></i></a>
                                                            </div>
                                                            <div>
                                                                <form action="{{ route('actual.destroy', $actual->id) }}"
                                                                    method="POST" class="d-inline">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Yakin Ingin Membatalkan Produksi?')"><i
                                                                            class="fas fa-window-close"></i></button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            <div>
                                                                <a href="" data-toggle="modal"
                                                                    data-target="#showModal{{ $actual->id }}"
                                                                    class="btn btn-warning btn-sm"><i
                                                                        class="fas fa-info-circle"></i></a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    @include('actualProduksi.modal.edit')
                                                    @include('actualProduksi.modal.show')
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- /.row --}}
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    @include('actualProduksi.modal.create')
    {{-- <script>
        function getValue(element) {
            // const selectElem = document.getElementById("mySelect");
            // const selectedValue = selectElem.value;
            // console.log(selectedValue); // Output: nilai yang dipilih oleh user, contoh "option2"
            let id = $(element).val()
            let url = "{{ route('getPart', 'param') }}"
            url = url.replace('param', id)

            $.get(url, function(result) {
                let material = result.material
                let qtyMaterial = result.qtyMaterial
                $('#material').val(material)
                $('#qtyMaterial').val(qtyMaterial)
            })
        }
    </script> --}}
@endsection
