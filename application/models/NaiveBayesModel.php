<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('ConverterModel.php');

class NaiveBayesModel extends MainModel
{
    private function DataUji($optimize = 'optimize')
    {
        if ($optimize == 'optimize') {
            $data_uji['table'] = 'data_uji_nb_optimize';
        } else {
            $data_uji['table'] = 'data_uji_nb';
        }
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
            'persalinan',
            'prediksi_persalinan',
            'SC',
            'Normal'
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
            'prediksi_persalinan',
            'SC',
            'Normal',
            null
        ];
        $data_uji['order'] = [
            'id' => 'ASC'
        ];

        return $data_uji;
    }

    public function DataUjiDraw($optimize = 'optimize')
    {
        $data_uji = $this->DataUji($optimize);
        return $this->getDataTables($data_uji['table'], $data_uji['column_search'], $data_uji['column_order'], $data_uji['order']);
    }

    public function DataUjiTotal($optimize = 'optimize')
    {
        $data_uji = $this->DataUji($optimize);
        return $this->getDataTablesCountAll($data_uji['table'], $data_uji['column_search'], $data_uji['column_order'], $data_uji['order']);
    }

    public function DataUjiFilter($optimize = 'optimize')
    {
        $data_uji = $this->DataUji($optimize);
        return $this->getDataTablesCountFiltered($data_uji['table'], $data_uji['column_search'], $data_uji['column_order'], $data_uji['order']);
    }

    public function getAllDataUji()
    {
        $sql = $this->db->select('*')->from('data_uji')->get();
        return $sql->result_array();
    }

    public function getClasses()
    {
        $sql = $this->db->select('*')->from('attribute')->get();
        return $sql->result_array();
    }

    public function insertDataUjiNB($class, $attribute, $optimize = 'optimize')
    {
        $post = $this->input->post();

        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required');
        $this->form_validation->set_rules('alamat_pasien', 'Alamat Pasien', 'required');
        $this->form_validation->set_rules('anak_ke', 'Anak Ke - ', 'required');
        $this->form_validation->set_rules('tanggal_persalinan', 'Tanggal Persalinan', 'required');
        $this->form_validation->set_rules('usia_ibu', 'Usia Ibu', 'required');
        $this->form_validation->set_rules('usia_kehamilan', 'Usia Kehamilan', 'required');
        $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', 'required');
        $this->form_validation->set_rules('bsc', 'BSC', 'required');
        $this->form_validation->set_rules('riwayat_obsteri', 'Riwayat Obsteri', 'required');
        $this->form_validation->set_rules('paritas', 'Paritas', 'required');
        $this->form_validation->set_rules('tekanan_darah', 'Tekanan Darah', 'required');
        $this->form_validation->set_rules('letak_sungsang', 'Letak Sungsang', 'required');
        $this->form_validation->set_rules('cpd', 'CPD', 'required');
        $this->form_validation->set_rules('plasenta_previa', 'Plasenta Previa', 'required');
        $this->form_validation->set_rules('peb', 'PEB', 'required');
        $this->form_validation->set_rules('oligohidroamnion', 'Oligohidroamnion', 'required');
        $this->form_validation->set_rules('jarak_kelahiran', 'Jarak Kelahiran', 'required');
        $this->form_validation->set_rules('power_ibu', 'Power Ibu', 'required');

        if ($this->form_validation->run()) {

            $converter = new ConverterModel();

            foreach ($attribute as $key => $attributes) {
                if ($attributes == 'usia_ibu') {
                    $id = 1;
                } else if ($attributes == 'usia_kehamilan') {
                    $id = 2;
                } else if ($attributes == 'tinggi_badan') {
                    $id = 3;
                } else if ($attributes == 'jarak_kelahiran') {
                    $id = 13;
                } else {
                    $id = 0;
                }

                if ($id == 0) {
                    $predict[] = $post[$attributes];
                } else {
                    $predict[] = $converter->getNumberConvert($id, $post[$attributes]);
                }
            }

            $predict = $class->predict($predict);

            $data_uji = [
                'nama_pasien' => $post['nama_pasien'],
                'alamat_pasien' => $post['alamat_pasien'],
                'anak_ke' => $post['anak_ke'],
                'tanggal_persalinan' => $post['tanggal_persalinan'],
                'usia_ibu' => $post['usia_ibu'],
                'usia_kehamilan' => $post['usia_kehamilan'],
                'tinggi_badan' => $post['tinggi_badan'],
                'bsc' => $post['bsc'],
                'riwayat_obsteri' => $post['riwayat_obsteri'],
                'paritas' => $post['paritas'],
                'tekanan_darah' => $post['tekanan_darah'],
                'letak_sungsang' => $post['letak_sungsang'],
                'cpd' => $post['cpd'],
                'plasenta_previa' => $post['plasenta_previa'],
                'peb' => $post['peb'],
                'oligohidroamnion' => $post['oligohidroamnion'],
                'jarak_kelahiran' => $post['jarak_kelahiran'],
                'power_ibu' => $post['power_ibu']
            ];

            $predict_nb = [
                'persalinan' => array_keys($predict)[0],
                'prediksi_persalinan' => array_keys($predict)[0],
                'sc' => $predict['sc'],
                'normal' => $predict['normal']
            ];

            if ($optimize == 'nonoptimize') {

                $predict_uji = [
                    'persalinan' => array_keys($predict)[0],
                ];

                $uji = array_merge($data_uji, $predict_uji);
                $nb = array_merge($data_uji, $predict_nb);

                $this->db->trans_start();

                $this->db->insert('data_uji', $uji);

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();

                    $this->db->trans_start();

                    $this->db->insert('data_uji_nb', $nb);

                    if ($this->db->trans_status() === false) {
                        $this->db->trans_rollback();
                    } else {
                        $this->db->trans_commit();
                    }
                }

                $notif = '';
                $notif .= 'Pada Naive Bayes Non Optimasi : Nama ' . ucwords($post['nama_pasien']) . ' diprediksi akan melahirkan secara ' . array_keys($predict)[0];

            } else {

                $nb = array_merge($data_uji, $predict_nb);

                $this->db->trans_start();

                $this->db->insert('data_uji_nb_optimize', $nb);

                if ($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }

                $notif = '';
                $notif .= 'Pada Naive Bayes Optimasi : Nama ' . ucwords($post['nama_pasien']) . ' diprediksi akan melahirkan secara ' . array_keys($predict)[0];
            }

            $response = [
                'status' => 'success',
                'prediction' => array_keys($predict)[0],
                'notif' => $notif
            ];

        } else {
            $response = [
                'status' => 'notvalid',
                'messages' => validation_errors()
            ];
        }

        return $response;
    }

    public function insertNaiveBayes($class, $attribute, $optimize = 'optimize')
    {

        // $this->maintence->Debug($attribute);
        $data_uji = $this->getAllDataUji();
        $table = $this->DataUji($optimize);

        $this->db->trans_start();
        // Delete All Record On Data Uji
        $this->db->truncate($table['table']);
        $row = [];
        $record = [];
        $rx = [];

        $converter = new ConverterModel();

        foreach ($data_uji as $value) {
            $row['id'] = $value['id'];
            $row['nama_pasien'] = $value['nama_pasien'];
            $row['alamat_pasien'] = $value['alamat_pasien'];
            $row['anak_ke'] = $value['anak_ke'];
            $row['tanggal_persalinan'] = $value['tanggal_persalinan'];
            $row['usia_ibu'] = $value['usia_ibu'];
            $row['usia_kehamilan'] = $value['usia_kehamilan'];
            $row['tinggi_badan'] = $value['tinggi_badan'];
            $row['bsc'] = $value['bsc'];
            $row['riwayat_obsteri'] = $value['riwayat_obsteri'];
            $row['paritas'] = $value['paritas'];
            $row['tekanan_darah'] = $value['tekanan_darah'];
            $row['letak_sungsang'] = $value['letak_sungsang'];
            $row['cpd'] = $value['cpd'];
            $row['plasenta_previa'] = $value['plasenta_previa'];
            $row['peb'] = $value['peb'];
            $row['oligohidroamnion'] = $value['oligohidroamnion'];
            $row['jarak_kelahiran'] = $value['jarak_kelahiran'];
            $row['power_ibu'] = $value['power_ibu'];
            $row['persalinan'] = $value['persalinan'];

            $predict_row = [];

            foreach ($attribute as $key => $attributes) {
                if ($attributes == 'usia_ibu') {
                    $id = 1;
                } else if ($attributes == 'usia_kehamilan') {
                    $id = 2;
                } else if ($attributes == 'tinggi_badan') {
                    $id = 3;
                } else if ($attributes == 'jarak_kelahiran') {
                    $id = 13;
                } else {
                    $id = 0;
                }

                if ($id == 0) {
                    $predict_row[] = $value[$attributes];
                } else {
                    $predict_row[] = $converter->getNumberConvert($id, $value[$attributes]);
                }
            }

            $predict = $class->predict($predict_row);

            $row['prediksi_persalinan'] = array_keys($predict)[0];

            $row['sc'] = $predict['sc'];
            $row['normal'] = $predict['normal'];

            $record[] = $row;
        }

        $this->db->insert_batch($table['table'], $record);

        $this->db->trans_commit();
    }

    public function checkFalse()
    {
        $optimize_attribute = $this->db->select('persalinan, prediksi_persalinan')->from('data_uji_nb_optimize')->get();
        $attribute_non_optimize = $this->db->select('persalinan, prediksi_persalinan')->from('data_uji_nb')->get();

        $flag_optimize = 0;
        $flag_non_optimize = 0;

        foreach ($optimize_attribute->result_array() as $value) {
            if ($value['persalinan'] != $value['prediksi_persalinan']) {
                $flag_optimize++;
            }
        }

        foreach ($attribute_non_optimize->result_array() as $value) {
            if ($value['persalinan'] != $value['prediksi_persalinan']) {
                $flag_non_optimize++;
            }
        }

        return [
            'optimizeFlag' => $flag_optimize,
            'nonOptimizeFlag' => $flag_non_optimize
        ];
    }
}
