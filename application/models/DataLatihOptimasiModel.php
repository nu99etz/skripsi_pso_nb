<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('DataLatihModel.php');

class DataLatihOptimasiModel extends MainModel
{
    private function DataLatihOptimasi()
    {
        $data_latih['table'] = 'data_latih_optimasi';
        $data_latih['column_search'] = [
            'id',
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
            'fitness',
            'persalinan',
            'terpilih'
        ];
        $data_latih['column_order'] = [
            null,
            'id',
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
            'fitness',
            'persalinan',
            'terpilih',
            null
        ];
        $data_latih['order'] = [
            'id' => 'ASC'
        ];

        return $data_latih;
    }

    public function DataLatihOptimasiDraw()
    {
        $data_latih = $this->DataLatihOptimasi();
        return $this->getDataTables($data_latih['table'], $data_latih['column_search'], $data_latih['column_order'], $data_latih['order']);
    }

    public function DataLatihOptimasiTotal()
    {
        $data_latih = $this->DataLatihOptimasi();
        return $this->getDataTablesCountAll($data_latih['table'], $data_latih['column_search'], $data_latih['column_order'], $data_latih['order']);
    }

    public function DataLatihOptimasiFilter()
    {
        $data_latih = $this->DataLatihOptimasi();
        return $this->getDataTablesCountFiltered($data_latih['table'], $data_latih['column_search'], $data_latih['column_order'], $data_latih['order']);
    }

    public function insertDataLatihOptimize($data)
    {
        $data_latih_model = new DataLatihModel();
        $data_latih = $data_latih_model->getAllDataLatih();

        // $this->maintence->Debug($data_latih);
        
        $this->db->trans_start();
        // Delete All Record On Data Latih Optimasi
        $this->db->truncate('data_latih_optimasi');

        $row = [];
        $record = [];
        $flag = 0;
        for($i = 0; $i < count($data['Swarm']); $i++) {
            $row['id'] = $data_latih[$i]['id'];
            $row['nama_pasien'] = $data_latih[$i]['nama_pasien'];
            $row['alamat_pasien'] = $data_latih[$i]['alamat_pasien'];
            $row['anak_ke'] = $data_latih[$i]['anak_ke'];
            $row['tanggal_persalinan'] = $data_latih[$i]['tanggal_persalinan'];
            $row['usia_ibu'] = $data['Swarm'][$i]['P_BEST']['POSITION'][1];
            $row['usia_kehamilan'] = $data['Swarm'][$i]['P_BEST']['POSITION'][2];
            $row['tinggi_badan'] = $data['Swarm'][$i]['P_BEST']['POSITION'][3];
            $row['bsc'] = $data['Swarm'][$i]['P_BEST']['POSITION'][4];
            $row['riwayat_obsteri'] = $data['Swarm'][$i]['P_BEST']['POSITION'][5];
            $row['paritas'] = $data['Swarm'][$i]['P_BEST']['POSITION'][6];
            $row['tekanan_darah'] = $data['Swarm'][$i]['P_BEST']['POSITION'][7];
            $row['letak_sungsang'] = $data['Swarm'][$i]['P_BEST']['POSITION'][8];
            $row['cpd'] = $data['Swarm'][$i]['P_BEST']['POSITION'][9];
            $row['plasenta_previa'] = $data['Swarm'][$i]['P_BEST']['POSITION'][10];
            $row['peb'] = $data['Swarm'][$i]['P_BEST']['POSITION'][11];
            $row['oligohidroamnion'] = $data['Swarm'][$i]['P_BEST']['POSITION'][12];
            $row['jarak_kelahiran'] = $data['Swarm'][$i]['P_BEST']['POSITION'][13];
            $row['power_ibu'] = $data['Swarm'][$i]['P_BEST']['POSITION'][14];
            $row['fitness'] = $data['Swarm'][$i]['P_BEST']['FITNESS'];
            $row['persalinan'] = $data_latih[$i]['persalinan'];
            if($flag == $data['bestFitness']) {
                $row['terpilih'] = "Terpilih";
            } else {
                $row['terpilih'] = "-";
            }
            $record[] = $row;
            $flag ++;
        }

        $this->db->insert_batch('data_latih_optimasi', $record);

        $this->db->trans_commit();

    }

    public function InsertAttributeOptimization($data_optimize)
    {
        $this->db->trans_start();

        $this->db->truncate('attribute_optimize');

        $row = [];
        $record = [];
        foreach ($data_optimize['P_BEST']['POSITION'] as $key => $value) {
            $row['attribute_key'] = $key;
            $row['optimize_value'] = $value;
            $record[] = $row;
        }

        $this->db->insert_batch('attribute_optimize', $record);

        $this->db->trans_commit();
    }

    // Init DataTable Attrobute Optimization

    private function AttributeOptimization()
    {
        $attribute_optimization['table'] = 'attribute_optimize';
        $attribute_optimization['column_search'] = [
            'attribute_key',
            'optimize_value'
        ];
        $attribute_optimization['column_order'] = [
            null,
            null,
            null,
            null
        ];
        $attribute_optimization['order'] = [
            'optimize_value' => 'DESC'
        ];

        return $attribute_optimization;
    }

    public function AttributeOptimize()
    {
        $sql = $this->db->select('*')->from('attribute_optimize')->order_by('optimize_value', 'DESC')->get();
        return $sql->result_array();
    }

    public function AttributeOptimasiDraw()
    {
        $attribute_optimize = $this->AttributeOptimization();
        return $this->getDataTables($attribute_optimize['table'], $attribute_optimize['column_search'], $attribute_optimize['column_order'], $attribute_optimize['order']);
    }

    public function AttributeOptimasiTotal()
    {
        $attribute_optimize = $this->AttributeOptimization();
        return $this->getDataTablesCountAll($attribute_optimize['table'], $attribute_optimize['column_search'], $attribute_optimize['column_order'], $attribute_optimize['order']);
    }

    public function AttributeOptimasiFilter()
    {
        $attribute_optimize = $this->AttributeOptimization();
        return $this->getDataTablesCountFiltered($attribute_optimize['table'], $attribute_optimize['column_search'], $attribute_optimize['column_order'], $attribute_optimize['order']);
    }

    public function getAttributeName($key)
    {
        $sql = $this->db->select('attribute_name')->from('attribute')->where(['id' => $key])->get();
        $data = $sql->row_array();
        return $data['attribute_name'];
    }

    public function getChoiceParticle()
    {
        $sql = $this->db->select('id')->from('data_latih_optimasi')->where(['terpilih' => 'Terpilih'])->get();
        $data = $sql->row_array();
        return @$data['id'];
    }
}
