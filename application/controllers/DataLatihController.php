<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');
require_once('PSOController.php');

class DataLatihController extends MainController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataLatihModel', 'data_latih');
        if ($this->session->userdata('role') != 1) {
          redirect('404');
        }
    }

    /**
     * List Semua Data Latih menggunakan ajax
     * @return json
     * 
     */
    public function ajax()
    {
        $data = $this->data_latih->DataLatihDraw(); // Ambil Data Dari Model DataLatihModel
        $record = array();
        $no = $_POST['start'];
        foreach ($data as $value) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $value['nama_pasien'];
            $row[] = $value['alamat_pasien'];
            $row[] = $value['anak_ke'];
            $row[] = $value['tanggal_persalinan'];
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
            $row[] = $value['persalinan'];
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->data_latih->DataLatihTotal(),
            'recordsFiltered' => $this->data_latih->DataLatihFilter(),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    /**
     * Tampilan Index Untuk Data Latih
     */
    public function index()
    {
        $layout = [
            'data_latih/index'
        ];
        $this->getLayout($layout);
    }

    /**
     * Tampilan Form Untuk Import Excel
     * 
     */
    public function formImport()
    {
        $data = [
            'action' => base_url() . 'data_latih/import_excel',
        ];
        return $this->load->view('data_latih/form_import', $data);
    }

    /**
     * Proses Import Excel
     * @return json
     */
    public function importExcel()
    {
        $data = $this->import_excel($_FILES['upload']);
        if ($data['status'] == 500) {
            $response = [
                'status' => 500,
                'messages' => $data['messages']
            ];
        } else if ($data['status'] == 200) {

            $import_excel = $this->data_latih->importExcel($data['data']);
            // $this->maintence->Debug($data['data']);
            $response = [
                'status' => 200,
                'messages' => 'Data Sukses Di Import'
            ];
        }

        echo json_encode($response);
    }
    
}
