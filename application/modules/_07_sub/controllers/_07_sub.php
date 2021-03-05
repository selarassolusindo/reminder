<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class _07_sub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('_07_sub_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '_07_sub/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . '_07_sub/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . '_07_sub/index.html';
            $config['first_url'] = base_url() . '_07_sub/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->_07_sub_model->total_rows($q);
        $_07_sub = $this->_07_sub_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            '_07_sub_data' => $_07_sub,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('_07_sub/t07_sub_list', $data);
    }

    public function read($id) 
    {
        $row = $this->_07_sub_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idsub' => $row->idsub,
		'idmain' => $row->idmain,
		'Kode' => $row->Kode,
		'Nama' => $row->Nama,
		'created_at' => $row->created_at,
		'updated_at' => $row->updated_at,
	    );
            $this->load->view('_07_sub/t07_sub_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_07_sub'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('_07_sub/create_action'),
	    'idsub' => set_value('idsub'),
	    'idmain' => set_value('idmain'),
	    'Kode' => set_value('Kode'),
	    'Nama' => set_value('Nama'),
	    'created_at' => set_value('created_at'),
	    'updated_at' => set_value('updated_at'),
	);
        $this->load->view('_07_sub/t07_sub_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'idmain' => $this->input->post('idmain',TRUE),
		'Kode' => $this->input->post('Kode',TRUE),
		'Nama' => $this->input->post('Nama',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->_07_sub_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('_07_sub'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->_07_sub_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('_07_sub/update_action'),
		'idsub' => set_value('idsub', $row->idsub),
		'idmain' => set_value('idmain', $row->idmain),
		'Kode' => set_value('Kode', $row->Kode),
		'Nama' => set_value('Nama', $row->Nama),
		'created_at' => set_value('created_at', $row->created_at),
		'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            $this->load->view('_07_sub/t07_sub_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_07_sub'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idsub', TRUE));
        } else {
            $data = array(
		'idmain' => $this->input->post('idmain',TRUE),
		'Kode' => $this->input->post('Kode',TRUE),
		'Nama' => $this->input->post('Nama',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
		'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->_07_sub_model->update($this->input->post('idsub', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('_07_sub'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->_07_sub_model->get_by_id($id);

        if ($row) {
            $this->_07_sub_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('_07_sub'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_07_sub'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('idmain', 'idmain', 'trim|required');
	$this->form_validation->set_rules('Kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	$this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idsub', 'idsub', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t07_sub.xls";
        $judul = "t07_sub";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Idmain");
	xlsWriteLabel($tablehead, $kolomhead++, "Kode");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->_07_sub_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->idmain);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->created_at);
	    xlsWriteLabel($tablebody, $kolombody++, $data->updated_at);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=t07_sub.doc");

        $data = array(
            't07_sub_data' => $this->_07_sub_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('_07_sub/t07_sub_doc',$data);
    }

}

/* End of file _07_sub.php */
/* Location: ./application/controllers/_07_sub.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-04 10:07:06 */
/* http://harviacode.com */