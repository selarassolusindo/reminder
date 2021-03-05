<?php
defined('BASEPATH') or exit('No direct script access allowed');

class _00_dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['_view']    = 'dashboard';
        $data['_caption'] = 'Dashboard';
        $this->load->view('_00_dashboard/_layout', $data);
    }
}
