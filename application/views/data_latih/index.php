<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Latih
            <small>Data Latih</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Master</li>
            <li class="active">Data Latih</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Latih</h3>
                    </div>
                    <div class="box-body">
                        <table id="data-latih" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat Pasien</th>
                                    <th>Anak Ke - </th>
                                    <th>Tanggal Persalinan</th>
                                    <th>Usia Ibu</th>
                                    <th>Usia Kehamilan</th>
                                    <th>Tinggi Badan</th>
                                    <th>BSC</th>
                                    <th>Riwayat Obsteri</th>
                                    <th>Paritas</th>
                                    <th>Tekanan Darah</th>
                                    <th>Letak Sungsang</th>
                                    <th>CPD</th>
                                    <th>Plasenta Previa</th>
                                    <th>PEB</th>
                                    <th>Oligohidroamnion</th>
                                    <th>Jarak Kelahiran</th>
                                    <th>Power Ibu</th>
                                    <th>Persalinan</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pasien</th>
                                    <th>Alamat Pasien</th>
                                    <th>Anak Ke - </th>
                                    <th>Tanggal Persalinan</th>
                                    <th>Usia Ibu</th>
                                    <th>Usia Kehamilan</th>
                                    <th>Tinggi Badan</th>
                                    <th>BSC</th>
                                    <th>Riwayat Obsteri</th>
                                    <th>Paritas</th>
                                    <th>Tekanan Darah</th>
                                    <th>Letak Sungsang</th>
                                    <th>CPD</th>
                                    <th>Plasenta Previa</th>
                                    <th>PEB</th>
                                    <th>Oligohidroamnion</th>
                                    <th>Jarak Kelahiran</th>
                                    <th>Power Ibu</th>
                                    <th>Persalinan</th>
                                </tr>
                            </tfoot>
                        </table>
                        <button style="float: right;" action = "<?php echo base_url();?>data_latih/import_form" type="button" id="import" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Import Excel</button>
                        <!-- <button style="float: right;" type="button" id="cek-pohon" class="btn btn-sm btn-success"><i class="fa fa-tree"></i> Cek Pohon Keputusan</button>
            <button style="float: right;" type="button" id="hitung" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Cek Penghitungan</button> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php

$data['modal_id'] = 'form-upload';
$data['modal_size'] = 'sm';
$data['modal_title'] = 'Form Import Excel';
$this->load->view('_partial/modal', $data);

?>

<script>
    let _table = $('#data-latih');
    let _url = "<?php echo base_url(); ?>data_latih/ajax";

    let _modal_upload = $('#form-upload');


    $(_table).DataTable({
        language: {
            "decimal": "",
            "emptyTable": "Data kosong",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(hasil dari _MAX_ total data)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Menampilkan _MENU_ data",
            "loadingRecords": "Memuat...",
            "processing": "Memproses...",
            "search": "Cari:",
            "zeroRecords": "Tidak ada data yang sesuai",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            },
            "aria": {
                "sortAscending": ": mengurutkan dari terkecil",
                "sortDescending": ": mengurutkan dari terbesar"
            }
        },
        autoWidth: false,
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [],
        ajax: {
            url: _url,
            type: "POST",
            dataType: "json"
        },
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        columnDefs: [{
            targets: [0],
            orderable: false
        }, ],
        paging: true,
    });

    $(document).on('click', '#import', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal_upload);
    });

    $(document).on('submit', 'form#import_latih', function() {
        event.preventDefault();
        let _url = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr = null) => {

            if (data.status == 200) {
                SuccessNotif(data.messages);
                _modal_upload.modal('hide');
                _table.DataTable().ajax.reload();
            } else if (data.status == 500) {
                FailedNotif(data.messages);
            }

        }, _url, 'json', 'post', _data);
    });
</script>