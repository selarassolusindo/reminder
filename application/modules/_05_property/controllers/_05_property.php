<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class _05_property extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('_05_property_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . '_05_property/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . '_05_property/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . '_05_property/index.html';
            $config['first_url'] = base_url() . '_05_property/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->_05_property_model->total_rows($q);
        $_05_property = $this->_05_property_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            '_05_property_data' => $_05_property,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('_05_property/t05_property_list', $data);
        $data['_view']    = '_05_property/t05_property_list';
        $data['_caption'] = 'Property';
        $this->load->view('_00_dashboard/_layout', $data);
    }

    public function read($id)
    {
        $row = $this->_05_property_model->get_by_id($id);
        if ($row) {
            $data = array(
		'idproperty' => $row->idproperty,
		'Nama' => $row->Nama,
		// 'created_at' => $row->created_at,
		// 'updated_at' => $row->updated_at,
	    );
            // $this->load->view('_05_property/t05_property_read', $data);
            $data['_view']    = '_05_property/t05_property_read';
            $data['_caption'] = 'Property';
            $this->load->view('_00_dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_05_property'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('_05_property/create_action'),
	    'idproperty' => set_value('idproperty'),
	    'Nama' => set_value('Nama'),
	    // 'created_at' => set_value('created_at'),
	    // 'updated_at' => set_value('updated_at'),
	);
        // $this->load->view('_05_property/t05_property_form', $data);
        $data['_view']    = '_05_property/t05_property_form';
        $data['_caption'] = 'Property';
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

            $this->_05_property_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('_05_property'));
        }
    }

    public function update($id)
    {
        $row = $this->_05_property_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('_05_property/update_action'),
		'idproperty' => set_value('idproperty', $row->idproperty),
		'Nama' => set_value('Nama', $row->Nama),
		// 'created_at' => set_value('created_at', $row->created_at),
		// 'updated_at' => set_value('updated_at', $row->updated_at),
	    );
            // $this->load->view('_05_property/t05_property_form', $data);
            $data['_view']    = '_05_property/t05_property_form';
            $data['_caption'] = 'Property';
            $this->load->view('_00_dashboard/_layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_05_property'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('idproperty', TRUE));
        } else {
            $data = array(
		'Nama' => $this->input->post('Nama',TRUE),
		// 'created_at' => $this->input->post('created_at',TRUE),
		// 'updated_at' => $this->input->post('updated_at',TRUE),
	    );

            $this->_05_property_model->update($this->input->post('idproperty', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('_05_property'));
        }
    }

    public function delete($id)
    {
        $row = $this->_05_property_model->get_by_id($id);

        if ($row) {
            $this->_05_property_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('_05_property'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('_05_property'));
        }
    }

    public function _rules()
    {
	$this->form_validation->set_rules('Nama', 'nama', 'trim|required');
	// $this->form_validation->set_rules('created_at', 'created at', 'trim|required');
	// $this->form_validation->set_rules('updated_at', 'updated at', 'trim|required');

	$this->form_validation->set_rules('idproperty', 'idproperty', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "t05_property.xls";
        $judul = "t05_property";
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

	foreach ($this->_05_property_model->get_all() as $data) {
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
        header("Content-Disposition: attachment;Filename=t05_property.doc");

        $data = array(
            't05_property_data' => $this->_05_property_model->get_all(),
            'start' => 0
        );

        $this->load->view('_05_property/t05_property_doc',$data);
    }

}

/* End of file _05_property.php */
/* Location: ./application/controllers/_05_property.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-03-04 07:15:33 */
/* http://harviacode.com */
