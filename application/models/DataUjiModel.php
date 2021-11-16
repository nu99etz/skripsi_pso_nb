<?php

defined('BASEPATH') or exit('No direct script access allowed');

class DataUjiModel extends MainModel
{
    private function DataUji()
    {
        $data_uji['table'] = 'data_uji';
        $data_uji['column_search'] = [
            'nama_pasien',
            'alamat_pasien',
            'anak_ke',
            'tanggal_persalinan',
            'usia_ibu',
            'usia_kehamilan',
            'tinggi_badan',
            'bsc',
            'riwayat_obsteri',
            'paritas',
            'tekanan_darah',
            'letak_sungsang',
            'cpd',
            'plasenta_previa',
            'peb',
            'oligohidroamnion',
            'jarak_kelahiran',
            'power_ibu',
            'persalinan'
        ];
        $data_uji['column_order'] = [
            null,
            'nama_pasien',
            'alamat_pasien',
            'anak_ke',
            'tanggal_persalinan',
            'usia_ibu',
            'usia_kehamilan',
            'tinggi_badan',
            'bsc',
            'riwayat_obsteri',
            'paritas',
            'tekanan_darah',
            'letak_sungsang',
            'cpd',
            'plasenta_previa',
            'peb',
            'oligohidroamnion',
            'jarak_kelahiran',
            'power_ibu',
            'persalinan',
            null
        ];
        $data_uji['order'] = [
            'id' => 'ASC'
        ];

        return $data_uji;
    }

    public function DataUjiDraw()
    {
        $data_uji = $this->DataUji();
        return $this->getDataTables($data_uji['table'], $data_uji['column_search'], $data_uji['column_order'], $data_uji['order']);
    }

    public function DataUjiTotal()
    {
        $data_uji = $this->DataUji();
        return $this->getDataTablesCountAll($data_uji['table'], $data_uji['column_search'], $data_uji['column_order'], $data_uji['order']);
    }

    public function DataUjiFilter()
    {
        $data_uji = $this->DataUji();
        return $this->getDataTablesCountFiltered($data_uji['table'], $data_uji['column_search'], $data_uji['column_order'], $data_uji['order']);
    }

    public function getAllDataUji()
    {
        $sql = $this->db->select('*')->from('data_uji')->get();
        return $sql->result_array();
    }

    public function getTotal()
    {
        $sql = $this->db->select('*')->from('data_uji')->get();
        return $sql->num_rows();
    }

    public function importExcel($data)
    {
        $row = [];
        $record = [];
        foreach($data as $value) {
            $row['id'] = $value[0];
            $row['nama_pasien'] = $value[1];
            $row['alamat_pasien'] = $value[2];
            $row['anak_ke'] = $value[3];
            $row['tanggal_persalinan'] = $value[4];
            $row['usia_ibu'] = $value[5];
            $row['usia_kehamilan'] = $value[6];
            $row['tinggi_badan'] = $value[7];
            $row['bsc'] = $value[8];
            $row['riwayat_obsteri'] = $value[9];
            $row['paritas'] = $value[10];
            $row['tekanan_darah'] = $value[11];
            $row['letak_sungsang'] = $value[12];
            $row['cpd'] = $value[13];
            $row['plasenta_previa'] = $value[14];
            $row['peb'] = $value[15];
            $row['oligohidroamnion'] = $value[16];
            $row['jarak_kelahiran'] = $value[17];
            $row['power_ibu'] = $value[18];
            $row['persalinan'] = $value[19];
            $record[] = $row;
        }

        $this->db->trans_start();
        // Delete All Record On Data Latih Optimasi
        $this->db->truncate('data_uji');

        $this->db->insert_batch('data_uji', $record);

        $this->db->trans_commit();
    }
}
