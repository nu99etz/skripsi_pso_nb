<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form action="<?php echo $action; ?>" id="import_latih" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputFile">Upload File</label>
        <input type="file" id="exampleInputFile" name="upload" id="upload">
        <!-- <p class="help-block">Example block-level help text here.</p> -->
    </div>
    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <!-- <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button> -->
    </div>
</form>