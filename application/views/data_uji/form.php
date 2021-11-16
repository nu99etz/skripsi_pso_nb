<?php

defined('BASEPATH') or exit('No direct script access allowed');

?>

<form action="<?php echo $action; ?>" id="add_uji" method="post" enctype="multipart/form-data">

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama_pasien">Nama Pasien</label>
                <input type="text" class="form-control" name="nama_pasien" id="nama_pasien" placeholder="Nama Pasien">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="alamat_pasien">Alamat Pasien</label>
                <textarea class="form-control" name="alamat_pasien" id="alamat_pasien" placeholder="Alamat Pasien"></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="anak_ke">Anak Ke -</label>
                <input type="number" class="form-control" name="anak_ke" id="anak_ke" placeholder="Anak Ke -">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tanggal_persalinan">Tanggal Persalinan</label>
                <input type="text" class="form-control" name="tanggal_persalinan" id="tanggal_persalinan" placeholder="Tanggal Persalinan">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="usia_ibu">Usia Ibu</label>
                <input type="number" class="form-control" name="usia_ibu" id="usia_ibu" placeholder="Usia Ibu">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="usia_kehamilan">Usia Kehamilan</label>
                <input type="number" class="form-control" name="usia_kehamilan" id="usia_kehamilan" placeholder="Usia Kehamilan">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="tinggi_badan">Tinggi Badan</label>
                <input type="number" class="form-control" name="tinggi_badan" id="tinggi_badan" placeholder="Tinggi Badan">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="bsc">BSC</label>
                <select class="form-control select2" style="width: 100%;" id="bsc" name="bsc">
                    <option></option>
                    <option value="ada">Ada</option>
                    <option value="tidak ada">Tidak Ada</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="riwayat_obsteri">Riwayat Obsteri</label>
                <select class="form-control select2" style="width: 100%;" id="riwayat_obsteri" name="riwayat_obsteri">
                    <option></option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="paritas">Paritas</label>
                <select class="form-control select2" style="width: 100%;" id="paritas" name="paritas">
                    <option></option>
                    <option value="primipara">Primipara</option>
                    <option value="multipara">Multipara</option>
                    <option value="grandemultipara">Grandemultipara</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="tekanan_darah">Tekanan Darah</label>
                <select class="form-control select2" style="width: 100%;" id="tekanan_darah" name="tekanan_darah">
                    <option></option>
                    <option value="rendah">Rendah</option>
                    <option value="normal">Normal</option>
                    <option value="tinggi">Tinggi</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="letak_sungsang">Letak Sungsang</label>
                <select class="form-control select2" style="width: 100%;" id="letak_sungsang" name="letak_sungsang">
                    <option></option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="cpd">CPD</label>
                <select class="form-control select2" style="width: 100%;" id="cpd" name="cpd">
                    <option></option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="plasenta_previa">Plasenta Previa</label>
                <select class="form-control select2" style="width: 100%;" id="plasenta_previa" name="plasenta_previa">
                    <option></option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="peb">PEB</label>
                <select class="form-control select2" style="width: 100%;" id="peb" name="peb">
                    <option></option>
                    <option value="tidak ada">Tidak Ada</option>
                    <option value="rendah">Rendah</option>
                    <option value="berat">Berat</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="oligohidroamnion">Oligohidroamnion</label>
                <select class="form-control select2" style="width: 100%;" id="oligohidroamnion" name="oligohidroamnion">
                    <option></option>
                    <option value="ya">Ya</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="jarak_kelahiran">Jarak Kelahiran</label>
                <input type="number" class="form-control" name="jarak_kelahiran" id="jarak_kelahiran" placeholder="Jarak Kelahiran">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="power_ibu">Power Ibu</label>
                <select class="form-control select2" style="width: 100%;" id="power_ibu" name="power_ibu">
                    <option></option>
                    <option value="lemah">Lemah</option>
                    <option value="normal">Normal</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
        </div>
    </div>

    <div class="form-group">
        <button type="submit" id="simpan" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        <button type="reset" id="ulang" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button>
    </div>
</form>

<script>
     $('#tanggal_persalinan').datepicker({
        autoclose: true,
    });

    $('#tanggal_persalinan').datepicker(
        "setDate", new Date()
    );

    $('#bsc').select2({
        placeholder: "-- PILIH BSC ---",
    });

    $('#riwayat_obsteri').select2({
        placeholder: "-- PILIH RIWAYAT OBSTERI ---",
    });

    $('#paritas').select2({
        placeholder: "-- PILIH PARITAS ---",
    });

    $('#tekanan_darah').select2({
        placeholder: "-- PILIH TEKANAN DARAH ---",
    });

    $('#letak_sungsang').select2({
        placeholder: "-- PILIH LETAK SUNGSANG ---",
    });

    $('#cpd').select2({
        placeholder: "-- PILIH CPD ---",
    });

    $('#plasenta_previa').select2({
        placeholder: "-- PILIH PLASENTA PREVIA ---",
    });

    $('#peb').select2({
        placeholder: "-- PILIH PEB ---",
    });

    $('#oligohidroamnion').select2({
        placeholder: "-- PILIH OLIGOHIDROAMNION ---",
    });

    $('#power_ibu').select2({
        placeholder: "-- PILIH POWER IBU ---",
    });
</script>