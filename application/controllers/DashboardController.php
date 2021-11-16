<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('MainController.php');

class DashboardController extends MainController
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model('DataUjiModel', 'ms_data_uji');
        $this->load->model('DataLatihModel', 'ms_data_latih');
        if ($this->session->userdata('role') != 1) {
            redirect('404');
        }
    }

    public function index()
    {
        $data['total_data_latih'] = $this->ms_data_latih->getTotal();
        $data['total_data_uji'] = $this->ms_data_uji->getTotal();

        $layout = array(
            'dashboard/dashboard'
        );
        $this->getLayout($layout, $data);
    }
}
