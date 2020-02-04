<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_dpa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_dpa_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->load->view('m_dpa/m_dpa_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->M_dpa_model->json();
    }

    public function read($id) 
    {
        $row = $this->M_dpa_model->get_by_id($id);
        if ($row) {
            $data = array(
		'kdDPA' => $row->kdDPA,
		'tahun' => $row->tahun,
		'Tanggal' => $row->Tanggal,
		'pa' => $row->pa,
		'panip' => $row->panip,
		'bendahara' => $row->bendahara,
		'bendaharanip' => $row->bendaharanip,
		'ppk' => $row->ppk,
		'ppknip' => $row->ppknip,
	    );
            $this->load->view('m_dpa/m_dpa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_dpa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('m_dpa/create_action'),
	    'kdDPA' => set_value('kdDPA'),
	    'tahun' => set_value('tahun'),
	    'Tanggal' => set_value('Tanggal'),
	    'pa' => set_value('pa'),
	    'panip' => set_value('panip'),
	    'bendahara' => set_value('bendahara'),
	    'bendaharanip' => set_value('bendaharanip'),
	    'ppk' => set_value('ppk'),
	    'ppknip' => set_value('ppknip'),
	);
        $this->load->view('m_dpa/m_dpa_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'tahun' => $this->input->post('tahun',TRUE),
		'Tanggal' => $this->input->post('Tanggal',TRUE),
		'pa' => $this->input->post('pa',TRUE),
		'panip' => $this->input->post('panip',TRUE),
		'bendahara' => $this->input->post('bendahara',TRUE),
		'bendaharanip' => $this->input->post('bendaharanip',TRUE),
		'ppk' => $this->input->post('ppk',TRUE),
		'ppknip' => $this->input->post('ppknip',TRUE),
	    );

            $this->M_dpa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('m_dpa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->M_dpa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('m_dpa/update_action'),
		'kdDPA' => set_value('kdDPA', $row->kdDPA),
		'tahun' => set_value('tahun', $row->tahun),
		'Tanggal' => set_value('Tanggal', $row->Tanggal),
		'pa' => set_value('pa', $row->pa),
		'panip' => set_value('panip', $row->panip),
		'bendahara' => set_value('bendahara', $row->bendahara),
		'bendaharanip' => set_value('bendaharanip', $row->bendaharanip),
		'ppk' => set_value('ppk', $row->ppk),
		'ppknip' => set_value('ppknip', $row->ppknip),
	    );
            $this->load->view('m_dpa/m_dpa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_dpa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdDPA', TRUE));
        } else {
            $data = array(
		'tahun' => $this->input->post('tahun',TRUE),
		'Tanggal' => $this->input->post('Tanggal',TRUE),
		'pa' => $this->input->post('pa',TRUE),
		'panip' => $this->input->post('panip',TRUE),
		'bendahara' => $this->input->post('bendahara',TRUE),
		'bendaharanip' => $this->input->post('bendaharanip',TRUE),
		'ppk' => $this->input->post('ppk',TRUE),
		'ppknip' => $this->input->post('ppknip',TRUE),
	    );

            $this->M_dpa_model->update($this->input->post('kdDPA', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('m_dpa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->M_dpa_model->get_by_id($id);

        if ($row) {
            $this->M_dpa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('m_dpa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('m_dpa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('Tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('pa', 'pa', 'trim|required');
	$this->form_validation->set_rules('panip', 'panip', 'trim|required');
	$this->form_validation->set_rules('bendahara', 'bendahara', 'trim|required');
	$this->form_validation->set_rules('bendaharanip', 'bendaharanip', 'trim|required');
	$this->form_validation->set_rules('ppk', 'ppk', 'trim|required');
	$this->form_validation->set_rules('ppknip', 'ppknip', 'trim|required');

	$this->form_validation->set_rules('kdDPA', 'kdDPA', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "m_dpa.xls";
        $judul = "m_dpa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");
	xlsWriteLabel($tablehead, $kolomhead++, "Pa");
	xlsWriteLabel($tablehead, $kolomhead++, "Panip");
	xlsWriteLabel($tablehead, $kolomhead++, "Bendahara");
	xlsWriteLabel($tablehead, $kolomhead++, "Bendaharanip");
	xlsWriteLabel($tablehead, $kolomhead++, "Ppk");
	xlsWriteLabel($tablehead, $kolomhead++, "Ppknip");

	foreach ($this->M_dpa_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->panip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bendahara);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bendaharanip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ppk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ppknip);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file M_dpa.php */
/* Location: ./application/controllers/M_dpa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-14 22:27:48 */
/* http://harviacode.com */