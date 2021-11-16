<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('AuthModel');
    }

    public function index()
    {

        if ($this->session->userdata('logged')) {
            redirect('/');
        }
        $this->load->view('_partial/header');
        $this->load->view('auth/login');
    }

    public function login_ajax()
    {

        if ($this->session->userdata('logged')) {
            redirect('/');
        }

        $post = $this->input->post();
        $action = $this->AuthModel->authValidation();
        if ($action['status'] == 'failed') {
            $response = array(
                'status' => 'notvalid',
                'messages' => validation_errors()
            );
        } else if ($action['status'] == 'success') {
            $check = $this->AuthModel->authCheck($post['username']);
            if ($check) {
                if (md5($post['password']) == $check['password']) {
                    $this->AuthModel->updateLogin($check['id'], 1, date("D M j G:i:s T Y"));
                    $session = array(
                        'logged' => TRUE,
                        'username' => $check['id'],
                        'role' => $check['role_id'],
                        'name' => $check['nama_user'],
                        'last_login' => $check['last_login']
                    );
                    $this->session->set_userdata($session);
                    $response = array(
                        'status' => 'success',
                        'messages' => 'Login Sukses Anda Akan Diarahkan Dalam 5 Detik'
                    );
                } else if (md5($post['password']) != $check['password']) {
                    $response = array(
                        'status' => 'failed',
                        'messages' => 'Login Gagal Password Tidak Cocok'
                    );
                }
            } else {
                $response = array(
                    'status' => 'failed',
                    'messages' => 'Login Gagal Username Tidak Ada'
                );
            }
        }
        echo json_encode($response);
    }

    public function logout()
    {

        $id = $this->session->userdata('username');
        $update = $this->AuthModel->updateLogin($id, "0", date("D M j G:i:s T Y"));
        if ($update['status'] == 'success') {
            $this->session->set_userdata(array());
            $this->session->sess_destroy();
            $response = array(
                'status' => 'success',
                'messages' => 'Anda Sudah Keluar '
            );
        } else if ($update['status'] == 'failed') {
            $response = array(
                'status' => 'failed',
                'messages' => 'Gagal Keluar  '
            );
        }
        echo json_encode($response);
    }

    public function store()
    {
        $action = $this->AuthModel->storeAction();
        if ($action['status'] == 'success') {
            $response = array(
                'status' => 'success',
                'messages' => 'Data Sukses Tersimpan'
            );
        } else if ($action['status'] == 'failed') {
            $response = array(
                'status' => 'failed',
                'messages' => 'Data Gagal Tersimpan'
            );
        } else if ($action['status'] == 'notvalid') {
            $response = array(
                'status' => 'notvalid',
                'messages' => validation_errors()
            );
        }
        echo json_encode($response);
    }
}
