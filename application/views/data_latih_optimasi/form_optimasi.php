<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form action = "<?php echo $action; ?>" id="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="nama">Jumlah Iterasi</label>
            <input type="text" class="form-control" name="iteration" id="iteration" placeholder="Jumlah Iterasi">
    </div>
    <div class="form-group">
        <label for="nama">C1</label>
            <input type="text" class="form-control" name="c1" id="c1" placeholder="C1">
    </div>
    <div class="form-group">
        <label for="nama">C2</label>
            <input type="text" class="form-control" name="c2" id="c2" placeholder="C2">
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-refresh"></i> Optimisasi</button>
        <!-- <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button> -->
    </div>
</form>