<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbuser extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbuser_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('tbuser/tbuser_list');
        $this->template->load('template','tbuser/tbuser_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbuser_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbuser_model->get_by_id($id);
        if ($row) {
            $data = array(
		'Iduser' => $row->Iduser,
		'email' => $row->email,
		'username' => $row->username,
		'password' => $row->password,
		'akses' => $row->akses,
		'bidang' => $row->bidang,
		'status' => $row->status,
	    );
            $this->load->view('tbuser/tbuser_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbuser'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbuser/create_action'),
	    'Iduser' => set_value('Iduser'),
	    'email' => set_value('email'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'akses' => set_value('akses'),
	    'bidang' => set_value('bidang'),
	    'status' => set_value('status'),
	);
        $this->load->view('tbuser/tbuser_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'email' => $this->input->post('email',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'akses' => $this->input->post('akses',TRUE),
		'bidang' => $this->input->post('bidang',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tbuser_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbuser'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbuser_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbuser/update_action'),
		'Iduser' => set_value('Iduser', $row->Iduser),
		'email' => set_value('email', $row->email),
		'username' => set_value('username', $row->username),
		'password' => set_value('password', $row->password),
		'akses' => set_value('akses', $row->akses),
		'bidang' => set_value('bidang', $row->bidang),
		'status' => set_value('status', $row->status),
	    );
            $this->load->view('tbuser/tbuser_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbuser'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('Iduser', TRUE));
        } else {
            $data = array(
		'email' => $this->input->post('email',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->input->post('password',TRUE),
		'akses' => $this->input->post('akses',TRUE),
		'bidang' => $this->input->post('bidang',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tbuser_model->update($this->input->post('Iduser', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbuser'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbuser_model->get_by_id($id);

        if ($row) {
            $this->Tbuser_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbuser'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbuser'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('akses', 'akses', 'trim|required');
	$this->form_validation->set_rules('bidang', 'bidang', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('Iduser', 'Iduser', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbuser.xls";
        $judul = "tbuser";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Akses");
	xlsWriteLabel($tablehead, $kolomhead++, "Bidang");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");

	foreach ($this->Tbuser_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->akses);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bidang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbuser.doc");

        $data = array(
            'tbuser_data' => $this->Tbuser_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('tbuser/tbuser_doc',$data);
    }

}

/* End of file Tbuser.php */
/* Location: ./application/controllers/Tbuser.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-15 09:14:14 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 15 Jan 2020 */
/*============================================================================*/
