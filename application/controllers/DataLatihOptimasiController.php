<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');
require_once('PSOController.php');

class DataLatihOptimasiController extends MainController
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('DataLatihOptimasiModel', 'data_latih_optimasi');
        $this->load->model('DataLatihModel', 'data_latih');
        $this->load->model('ConverterModel', 'converter');
        if ($this->session->userdata('role') != 1) {
            redirect('404');
        }
    }

    /**
     * List Semua Data Latih PSO menggunakan ajax
     * @return json
     * 
     */
    public function ajax()
    {
        $data = $this->data_latih_optimasi->DataLatihOptimasiDraw();
        $record = array();
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = array();
            if ($value['terpilih'] == "-") {
                $row[] = $no;
                $row[] = $value['id'];
                $row[] = $value['usia_ibu'];
                $row[] = $value['usia_kehamilan'];
                $row[] = $value['tinggi_badan'];
                $row[] = $value['bsc'];
                $row[] = $value['riwayat_obsteri'];
                $row[] = $value['paritas'];
                $row[] = $value['tekanan_darah'];
                $row[] = $value['letak_sungsang'];
                $row[] = $value['cpd'];
                $row[] = $value['plasenta_previa'];
                $row[] = $value['peb'];
                $row[] = $value['oligohidroamnion'];
                $row[] = $value['jarak_kelahiran'];
                $row[] = $value['power_ibu'];
                $row[] = $value['fitness'];
            } else if ($value['terpilih'] == "Terpilih") {
                $row[] = "<b>" . $no . "</b>";
                $row[] = "<b>" . $value['id'] . "</b>";
                $row[] = "<b>" . $value['usia_ibu'] . "</b>";
                $row[] = "<b>" . $value['usia_kehamilan'] . "</b>";
                $row[] = "<b>" . $value['tinggi_badan'] . "</b>";
                $row[] = "<b>" . $value['bsc'] . "</b>";
                $row[] = "<b>" . $value['riwayat_obsteri'] . "</b>";
                $row[] = "<b>" . $value['paritas'] . "</b>";
                $row[] = "<b>" . $value['tekanan_darah'] . "</b>";
                $row[] = "<b>" . $value['letak_sungsang'] . "</b>";
                $row[] = "<b>" . $value['cpd'] . "</b>";
                $row[] = "<b>" . $value['plasenta_previa'] . "</b>";
                $row[] = "<b>" . $value['peb'] . "</b>";
                $row[] = "<b>" . $value['oligohidroamnion'] . "</b>";
                $row[] = "<b>" . $value['jarak_kelahiran'] . "</b>";
                $row[] = "<b>" . $value['power_ibu'] . "</b>";
                $row[] = "<b>" . $value['fitness'] . "</b>";
            }
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->data_latih_optimasi->DataLatihOptimasiTotal(),
            'recordsFiltered' => $this->data_latih_optimasi->DataLatihOptimasiFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    /**
     * List Semua Attribut yang dipilih PSO
     * @return $html
     * 
     */
    private function attribute_optimize_ajax()
    {
        $data = $this->data_latih_optimasi->AttributeOptimize();
        $record = array();
        $no = 0;
        $flag = 0;
        $html = "";
        foreach ($data as $value) {
            if ($flag < 11) {
                $no++;
                $html .= "<tr>";
                $html .= "<td>" . $no . "</td>";
                $html .= "<td><b>A" . $value['attribute_key'] . "</b></td>";
                $html .= "<td><b>" . $this->data_latih_optimasi->getAttributeName($value['attribute_key']) . "</b></td>";
                $html .= "<td><b>" . $value['optimize_value'] . "</b></td>";
                $html .= "<td>Terpilih</td>";
                $html .= "</tr>";
            } else {
                $no++;
                $html .= "<tr>";
                $html .= "<td>" . $no . "</td>";
                $html .= "<td>A" . $value['attribute_key'] . "</td>";
                $html .= "<td>" . $this->data_latih_optimasi->getAttributeName($value['attribute_key']) . "</td>";
                $html .= "<td>" . $value['optimize_value'] . "</td>";
                $html .= "<td>-</td>";
                $html .= "</tr>";
            }
            $flag++;
        }

        return $html;
    }

    /**
     * Tampilan Index atau awal data latih pso
     * 
     */
    public function index()
    {
        $layout = [
            'data_latih_optimasi/index'
        ];
        $data = [
            'html' => $this->attribute_optimize_ajax(),
            'choiceParticle' => $this->data_latih_optimasi->getChoiceParticle()
        ];
        $this->getLayout($layout, $data);
    }

    /**
     * Tampilan form parameter C1, C2, Iterasi data latih pso
     * 
     */
    public function formOptimization()
    {
        $data = [
            'action' => base_url() . 'data_latih_optimasi/optimizeProcess',
        ];
        $this->load->view('data_latih_optimasi/form_optimasi', $data);
    }

    /**
     * Mapping Data Latih PSO sesuai bobot yang sudah ditentukan
     * @return array
     * 
     */
    public function mappingDataLatihPSO()
    {
        $post = $this->input->post();

        $data = $this->data_latih->getAllDataLatih();

        // Cek Jika Data Kosong maka return 500 untuk menghandle error kosong
        if (empty($data)) {
            return [
                'status' => 500
            ];
        }

        $record = [];
        foreach ($data as $value) {
            $row = array();
            $row[1] = $this->converter->getWeight(1, $value['usia_ibu']);
            $row[2] = $this->converter->getWeight(2, $value['usia_kehamilan']);
            $row[3] = $this->converter->getWeight(3, $value['tinggi_badan']);
            $row[4] = $this->converter->getWeight(4, $value['bsc']);
            $row[5] = $this->converter->getWeight(5, $value['riwayat_obsteri']);
            $row[6] = $this->converter->getWeight(6, $value['paritas']);
            $row[7] = $this->converter->getWeight(7, $value['tekanan_darah']);
            $row[8] = $this->converter->getWeight(8, $value['letak_sungsang']);
            $row[9] = $this->converter->getWeight(9, $value['cpd']);
            $row[10] = $this->converter->getWeight(10, $value['plasenta_previa']);
            $row[11] = $this->converter->getWeight(11, $value['peb']);
            $row[12] = $this->converter->getWeight(12, $value['oligohidroamnion']);
            $row[13] = $this->converter->getWeight(13, $value['jarak_kelahiran']);
            $row[14] = $this->converter->getWeight(14, $value['power_ibu']);
            // $row[15] = $this->data_latih->getWeight(15, $value['persalinan']);
            $record[] = $row;
        }

        $pso = new PSOController($record, $post['c1'], $post['c2'], $post['iteration']);
        $optimize = $pso->generateParticle();

        $this->data_latih_optimasi->insertDataLatihOptimize($optimize);

        $this->data_latih_optimasi->InsertAttributeOptimization($optimize['bestParticle']);

        $attribute = $this->attribute_optimize_ajax();

        return [
            'attribute' => $attribute,
            'bestFitness' => $optimize['bestFitness']
        ];
    }

    /**
     * Proses Optimasi PSO
     * @return json
     * 
     */
    public function optimizeProcess()
    {
        $optimize = $this->mappingDataLatihPSO(); // Mapping Data Latih Dulu

        // Jika var optimize status == 500 maka handle error
        if ($optimize['status'] == 500) {
            $response = [
                'status' => 'failed',
                'messages' => 'Data Latih Masih Kosong ',
            ];
        } else {
            $response = [
                'status' => 'success',
                'messages' => 'Data Berhasil Di Optimasi ',
                'html' => $optimize['attribute'],
                'choice' => $optimize['bestFitness'] + 1
            ];
        }

        echo json_encode($response);
    }
}
