<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');
require_once('NaiveBayesController.php');
require_once('DataLatihOptimasiController.php');

class NaiveBayesProcessController extends DataLatihOptimasiController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataUjiModel', 'data_uji');
        $this->load->model('DataLatihModel', 'data_latih');
        $this->load->model('DataLatihOptimasiModel', 'data_latih_optimasi');
        $this->load->model('DataUjiModel', 'data_uji');
        $this->load->model('ConverterModel', 'converter');
        $this->load->model('NaiveBayesModel', 'naivebayes');
        if ($this->session->userdata('role') != 1) {
            redirect('404');
        }
    }

    /**
     * List Semua Attribut Kelas untuk digunakan Naive bayes
     * @return array $classes
     * 
     */
    protected function getClasses()
    {
        $classes = [];

        $classes = [
            'usia_ibu' => [
                'berisiko',
                'tidak berisiko'
            ],

            'usia_kehamilan' => [
                'preterm',
                'aterm',
                'postterm'
            ],

            'tinggi_badan' => [
                '<=145 Cm',
                '> 145 Cm'
            ],

            'bsc' => [
                'ada',
                'tidak ada'
            ],

            'riwayat_obsteri' => [
                'ya',
                'tidak'
            ],

            'paritas' => [
                'multipara',
                'primipara',
                'grandemultipara'
            ],

            'tekanan_darah' => [
                'rendah',
                'normal',
                'tinggi'
            ],

            'letak_sungsang' => [
                'ya',
                'tidak'
            ],

            'cpd' => [
                'ya',
                'tidak'
            ],

            'plasenta_previa' => [
                'ya',
                'tidak'
            ],

            'peb' => [
                'tidak ada',
                'rendah',
                'berat'
            ],

            'oligohidroamnion' => [
                'ya',
                'tidak'
            ],

            'jarak_kelahiran' => [
                '< 2 Tahun',
                '>= 2 Tahun'
            ],

            'power_ibu' => [
                'normal',
                'lemah'
            ]
        ];

        return $classes;
    }

    /**
     * List Semua Hasil Data Uji Yang Diprediksi Naive Bayes
     * @param $optimize = 'optimize' (Opsional jika menggunakan pso wajib optimize)
     * @return json
     */
    public function ajax($optimize = 'optimize')
    {
        $data = $this->naivebayes->DataUjiDraw($optimize);
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
            if ($value['persalinan'] != $value['prediksi_persalinan']) {
                $row[] = "<b>" . $value['prediksi_persalinan'] . "</b>";
            } else {
                $row[] = $value['prediksi_persalinan'];
            }
            $row[] = $value['SC'];
            $row[] = $value['Normal'];
            $record[] = $row;
        }

        $response = [
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->naivebayes->DataUjiTotal($optimize),
            'recordsFiltered' => $this->naivebayes->DataUjiFilter($optimize),
            'data' => $record,
        ];

        echo json_encode($response);
    }

    /**
     * Tampilan Awal NaiveBayes
     * 
     */
    public function index()
    {
        $layout = [
            'data_uji/data_uji_naivebayes'
        ];
        $data = [
            'flag' => $this->naivebayes->checkFalse()
        ];
        $this->getLayout($layout, $data);
    }

    /**
     * Tampilan Untuk Form Optimasi Sebelum Naive Bayes
     * 
     */
    public function form_optimasi()
    {
        $data = [
            'action' => base_url() . 'data_uji_nb/test_data',
        ];
        $this->load->view('data_latih_optimasi/form_optimasi', $data);
    }

    private function mappingAttributeOptimize()
    {
        $attribute = $this->data_latih_optimasi->AttributeOptimize();
        $record = [];
        if (!empty($attribute)) {
            for ($i = 0; $i < 11; $i++) {
                $record[] = $this->data_latih_optimasi->getAttributeName($attribute[$i]['attribute_key']);
            }
            return $record;
        }
    }

    private function mappingAttribute()
    {
        $attribute = $this->data_latih->getAttribute();
        $record = [];
        for ($i = 0; $i < count($attribute); $i++) {
            $record[] = $attribute[$i]['attribute_name'];
        }
        return $record;
    }

    private function mappingDataOptimize()
    {
        $data_latih = $this->data_latih->getAllDataLatih();

        if (empty($data_latih)) {
            return [
                'status' => 500,
                'message' => 'Data Latih Masih Kosong'
            ];
        }

        $attribute_optimize = $this->mappingAttributeOptimize();

        if (empty($attribute_optimize)) {
            return [
                'status' => 500,
                'message' => 'Data Latih Belum Di Latih Dengan PSO'
            ];
        }

        // $this->maintence->Debug($attribute_optimize);
        $record_latih = [];
        foreach ($data_latih as $value) {
            $row = [];
            foreach ($attribute_optimize as $attribute => $attributes) {
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
                    $row[] = $value[$attributes];
                } else {
                    $row[] = $this->converter->getNumberConvert($id, $value[$attributes]);
                }
            }
            $row[] = $value['persalinan'];
            $record_latih[] = $row;
        }

        return $record_latih;
    }

    private function mappingData()
    {
        $data_latih = $this->data_latih->getAllDataLatih();

        if (empty($data_latih)) {
            return [
                'status' => 500
            ];
        }

        $attribute_ = $this->mappingAttribute();
        // $this->maintence->Debug($attribute_optimize);
        $record_latih = [];
        foreach ($data_latih as $value) {
            $row = [];
            foreach ($attribute_ as $attribute => $attributes) {
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
                    $row[] = $value[$attributes];
                } else {
                    $row[] = $this->converter->getNumberConvert($id, $value[$attributes]);
                }
            }
            $row[] = $value['persalinan'];
            $record_latih[] = $row;
        }

        return $record_latih;
    }

    public function storeDataUji()
    {
        // Mapping Attribute
        $attribute_optimize = $this->mappingAttributeOptimize();
        $record_optimize = $this->mappingDataOptimize();

        // Mapping Data Non Optimasi
        $attribute = $this->mappingAttribute();
        $record = $this->mappingData();
        
        if (@$record_optimize['status'] == 500 || @$record['status'] == 500) {

            if(!empty($record_optimize['message'])) {
                $msg = $record_optimize['message'];
            } else {
                $msg = 'Data Latih Masih Kosong';
            }

            $response =  [
                'status' => 'failed',
                'messages' => $msg
            ];
        } else {

            $nb_non_optimize = new NaiveBayesController($record, $attribute, $this->getClasses());
            $nb_optimize = new NaiveBayesController($record_optimize, $attribute_optimize, $this->getClasses());

            $insert_non_optimize = $this->naivebayes->insertDataUjiNB($nb_non_optimize->run(), $attribute, 'nonoptimize');

            if ($insert_non_optimize['status'] == 'success') {

                $insert_optimize = $this->naivebayes->insertDataUjiNB($nb_optimize->run(), $attribute_optimize);

                $notif_non_optimize = $insert_non_optimize['notif'];

                if ($insert_optimize['status'] == 'success') {

                    $notif_optimize = $insert_optimize['notif'];

                    $flag = $this->naivebayes->checkFalse();

                    $response = [
                        'status' => 'success',
                        'messages' => 'Data Sukses Ditambah',
                        'prediction' => $insert_non_optimize['prediction'],
                        'flag' => $flag,
                        'notif' => $notif_non_optimize . '<br/>' . $notif_optimize
                    ];
                } else if ($insert_optimize['status'] == 'notvalid') {
                    $response = [
                        'status' => 'notvalid',
                        'messages' => $insert_optimize['messages']
                    ];
                }
            } else if ($insert_non_optimize['status'] == 'notvalid') {
                $response = [
                    'status' => 'notvalid',
                    'messages' => $insert_non_optimize['messages']
                ];
            }
        }

        echo json_encode($response);
    }

    public function TestData()
    {
        // Mapping Data Optimize Di Latih Dulu Pakai PSO
        $optimize = $this->mappingDataLatihPSO();
        $attribute_optimize = $this->mappingAttributeOptimize();
        $record_optimize = $this->mappingDataOptimize();

        // Mapping Data Non Optimasi
        $attribute = $this->mappingAttribute();
        $record = $this->mappingData();

        if (!empty($record_optimize['status']) || !empty($record['status'])) {

            if ($record_optimize['status'] == 500 || $record['status'] == 500) {

                if(!empty($record_optimize['message'])) {
                    $msg = $record_optimize['message'];
                } else {
                    $msg = 'Data Latih Masih Kosong';
                }
    
                $response =  [
                    'status' => 'failed',
                    'messages' => $msg
                ];
            }
        } else {

            $nb_non_optimize = new NaiveBayesController($record, $attribute, $this->getClasses());
            $ins_no = $this->naivebayes->insertNaiveBayes($nb_non_optimize->run(), $attribute, 'nonoptimize');

            $nb_optimize = new NaiveBayesController($record_optimize, $attribute_optimize, $this->getClasses());
            $ins_o = $this->naivebayes->insertNaiveBayes($nb_optimize->run(), $attribute_optimize);

            if (!empty($ins_no['status']) || !empty($ins_o['status'])) {

                if ($ins_no['status'] == 500 || $ins_o['status'] == 500) {
                    $response = [
                        'status' => 'failed',
                        'messages' => 'Data Uji Masih Kosong',
                    ];
                }
            } else {

                $flag = $this->naivebayes->checkFalse();

                $response = [
                    'status' => 'success',
                    'messages' => 'Data Sukses Di Uji',
                    'particleChoice' => $optimize['bestFitness'],
                    'flag' => $flag
                ];
            }
        }

        echo json_encode($response);
    }
}
