<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_kegiatan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('master_kegiatan/master_kegiatan_list');
        $this->template->load('template','master_kegiatan/master_kegiatan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Master_kegiatan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Master_kegiatan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'master_kegiatan',
		'kdKegiatan' => $row->kdKegiatan,
		'nmKegiatan' => $row->nmKegiatan,
		'kd_program' => $row->kd_program,
	    );
            $this->load->view('master_kegiatan/master_kegiatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kegiatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'master_kegiatan',
            'button' => 'Create',
            'action' => site_url('master_kegiatan/create_action'),
	    'kdKegiatan' => set_value('kdKegiatan'),
	    'nmKegiatan' => set_value('nmKegiatan'),
	    'kd_program' => set_value('kd_program'),
	);
        //$this->load->view('master_kegiatan/master_kegiatan_form', $data);
        $this->_render_page('master_kegiatan/master_kegiatan_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nmKegiatan' => $this->input->post('nmKegiatan',TRUE),
		'kd_program' => $this->input->post('kd_program',TRUE),
	    );

            $this->Master_kegiatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_kegiatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_kegiatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'master_kegiatan',
                'button' => 'Update',
                'action' => site_url('master_kegiatan/update_action'),
		'kdKegiatan' => set_value('kdKegiatan', $row->kdKegiatan),
		'nmKegiatan' => set_value('nmKegiatan', $row->nmKegiatan),
		'kd_program' => set_value('kd_program', $row->kd_program),
	    );
            $this->_render_page('master_kegiatan/master_kegiatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kegiatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdKegiatan', TRUE));
        } else {
            $data = array(
		'nmKegiatan' => $this->input->post('nmKegiatan',TRUE),
		'kd_program' => $this->input->post('kd_program',TRUE),
	    );

            $this->Master_kegiatan_model->update($this->input->post('kdKegiatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_kegiatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_kegiatan_model->get_by_id($id);

        if ($row) {
            $this->Master_kegiatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_kegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_kegiatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nmKegiatan', 'nmkegiatan', 'trim|required');
	$this->form_validation->set_rules('kd_program', 'kd program', 'trim|required');

	$this->form_validation->set_rules('kdKegiatan', 'kdKegiatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_kegiatan.xls";
        $judul = "master_kegiatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NmKegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kd Program");

	foreach ($this->Master_kegiatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmKegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kd_program);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=master_kegiatan.doc");

        $data = array(
            'master_kegiatan_data' => $this->Master_kegiatan_model->get_all(),
            'start' => 0
        );
        
        $this->_render_page('master_kegiatan/master_kegiatan_doc',$data);
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

/* End of file Master_kegiatan.php */
/* Location: ./application/controllers/Master_kegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-17 00:58:01 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 17 Jan 2020 */
/*============================================================================*/
