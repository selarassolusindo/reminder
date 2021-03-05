<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class _01_company extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('_01_company_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . '_01_company/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . '_01_company/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . '_01_company/index.html';
            $config['first_url'] = base_url() . '_01_company/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->_01_company_model->total_rows($q);
        $_01_company = $this->_01_company_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            '_01_company_data' => $_01_company,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('_01_company/t01_company_list', $data);
        $data['_view']    = '_01_company/t01_company_list';
        $data['_caption'] = 'Company';
        $this->load->view('_00_dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->_01_company_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idcompany' => $row->idcompany,
		'Nama' => $row->Nama,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('_01_company/t01_company_read', $data);
            $data['_view']    = '_01_company/t01_company_read';
            $data['_caption'] = 'Company';
            $this->load->view('_00_dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_01_company'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('_01_company/create_action'),
	    'idcompany' => set_value('idcompany'),
	    'Nama' => set_value('Nama'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
	);
        // $this->load->view('_01_company/t01_company_form', $data);
        $data['_view']    = '_01_company/t01_company_form';
        $data['_caption'] = 'Company';
        $this->load->view('_00_dashboard/_layout', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'Nama' => $this->input->post('Nama',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->_01_company_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('_01_company'));
        }
    }

    public function update($id)
    {
        $row = $this->_01_company_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('_01_company/update_action'),
		'idcompany' => set_value('idcompany', $row->idcompany),
		'Nama' => set_value('Nama', $row->Nama),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('_01_company/t01_company_form', $data);
            $data['_view']    = '_01_company/t01_company_form';
            $data['_caption'] = 'Company';
            $this->load->view('_00_dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_01_company'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idcompany', TRUE));
        } else {
            $data = array(
		'Nama' => $this->input->post('Nama',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->_01_company_model->update($this->input->post('idcompany', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('_01_company'));
        }
    }

    public function delete($id)
    {
        $row = $this->_01_company_model->get_by_id($id);

        if ($row) {
            $this->_01_company_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('_01_company'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_01_company'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
	// $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	// $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idcompany', 'idcompany', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t01_company.xls";
        $judul = "t01_company";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Created At");
	xlsWriteLabel($tablehead, $kolomhead++, "Updated At");

	foreach ($this->_01_company_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
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
        header("Content-Disposition: attachment;Filename=t01_company.doc");

        $data = array(
            't01_company_data' => $this->_01_company_model->get_all(),
            'start' => 0
        );

        $this->load->view('_01_company/t01_company_doc',$data);
    }

}

/* End of file _01_company.php */
/* Location: ./application/controllers/_01_company.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-04 07:15:21 */
/* http://harviacode.com */
