<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Latih Optimasi
      <small>Data Latih Optimasi</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Master</li>
      <li class="active">Data Latih Optimasi</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Latih Optimasi</h3>
          </div>
          <div class="box-body">
          <button style="float: right;" action = "<?php echo base_url();?>data_latih_optimasi/form_optimization" type="button" class="hitung btn btn-sm btn-success"><i class="fa fa-refresh"></i> Cek Optimasi</button>
          <br/>
          <br/>
            <table id="data-latih" class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>No</th>
                    <th>Partikel Ke -</th>
                    <?php for($i = 0; $i < 14; $i++) {
                        ?>
                        <th><?php echo "A".$i+1;?></th>
                    <?php  } ?>
                    <th>Fitness</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <tr>
                    <th>No</th>
                    <th>Prtikel Ke -</th>
                    <?php for($i = 0; $i < 14; $i++) {
                        ?>
                        <th><?php echo "A".$i+1;?></th>
                    <?php  } ?>
                    <th>Fitness</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Attribut Optimasi</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped">
              <p id="particle-choice"><b>Partikel Terpilih Ke - <?php echo $choiceParticle;?></b></p>
              <thead>
                <tr>
                  <th>No</th>
                  <th>Attribut Key</th>
                  <th>Nama Attribut</th>
                  <th>Nilai Optimasi</th>
                  <th>Terpilih</th>
                </tr>
              </thead>
              <tbody id="attribute-optimize">
                <?php echo $html;?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Attribut Key</th>
                  <th>Nama Attribut</th>
                  <th>Nilai Optimasi</th>
                  <th>Terpilih</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

</section>
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

?>

<script>
    let _table = $('#data-latih');
    let _url = "<?php echo base_url();?>data_latih_optimasi/ajax";
    let _modal_id = $('#form-optimasi');

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

    $(document).on('click', '.hitung', function() {
        let _url = $(this).attr('action');
        getViewModal(_url, _modal_id);
    });

    $(document).on('submit', '#form', function() {
        event.preventDefault();
        let _url = $(this).attr('action');
        let _data = new FormData($(this)[0]);
        send((data, xhr=null) => {
            if(data.status == 'success') {
                SuccessNotif(data.messages);
                _modal_id.modal('hide');
                _table.DataTable().ajax.reload();
                $('#form-notifikasi').modal('show');
                $('#form-notifikasi').find('.modal-body').html("Partikel Terpilih Ke - " + data.choice);
                $('#attribute-optimize').html(data.html);
                $('#particle-choice').html("Partikel Terpilih Ke - " + data.choice);
            } else if(data.status == 'failed') {
                FailedNotif(data.messages);
            }
        }, _url, 'json', 'post', _data);
    });
    
</script>