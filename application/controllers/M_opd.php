<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_opd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_opd_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('m_opd/m_opd_list');
        $this->template->load('template','m_opd/m_opd_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->M_opd_model->json();
    }

    public function read($id) 
    {
        $row = $this->M_opd_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kdOPD' => $row->kdOPD,
		'nmOPD' => $row->nmOPD,
		'Alamat' => $row->Alamat,
		'Telpon' => $row->Telpon,
	    );
            $this->load->view('m_opd/m_opd_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_opd'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_opd/create_action'),
	    'kdOPD' => set_value('kdOPD'),
	    'nmOPD' => set_value('nmOPD'),
	    'Alamat' => set_value('Alamat'),
	    'Telpon' => set_value('Telpon'),
	);
        $this->load->view('m_opd/m_opd_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nmOPD' => $this->input->post('nmOPD',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Telpon' => $this->input->post('Telpon',TRUE),
	    );

            $this->M_opd_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('m_opd'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_opd_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_opd/update_action'),
		'kdOPD' => set_value('kdOPD', $row->kdOPD),
		'nmOPD' => set_value('nmOPD', $row->nmOPD),
		'Alamat' => set_value('Alamat', $row->Alamat),
		'Telpon' => set_value('Telpon', $row->Telpon),
	    );
            $this->load->view('m_opd/m_opd_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_opd'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdOPD', TRUE));
        } else {
            $data = array(
		'nmOPD' => $this->input->post('nmOPD',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Telpon' => $this->input->post('Telpon',TRUE),
	    );

            $this->M_opd_model->update($this->input->post('kdOPD', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_opd'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_opd_model->get_by_id($id);

        if ($row) {
            $this->M_opd_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_opd'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_opd'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nmOPD', 'nmopd', 'trim|required');
	$this->form_validation->set_rules('Alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('Telpon', 'telpon', 'trim|required');

	$this->form_validation->set_rules('kdOPD', 'kdOPD', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "m_opd.xls";
        $judul = "m_opd";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NmOPD");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Telpon");

	foreach ($this->M_opd_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmOPD);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Telpon);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=m_opd.doc");

        $data = array(
            'm_opd_data' => $this->M_opd_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('m_opd/m_opd_doc',$data);
    }

}

/* End of file M_opd.php */
/* Location: ./application/controllers/M_opd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-15 03:06:26 */
/* http://harviacode.com */