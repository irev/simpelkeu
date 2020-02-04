<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simda_test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Simda_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('simda_test/simda_list');
        $this->template->load('template','simda_test/simda_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Simda_model->json();
    }

    public function read($id) 
    {
        $row = $this->Simda_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'simda',
		'id' => $row->id,
		'COL1' => $row->COL1,
		'COL2' => $row->COL2,
		'COL3' => $row->COL3,
		'COL4' => $row->COL4,
		'COL5' => $row->COL5,
		'COL6' => $row->COL6,
		'COL7' => $row->COL7,
		'COL8' => $row->COL8,
		'COL9' => $row->COL9,
		'COL10' => $row->COL10,
		'COL11' => $row->COL11,
		'COL12' => $row->COL12,
		'COL13' => $row->COL13,
		'COL14' => $row->COL14,
		'COL15' => $row->COL15,
		'COL16' => $row->COL16,
		'COL17' => $row->COL17,
		'COL18' => $row->COL18,
		'COL19' => $row->COL19,
		'COL20' => $row->COL20,
		'COL21' => $row->COL21,
		'COL22' => $row->COL22,
		'COL23' => $row->COL23,
		'COL24' => $row->COL24,
		'COL25' => $row->COL25,
		'COL26' => $row->COL26,
		'COL27' => $row->COL27,
		'COL28' => $row->COL28,
		'COL29' => $row->COL29,
		'COL30' => $row->COL30,
		'COL31' => $row->COL31,
		'COL32' => $row->COL32,
		'COL33' => $row->COL33,
		'COL34' => $row->COL34,
		'COL35' => $row->COL35,
		'COL36' => $row->COL36,
		'COL37' => $row->COL37,
		'COL38' => $row->COL38,
		'COL39' => $row->COL39,
		'COL40' => $row->COL40,
		'tglDPA' => $row->tglDPA,
		'noDPA' => $row->noDPA,
	    );
            $this->load->view('simda_test/simda_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simda_test'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'simda',
            'button' => 'Create',
            'action' => site_url('simda_test/create_action'),
	    'id' => set_value('id'),
	    'COL1' => set_value('COL1'),
	    'COL2' => set_value('COL2'),
	    'COL3' => set_value('COL3'),
	    'COL4' => set_value('COL4'),
	    'COL5' => set_value('COL5'),
	    'COL6' => set_value('COL6'),
	    'COL7' => set_value('COL7'),
	    'COL8' => set_value('COL8'),
	    'COL9' => set_value('COL9'),
	    'COL10' => set_value('COL10'),
	    'COL11' => set_value('COL11'),
	    'COL12' => set_value('COL12'),
	    'COL13' => set_value('COL13'),
	    'COL14' => set_value('COL14'),
	    'COL15' => set_value('COL15'),
	    'COL16' => set_value('COL16'),
	    'COL17' => set_value('COL17'),
	    'COL18' => set_value('COL18'),
	    'COL19' => set_value('COL19'),
	    'COL20' => set_value('COL20'),
	    'COL21' => set_value('COL21'),
	    'COL22' => set_value('COL22'),
	    'COL23' => set_value('COL23'),
	    'COL24' => set_value('COL24'),
	    'COL25' => set_value('COL25'),
	    'COL26' => set_value('COL26'),
	    'COL27' => set_value('COL27'),
	    'COL28' => set_value('COL28'),
	    'COL29' => set_value('COL29'),
	    'COL30' => set_value('COL30'),
	    'COL31' => set_value('COL31'),
	    'COL32' => set_value('COL32'),
	    'COL33' => set_value('COL33'),
	    'COL34' => set_value('COL34'),
	    'COL35' => set_value('COL35'),
	    'COL36' => set_value('COL36'),
	    'COL37' => set_value('COL37'),
	    'COL38' => set_value('COL38'),
	    'COL39' => set_value('COL39'),
	    'COL40' => set_value('COL40'),
	    'tglDPA' => set_value('tglDPA'),
	    'noDPA' => set_value('noDPA'),
	);
        //$this->load->view('simda_test/simda_form', $data);
        $this->_render_page('simda_test/simda_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'COL1' => $this->input->post('COL1',TRUE),
		'COL2' => $this->input->post('COL2',TRUE),
		'COL3' => $this->input->post('COL3',TRUE),
		'COL4' => $this->input->post('COL4',TRUE),
		'COL5' => $this->input->post('COL5',TRUE),
		'COL6' => $this->input->post('COL6',TRUE),
		'COL7' => $this->input->post('COL7',TRUE),
		'COL8' => $this->input->post('COL8',TRUE),
		'COL9' => $this->input->post('COL9',TRUE),
		'COL10' => $this->input->post('COL10',TRUE),
		'COL11' => $this->input->post('COL11',TRUE),
		'COL12' => $this->input->post('COL12',TRUE),
		'COL13' => $this->input->post('COL13',TRUE),
		'COL14' => $this->input->post('COL14',TRUE),
		'COL15' => $this->input->post('COL15',TRUE),
		'COL16' => $this->input->post('COL16',TRUE),
		'COL17' => $this->input->post('COL17',TRUE),
		'COL18' => $this->input->post('COL18',TRUE),
		'COL19' => $this->input->post('COL19',TRUE),
		'COL20' => $this->input->post('COL20',TRUE),
		'COL21' => $this->input->post('COL21',TRUE),
		'COL22' => $this->input->post('COL22',TRUE),
		'COL23' => $this->input->post('COL23',TRUE),
		'COL24' => $this->input->post('COL24',TRUE),
		'COL25' => $this->input->post('COL25',TRUE),
		'COL26' => $this->input->post('COL26',TRUE),
		'COL27' => $this->input->post('COL27',TRUE),
		'COL28' => $this->input->post('COL28',TRUE),
		'COL29' => $this->input->post('COL29',TRUE),
		'COL30' => $this->input->post('COL30',TRUE),
		'COL31' => $this->input->post('COL31',TRUE),
		'COL32' => $this->input->post('COL32',TRUE),
		'COL33' => $this->input->post('COL33',TRUE),
		'COL34' => $this->input->post('COL34',TRUE),
		'COL35' => $this->input->post('COL35',TRUE),
		'COL36' => $this->input->post('COL36',TRUE),
		'COL37' => $this->input->post('COL37',TRUE),
		'COL38' => $this->input->post('COL38',TRUE),
		'COL39' => $this->input->post('COL39',TRUE),
		'COL40' => $this->input->post('COL40',TRUE),
		'tglDPA' => $this->input->post('tglDPA',TRUE),
		'noDPA' => $this->input->post('noDPA',TRUE),
	    );

            $this->Simda_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('simda_test'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Simda_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'simda',
                'button' => 'Update',
                'action' => site_url('simda_test/update_action'),
		'id' => set_value('id', $row->id),
		'COL1' => set_value('COL1', $row->COL1),
		'COL2' => set_value('COL2', $row->COL2),
		'COL3' => set_value('COL3', $row->COL3),
		'COL4' => set_value('COL4', $row->COL4),
		'COL5' => set_value('COL5', $row->COL5),
		'COL6' => set_value('COL6', $row->COL6),
		'COL7' => set_value('COL7', $row->COL7),
		'COL8' => set_value('COL8', $row->COL8),
		'COL9' => set_value('COL9', $row->COL9),
		'COL10' => set_value('COL10', $row->COL10),
		'COL11' => set_value('COL11', $row->COL11),
		'COL12' => set_value('COL12', $row->COL12),
		'COL13' => set_value('COL13', $row->COL13),
		'COL14' => set_value('COL14', $row->COL14),
		'COL15' => set_value('COL15', $row->COL15),
		'COL16' => set_value('COL16', $row->COL16),
		'COL17' => set_value('COL17', $row->COL17),
		'COL18' => set_value('COL18', $row->COL18),
		'COL19' => set_value('COL19', $row->COL19),
		'COL20' => set_value('COL20', $row->COL20),
		'COL21' => set_value('COL21', $row->COL21),
		'COL22' => set_value('COL22', $row->COL22),
		'COL23' => set_value('COL23', $row->COL23),
		'COL24' => set_value('COL24', $row->COL24),
		'COL25' => set_value('COL25', $row->COL25),
		'COL26' => set_value('COL26', $row->COL26),
		'COL27' => set_value('COL27', $row->COL27),
		'COL28' => set_value('COL28', $row->COL28),
		'COL29' => set_value('COL29', $row->COL29),
		'COL30' => set_value('COL30', $row->COL30),
		'COL31' => set_value('COL31', $row->COL31),
		'COL32' => set_value('COL32', $row->COL32),
		'COL33' => set_value('COL33', $row->COL33),
		'COL34' => set_value('COL34', $row->COL34),
		'COL35' => set_value('COL35', $row->COL35),
		'COL36' => set_value('COL36', $row->COL36),
		'COL37' => set_value('COL37', $row->COL37),
		'COL38' => set_value('COL38', $row->COL38),
		'COL39' => set_value('COL39', $row->COL39),
		'COL40' => set_value('COL40', $row->COL40),
		'tglDPA' => set_value('tglDPA', $row->tglDPA),
		'noDPA' => set_value('noDPA', $row->noDPA),
	    );
            $this->_render_page('simda_test/simda_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simda_test'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'COL1' => $this->input->post('COL1',TRUE),
		'COL2' => $this->input->post('COL2',TRUE),
		'COL3' => $this->input->post('COL3',TRUE),
		'COL4' => $this->input->post('COL4',TRUE),
		'COL5' => $this->input->post('COL5',TRUE),
		'COL6' => $this->input->post('COL6',TRUE),
		'COL7' => $this->input->post('COL7',TRUE),
		'COL8' => $this->input->post('COL8',TRUE),
		'COL9' => $this->input->post('COL9',TRUE),
		'COL10' => $this->input->post('COL10',TRUE),
		'COL11' => $this->input->post('COL11',TRUE),
		'COL12' => $this->input->post('COL12',TRUE),
		'COL13' => $this->input->post('COL13',TRUE),
		'COL14' => $this->input->post('COL14',TRUE),
		'COL15' => $this->input->post('COL15',TRUE),
		'COL16' => $this->input->post('COL16',TRUE),
		'COL17' => $this->input->post('COL17',TRUE),
		'COL18' => $this->input->post('COL18',TRUE),
		'COL19' => $this->input->post('COL19',TRUE),
		'COL20' => $this->input->post('COL20',TRUE),
		'COL21' => $this->input->post('COL21',TRUE),
		'COL22' => $this->input->post('COL22',TRUE),
		'COL23' => $this->input->post('COL23',TRUE),
		'COL24' => $this->input->post('COL24',TRUE),
		'COL25' => $this->input->post('COL25',TRUE),
		'COL26' => $this->input->post('COL26',TRUE),
		'COL27' => $this->input->post('COL27',TRUE),
		'COL28' => $this->input->post('COL28',TRUE),
		'COL29' => $this->input->post('COL29',TRUE),
		'COL30' => $this->input->post('COL30',TRUE),
		'COL31' => $this->input->post('COL31',TRUE),
		'COL32' => $this->input->post('COL32',TRUE),
		'COL33' => $this->input->post('COL33',TRUE),
		'COL34' => $this->input->post('COL34',TRUE),
		'COL35' => $this->input->post('COL35',TRUE),
		'COL36' => $this->input->post('COL36',TRUE),
		'COL37' => $this->input->post('COL37',TRUE),
		'COL38' => $this->input->post('COL38',TRUE),
		'COL39' => $this->input->post('COL39',TRUE),
		'COL40' => $this->input->post('COL40',TRUE),
		'tglDPA' => $this->input->post('tglDPA',TRUE),
		'noDPA' => $this->input->post('noDPA',TRUE),
	    );

            $this->Simda_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('simda_test'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Simda_model->get_by_id($id);

        if ($row) {
            $this->Simda_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('simda_test'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('simda_test'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('COL1', 'col1', 'trim|required');
	$this->form_validation->set_rules('COL2', 'col2', 'trim|required');
	$this->form_validation->set_rules('COL3', 'col3', 'trim|required');
	$this->form_validation->set_rules('COL4', 'col4', 'trim|required');
	$this->form_validation->set_rules('COL5', 'col5', 'trim|required');
	$this->form_validation->set_rules('COL6', 'col6', 'trim|required');
	$this->form_validation->set_rules('COL7', 'col7', 'trim|required');
	$this->form_validation->set_rules('COL8', 'col8', 'trim|required');
	$this->form_validation->set_rules('COL9', 'col9', 'trim|required');
	$this->form_validation->set_rules('COL10', 'col10', 'trim|required');
	$this->form_validation->set_rules('COL11', 'col11', 'trim|required');
	$this->form_validation->set_rules('COL12', 'col12', 'trim|required');
	$this->form_validation->set_rules('COL13', 'col13', 'trim|required');
	$this->form_validation->set_rules('COL14', 'col14', 'trim|required');
	$this->form_validation->set_rules('COL15', 'col15', 'trim|required');
	$this->form_validation->set_rules('COL16', 'col16', 'trim|required');
	$this->form_validation->set_rules('COL17', 'col17', 'trim|required');
	$this->form_validation->set_rules('COL18', 'col18', 'trim|required');
	$this->form_validation->set_rules('COL19', 'col19', 'trim|required');
	$this->form_validation->set_rules('COL20', 'col20', 'trim|required');
	$this->form_validation->set_rules('COL21', 'col21', 'trim|required');
	$this->form_validation->set_rules('COL22', 'col22', 'trim|required');
	$this->form_validation->set_rules('COL23', 'col23', 'trim|required');
	$this->form_validation->set_rules('COL24', 'col24', 'trim|required');
	$this->form_validation->set_rules('COL25', 'col25', 'trim|required');
	$this->form_validation->set_rules('COL26', 'col26', 'trim|required');
	$this->form_validation->set_rules('COL27', 'col27', 'trim|required');
	$this->form_validation->set_rules('COL28', 'col28', 'trim|required');
	$this->form_validation->set_rules('COL29', 'col29', 'trim|required');
	$this->form_validation->set_rules('COL30', 'col30', 'trim|required');
	$this->form_validation->set_rules('COL31', 'col31', 'trim|required');
	$this->form_validation->set_rules('COL32', 'col32', 'trim|required');
	$this->form_validation->set_rules('COL33', 'col33', 'trim|required');
	$this->form_validation->set_rules('COL34', 'col34', 'trim|required');
	$this->form_validation->set_rules('COL35', 'col35', 'trim|required');
	$this->form_validation->set_rules('COL36', 'col36', 'trim|required');
	$this->form_validation->set_rules('COL37', 'col37', 'trim|required');
	$this->form_validation->set_rules('COL38', 'col38', 'trim|required');
	$this->form_validation->set_rules('COL39', 'col39', 'trim|required');
	$this->form_validation->set_rules('COL40', 'col40', 'trim|required');
	$this->form_validation->set_rules('tglDPA', 'tgldpa', 'trim|required');
	$this->form_validation->set_rules('noDPA', 'nodpa', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "simda.xls";
        $judul = "simda";
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
	xlsWriteLabel($tablehead, $kolomhead++, "COL1");
	xlsWriteLabel($tablehead, $kolomhead++, "COL2");
	xlsWriteLabel($tablehead, $kolomhead++, "COL3");
	xlsWriteLabel($tablehead, $kolomhead++, "COL4");
	xlsWriteLabel($tablehead, $kolomhead++, "COL5");
	xlsWriteLabel($tablehead, $kolomhead++, "COL6");
	xlsWriteLabel($tablehead, $kolomhead++, "COL7");
	xlsWriteLabel($tablehead, $kolomhead++, "COL8");
	xlsWriteLabel($tablehead, $kolomhead++, "COL9");
	xlsWriteLabel($tablehead, $kolomhead++, "COL10");
	xlsWriteLabel($tablehead, $kolomhead++, "COL11");
	xlsWriteLabel($tablehead, $kolomhead++, "COL12");
	xlsWriteLabel($tablehead, $kolomhead++, "COL13");
	xlsWriteLabel($tablehead, $kolomhead++, "COL14");
	xlsWriteLabel($tablehead, $kolomhead++, "COL15");
	xlsWriteLabel($tablehead, $kolomhead++, "COL16");
	xlsWriteLabel($tablehead, $kolomhead++, "COL17");
	xlsWriteLabel($tablehead, $kolomhead++, "COL18");
	xlsWriteLabel($tablehead, $kolomhead++, "COL19");
	xlsWriteLabel($tablehead, $kolomhead++, "COL20");
	xlsWriteLabel($tablehead, $kolomhead++, "COL21");
	xlsWriteLabel($tablehead, $kolomhead++, "COL22");
	xlsWriteLabel($tablehead, $kolomhead++, "COL23");
	xlsWriteLabel($tablehead, $kolomhead++, "COL24");
	xlsWriteLabel($tablehead, $kolomhead++, "COL25");
	xlsWriteLabel($tablehead, $kolomhead++, "COL26");
	xlsWriteLabel($tablehead, $kolomhead++, "COL27");
	xlsWriteLabel($tablehead, $kolomhead++, "COL28");
	xlsWriteLabel($tablehead, $kolomhead++, "COL29");
	xlsWriteLabel($tablehead, $kolomhead++, "COL30");
	xlsWriteLabel($tablehead, $kolomhead++, "COL31");
	xlsWriteLabel($tablehead, $kolomhead++, "COL32");
	xlsWriteLabel($tablehead, $kolomhead++, "COL33");
	xlsWriteLabel($tablehead, $kolomhead++, "COL34");
	xlsWriteLabel($tablehead, $kolomhead++, "COL35");
	xlsWriteLabel($tablehead, $kolomhead++, "COL36");
	xlsWriteLabel($tablehead, $kolomhead++, "COL37");
	xlsWriteLabel($tablehead, $kolomhead++, "COL38");
	xlsWriteLabel($tablehead, $kolomhead++, "COL39");
	xlsWriteLabel($tablehead, $kolomhead++, "COL40");
	xlsWriteLabel($tablehead, $kolomhead++, "TglDPA");
	xlsWriteLabel($tablehead, $kolomhead++, "NoDPA");

	foreach ($this->Simda_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL1);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL2);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL4);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL5);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL6);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL7);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL8);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL9);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL10);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL11);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL12);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL13);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL14);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL15);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL16);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL17);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL18);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL19);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL20);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL21);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL22);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL23);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL24);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL25);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL26);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL27);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL28);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL29);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL30);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL31);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL32);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL33);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL34);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL35);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL36);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL37);
	    xlsWriteNumber($tablebody, $kolombody++, $data->COL38);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL39);
	    xlsWriteLabel($tablebody, $kolombody++, $data->COL40);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglDPA);
	    xlsWriteLabel($tablebody, $kolombody++, $data->noDPA);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=simda.doc");

        $data = array(
            'simda_data' => $this->Simda_model->get_all(),
            'start' => 0
        );
        
        $this->_render_page('simda_test/simda_doc',$data);
    }

 // RENDER HALAMAN 
function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
{

    $this->viewdata = (empty($data)) ? $this->data: $data;
    if($this->uri->segment(2)=='login'){
        $view_html = $this->load->view($view, $this->viewdata, $returnhtml);
    }else{
        $view_html = $this->template->load('template_box',$view, $this->viewdata, $returnhtml); //$this->load->view($view, $this->viewdata, $returnhtml); //load tehemplate
    }
    

    if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
}

}

/* End of file Simda_test.php */
/* Location: ./application/controllers/Simda_test.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 04:56:21 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*============================================================================*/
