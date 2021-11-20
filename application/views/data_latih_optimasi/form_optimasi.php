<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form action = "<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Jumlah Iterasi</label>
            <input type="text" class="form-control" name="iteration" id="iteration" placeholder="Jumlah Iterasi">
    </div>
    <div class="form-group">
        <label for="nama">Nilai Minimal C</label>
            <input type="text" class="form-control" name="c1" id="c1" placeholder="Nilai Minimal C">
    </div>
    <div class="form-group">
        <label for="nama">Nilai Maximal C</label>
            <input type="text" class="form-control" name="c2" id="c2" placeholder="Nilai Maximal C">
    </div>
    <div class="form-group">
        <label for="nama">Nilai Minimal R</label>
            <input type="text" class="form-control" name="r1" id="r1" placeholder="Nilai Minimal R">
    </div>
    <div class="form-group">
        <label for="nama">Nilai Maximal R</label>
            <input type="text" class="form-control" name="r2" id="r2" placeholder="Nilai Maximal R">
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-refresh"></i> Optimisasi</button>
        <!-- <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button> -->
    </div>
</form>