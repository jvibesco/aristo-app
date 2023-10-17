@extends('layouts.app', ['title' => 'Flow Proses'])

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
    @elseif (session()->has('failed'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('failed') }}
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
                    <h1 class="m-0">Flow Proses</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <li class="breadcrumb-item active">Flow Proses</li>
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
                    <h3 class="card-title">Daftar Flow Proses</h3>
                </div>
                {{-- card-header --}}
                <div class="card-body">
                    <div class="row mb-4">
                        <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-success"><i
                                class="fas fa-plus-square mr-2"></i>Buat Flow Proses</a>
                    </div>
                    {{-- /.row --}}
                    <div class="row">
                        <div class="table-responsive col-lg-12">
                            <table id="example0" class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">No</th>
                                        <th class="text-center" scope="col">Job Order</th>
                                        <th class="text-center" scope="col">No. PO</th>
                                        <th class="text-center" scope="col">Nama Part</th>
                                        <th class="text-center" scope="col">Material</th>
                                        <th class="text-center" scope="col">Qty</th>
                                        <th class="text-center" scope="col">Duedate</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($flowproseses as $flowproses)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $flowproses->joborder->no_jo }}</td>
                                            <td>{{ $flowproses->joborder->order->noPo }}</td>
                                            <td>{{ $flowproses->joborder->nama_barang }}</td>
                                            <td>{{ $flowproses->material->namaMaterial }}</td>
                                            <td class="text-center">{{ $flowproses->joborder->qty }}</td>
                                            <td class="text-center">
                                                {{ Carbon::parse($flowproses->joborder->order->tglPoAkhir)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <div class="mr-2">
                                                        <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                                            data-target="#modalShow{{ $flowproses->id }}"><i
                                                                class="fas fa-eye"></i></a>
                                                        @include('flowproses.modal.show')
                                                    </div>
                                                    <div class="mr-2">
                                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal"
                                                            data-target="#modalEdit{{ $flowproses->id }}"><i
                                                                class="far fa-edit"></i></a>
                                                        @include('flowproses.modal.edit')
                                                    </div>
                                                    <div>
                                                        <form action="{{ route('flowproses.destroy', $flowproses->id) }}"
                                                            method="POST" class="d-inline">
                                                            @method('delete')
                                                            @csrf
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Yakin Ingin Menghapus Flow Proses?')"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
    @include('flowproses.modal.create')

    <script>
        function addRow() {
            var index = $(`#table-add tbody tr`).length + 1;
            console.log(index);
            var orders =
                `
                <tr id="row-add-${index}">
                    <td class="text-center">
                        <button class="btn btn-xs btn-plain" type="button" onclick="hapusRowAdd(${index})">
                            <i class="fas fa-minus text-danger"></i>
                        </button>
                    </td>
                    <input type="hidden" name="urutan[]" value='${index}'>
                    <td class="text-center">${index}</td>
                    <td class="text-center">
                        <select
                        class="form-control" name="proses_id[]" required>
                        <option value="" data-nama="" selected disabled>PILIH PROSES
                        </option>
                        @foreach ($proseses as $proses)
                            @if (old('proses_id') == $proses->id)
                                <option value="{{ $proses->id }}" selected>
                                    {{ $proses->namaProses }}
                                </option>
                            @else
                                <option value="{{ $proses->id }}">{{ $proses->namaProses }}
                                </option>
                            @endif
                        @endforeach
                        </select>
                    </td>
                    <td class="text-center"><input type="number" class="form-control" name="planningJam[]" value=""
                            </td>
                </tr>
                `;
            $(`#table-add tbody`).append(orders);
        }

        function addRowEdit(id) {
            var index = $(`#table-add-${id} tbody tr`).length + 1;
            console.log(index);
            var orders =
                `
                <tr id="row-add-${index}">
                    <td class="text-center">
                        <button class="btn btn-xs btn-plain" type="button" onclick="hapusRowEdit(${id}, ${index})">
                            <i class="fas fa-minus text-danger"></i>
                        </button>
                    </td>
                    <input type="hidden" name="urutan[]" value='${index}'>
                    <td class="text-center">${index}</td>
                    <td class="text-center">
                        <select
                        class="form-control" name="proses_id[]" required>
                        <option value="" data-nama="" selected disabled>PILIH PROSES
                        </option>
                        @foreach ($proseses as $proses)
                            @if (old('proses_id') == $proses->id)
                                <option value="{{ $proses->id }}" selected>
                                    {{ $proses->namaProses }}
                                </option>
                            @else
                                <option value="{{ $proses->id }}">{{ $proses->namaProses }}
                                </option>
                            @endif
                        @endforeach
                        </select>
                    </td>
                    <td class="text-center"><input type="number" class="form-control" name="planningJam[]" value=""
                            </td>
                </tr>
                `;
            $(`#table-add-${id} tbody`).append(orders);
        }

        function hapusRowAdd(noRow) {
            $(`#table-add tbody tr#row-add-${noRow}`).remove();

            let trLength = $(`#table-add tbody tr`).length;
            let tr;
            for (let i = 0; i < trLength; i++) {
                tr = $(`#table-add tbody tr:eq(${i})`);
                tr.attr('id', `row-add-${(i + 1)}`);
                tr.find('td:eq(0) button').attr('onclick', `hapusRowAdd(${(i + 1)})`);
                tr.find('td:eq(1)').html((i + 1));
            }
        }

        function hapusRowEdit(id, noRow) {
            $(`#table-add-${id} tbody tr#row-add-${noRow}`).remove();

            let trLength = $(`#table-add-${id} tbody tr`).length;
            let tr;
            for (let i = 0; i < trLength; i++) {
                tr = $(`#table-add-${id} tbody tr:eq(${i})`);
                tr.attr('id', `row-add-${(i + 1)}`);
                tr.find('td:eq(0) button').attr('onclick', `hapusRowEdit(${id}, ${(i + 1)})`);
                tr.find('td:eq(1)').html((i + 1));
            }
        }

        function getNamaPart(element) {
            // const selectElem = document.getElementById("mySelect");
            // const selectedValue = selectElem.value;
            // console.log(selectedValue); // Output: nilai yang dipilih oleh user, contoh "option2"
            let id = $(element).val()
            let name = $(element).find(':selected').data('name')
            let url = "{{ route('getProses', 'param') }}"
            url = url.replace('param', name)

            $.get(url, {
                name
            }, res => {
                //klo sukses
                if (res.success !== undefined) {
                    $('#table-add tbody').html(''); //ngosongin tbody
                    $('.material').html(''); //ngosongin select material
                    let data = res.success;
                    let data2 = res.material;
                    console.log(data)
                    let option = `
                    @foreach ($materials as $material)
                        ${data2.material_id == '{{ $material->id }}' ? `<option value="${data2.material_id}" selected>${data2.namaMaterial}</option>` : '<option value="{{ $material->id }}">{{ $material->namaMaterial }}</option>'}
                    @endforeach`
                    let tr = data.map((d, i) => {
                        return `
                    <tr id="row-add-${i+1}">
                        <td class="text-center">
                            <button class="btn btn-xs btn-plain" type="button" onclick="hapusRowAdd(${i+1})">
                                <i class="fas fa-minus text-danger"></i>
                            </button>
                        </td>
                        <input type="hidden" name="urutan[]" value='${i+1}'>
                        <td class="text-center">${i+1}</td>
                        <td class="text-center">
                        <select
                        class="form-control" name="proses_id[]" required>
                        @foreach ($proseses as $proses)
                            ${d.proses_id == '{{ $proses->id }}' ? `<option value="${d.proses_id}" selected>${d.namaProses}</option>` : '<option value="{{ $proses->id }}">{{ $proses->namaProses }}</option>'}
                        @endforeach
                        </select>
                        </td>
                        <td class="text-center"><input type="number" class="form-control" name="planningJam[]" value=""
                                </td>
                    </tr>
                    `;
                    })

                    $('.material').html(option);
                    $('#table-add tbody').html(tr.join(''));
                }
            }).fail(xhr => {
                // fail
            })
            // let nojo = result.no_jo
            // $('#table-add tbody tr:eq(0) td:eq(2) input').val(nojo)

        }
    </script>
@endsection
