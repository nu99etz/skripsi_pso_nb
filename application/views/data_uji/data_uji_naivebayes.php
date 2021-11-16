<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Uji
      <small>Data Uji</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Uji</li>
      <li class="active">Data Uji Naive Bayes</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- <button style="float: right;" type="button" id="import" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Import Excel</button> -->
        <button style="float: right;" action = "<?php echo base_url();?>data_uji/form" type="button" class="add btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data Uji</button>
        <button style="float: right;" action = "<?php echo base_url();?>data_uji_nb/form_optimasi" type="button" class="hitung btn btn-sm btn-success"><i class="fa fa-refresh"></i> Uji Naive Bayes</button>
      </div>
    </div>
    <br/>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Uji Naive Bayes Optimasi</h3>
          </div>
          <div class="box-body">
            <p id="optimize_nb">Total Kesalahan Prediksi = <?php echo $flag['optimizeFlag'];?></p>
            <table id="data-uji-optimize" class="table table-bordered table-striped">
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
                    <th>Prediksi Persalinan</th>
                    <th>Probabilitas SC</th>
                    <th>Probabilitas Normal</th>
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
                    <th>Prediksi Persalinan</th>
                    <th>Probabilitas SC</th>
                    <th>Probabilitas Normal</th>
                </tr>
              </tfoot>
            </table>
            <!-- <button style="float: right;" type="button" id="import" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Import Excel</button>
            <button style="float: right;" type="button" id="cek-pohon" class="btn btn-sm btn-success"><i class="fa fa-tree"></i> Cek Pohon Keputusan</button>
            <button style="float: right;" type="button" id="hitung" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Cek Penghitungan</button> -->
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Uji Naive Bayes Non Optimasi</h3>
          </div>
          <div class="box-body">
            <p id="non_optimize_nb">Total Kesalahan Prediksi = <?php echo $flag['nonOptimizeFlag'];?></p>
            <table id="data-uji-nonoptimize" class="table table-bordered table-striped">
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
                    <th>Prediksi Persalinan</th>
                    <th>Probabilitas SC</th>
                    <th>Probabilitas Normal</th>
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
                    <th>Prediksi Persalinan</th>
                    <th>Probabilitas SC</th>
                    <th>Probabilitas Normal</th>
                </tr>
              </tfoot>
            </table>
            <!-- <button style="float: right;" type="button" id="import" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Import Excel</button>
            <button style="float: right;" type="button" id="cek-pohon" class="btn btn-sm btn-success"><i class="fa fa-tree"></i> Cek Pohon Keputusan</button>
            <button style="float: right;" type="button" id="hitung" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i> Cek Penghitungan</button> -->
          </div>
        </div>
      </div>
    </div>

<?php

$data['modal_id'] = 'form-optimasi';
$data['modal_size'] = 'sm';
$data['modal_title'] = 'Form Optimasi';
$this->load->view('_partial/modal', $data);

$data['modal_id'] = 'form-notifikasi';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Notifikasi';
$this->load->view('_partial/modal', $data);

$data['modal_id'] = 'form-tambah';
$data['modal_size'] = 'lg';
$data['modal_title'] = 'Form Data Uji';
$this->load->view('_partial/modal', $data);

?>

</section>
</div>

<script>
    let _table_optimize = $('#data-uji-optimize');
    let _url_optimize = "<?php echo base_url();?>data_uji_nb/ajax/optimize";

    let _table_non_optimize = $('#data-uji-nonoptimize');
    let _url_non_optimize = "<?php echo base_url();?>data_uji_nb/ajax/nonoptimize"; 

    let _modal_id = $('#form-optimasi');
    let _modal_add = $('#form-tambah');

    $(_table_optimize).DataTable({
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
            url: _url_optimize,
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

    $(_table_non_optimize).DataTable({
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
            url: _url_non_optimize,
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

    $(document).on('click', '.hitung', function() {
      let _url_modal = $(this).attr('action');
      getViewModal(_url_modal, _modal_id);
    });


    $(document).on('click', '.add', function() {
      let _url_modal = $(this).attr('action');
      getViewModal(_url_modal, _modal_add);
    });

    $(document).on('submit', '#form', function() {
      event.preventDefault();
      let _url_form = $(this).attr('action');
      let _data = new FormData($(this)[0]);
      send((data, xhr=null) => {
        if(data.status == 'success') {
          SuccessNotif(data.messages);
          _modal_id.modal('hide');
          _table_optimize.DataTable().ajax.reload();
          _table_non_optimize.DataTable().ajax.reload();
          $('#optimize_nb').html('Total Kesalahan Prediksi = ' + data.flag['optimizeFlag']);
          $('#non_optimize_nb').html('Total Kesalahan Prediksi = ' + data.flag['nonOptimizeFlag']);
          $('#form-notifikasi').modal('show');
          $('#form-notifikasi').find('.modal-body').html("Partikel Terpilih Ke - " + data.particleChoice);
        } else {
          FailedNotif(data.messages);
        }
      }, _url_form, 'json', 'post', _data);
    });

    $(document).on('submit', '#add_uji', function() {
      event.preventDefault();
      let _url_form = $(this).attr('action');
      let _data = new FormData($(this)[0]);
      send((data, xhr=null) => {
        if(data.status == 'success') {
          SuccessNotif(data.messages);
          _modal_add.modal('hide');
          _table_optimize.DataTable().ajax.reload();
          _table_non_optimize.DataTable().ajax.reload();
          $('#optimize_nb').html('Total Kesalahan Prediksi = ' + data.flag['optimizeFlag']);
          $('#non_optimize_nb').html('Total Kesalahan Prediksi = ' + data.flag['nonOptimizeFlag']);
          $('#form-notifikasi').modal('show');
          $('#form-notifikasi').find('.modal-body').html(data.notif);
        } else {
          FailedNotif(data.messages);
        }
      }, _url_form, 'json', 'post', _data);
    });
</script>