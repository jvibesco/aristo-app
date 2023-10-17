@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aristo | {{ $title }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini sidebar-collapse sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('konten')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('layouts.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <script>
        let tableData = $('#tableData').DataTable()
        $(function() {
            $('.select2').select2({
                dropdownParent: "#addModal"
            });

            $('.select3').select2();

            $('#mySelect').select2();

            $('.selectOrder').select2({
                tags: true,
            });

            $('#mySelect2').select2();
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        $(function() {
            $("#example1").DataTable({
                ordering: false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    },
                }, "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $('#example0').DataTable({
                ordering: false,
            });
            $('#example3').DataTable({
                ordering: false,
            });
            $('table.display').DataTable({
                ordering: false,
                lengthMenu: [5, 10, 25, 50], // Menentukan opsi "Show Entries"
                pageLength: 5 // Menentukan jumlah entri awal yang ditampilkan
            });
        });

        function showProses(element) {
            let id = $(element).val()
            let url = "{{ route('getFlowProses') }}"

            $.get(url, {
                id
            }, res => {
                // kalo sukses
                let data = res.data;
                $('#thisProses').html(''); //ngosongin select
                $('#showProses').removeClass('d-none')

                $('#thisProses').html(data);
            }).fail(xhr => {
                // fail
            })
        }


        function reloadTable() {
            $('#tableData').DataTable().destroy()
            const tanggal = $('#tanggal').val()
            const proses = $('#proses').val()
            let url = "{{ route('data') }}"

            $.get(url, {
                tanggal,
                proses
            }, res => {
                // kalo sukses
                $('#tableData tbody').html(''); //ngosongin tbody

                let data = res.data;
                let tr = data.map((d, i) => {
                    var tanggalNormal = new Date(d.planningTanggal);
                    var options = {
                        year: 'numeric',
                        month: '2-digit', // Menampilkan bulan dalam format dua digit (dengan angka 0 jika kurang dari 10)
                        day: '2-digit' // Menampilkan tanggal dalam format dua digit (dengan angka 0 jika kurang dari 10)
                    };
                    var tanggal = d.tanggal != null ? new Date(d.tanggal) : null;
                    var jam_mulai = d.jam_mulai != null ? new Date(d.jam_mulai) : null;
                    var jam_selesai = d.jam_selesai != null ? new Date(d.jam_selesai) : null;
                    return `
                    <tr>
                        <td class="text-center">${i+1}</td>
                        <td class="text-center">${d.no_jo}</td>
                        <td class="text-center">${d.namaProses}</td>
                        <td class="text-center">${d.planningJam ? d.planningJam : ''}</td>
                        <td class="text-center">${tanggalNormal.toLocaleDateString('id-ID', options)}</td>
                        <td class="text-center">${tanggal != null ? tanggal.toLocaleDateString('id-ID', options) : ''}</td>
                        <td class="text-center">${jam_mulai != null ? jam_mulai.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : ''}</td>
                        <td class="text-center">${jam_selesai != null ? jam_selesai.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : ''}</td>
                        <td class="text-center">${d.operator == null ? '' : d.operator}</td>
                    </tr>
                    `;
                })
                $('#tableData tbody').html(tr.join(''));
                $('#tableData').DataTable()
            }).fail(xhr => {
                // fail
            })
        }

        function clearForm(event) {
            event.preventDefault();
            // Mengakses elemen-elemen input dalam formulir berdasarkan ID
            var inputField1 = document.getElementById("start_date");
            var inputField2 = document.getElementById("end_date");
            var inputField3 = document.getElementById("namaCustomer");

            // Mengatur nilai-nilai input menjadi kosong
            inputField1.value = "";
            inputField2.value = "";
            inputField3.value = "";
        }

        function clearForm2(event) {
            event.preventDefault();
            // Mengakses elemen-elemen input dalam formulir berdasarkan ID
            var inputField1 = document.getElementById("tanggal_awal");
            var inputField2 = document.getElementById("tanggal_akhir");

            // Mengatur nilai-nilai input menjadi kosong
            inputField1.value = "";
            inputField2.value = "";
            $('#mySelect').val(null).trigger('change');
            $('#mySelect2').val(null).trigger('change');
        }

        function clearForm3(event) {
            event.preventDefault();
            // Mengakses elemen-elemen input dalam formulir berdasarkan ID
            var inputField1 = document.getElementById("tanggal");

            // Mengatur nilai-nilai input menjadi kosong
            inputField1.value = "";
            $('#proses').val(null).trigger('change');
        }
    </script>
</body>

</html>
