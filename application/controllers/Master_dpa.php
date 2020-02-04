<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_dpa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_dpa_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('master_dpa/master_dpa_list');
        $this->template->load('template','master_dpa/master_dpa_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Master_dpa_model->json();
    }

    public function read($id) 
    {
        $row = $this->Master_dpa_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'master_dpa',
		'kdDPA' => $row->kdDPA,
		'kategori' => $row->kategori,
		'tahun' => $row->tahun,
		'Tanggal' => $row->Tanggal,
		'pa_id' => $row->pa_id,
		'bendahara_id' => $row->bendahara_id,
		'ppk_id' => $row->ppk_id,
	    );
            $this->load->view('master_dpa/master_dpa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_dpa'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'master_dpa',
            'button' => 'Create',
            'action' => site_url('master_dpa/create_action'),
	    'kdDPA' => set_value('kdDPA'),
	    'kategori' => set_value('kategori'),
	    'tahun' => set_value('tahun'),
	    'Tanggal' => set_value('Tanggal'),
	    'pa_id' => set_value('pa_id'),
	    'bendahara_id' => set_value('bendahara_id'),
	    'ppk_id' => set_value('ppk_id'),
	);
        //$this->load->view('master_dpa/master_dpa_form', $data);
        $this->_render_page('master_dpa/master_dpa_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kategori' => $this->input->post('kategori',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'Tanggal' => $this->input->post('Tanggal',TRUE),
		'pa_id' => $this->input->post('pa_id',TRUE),
		'bendahara_id' => $this->input->post('bendahara_id',TRUE),
		'ppk_id' => $this->input->post('ppk_id',TRUE),
	    );

            $this->Master_dpa_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_dpa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_dpa_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'master_dpa',
                'button' => 'Update',
                'action' => site_url('master_dpa/update_action'),
		'kdDPA' => set_value('kdDPA', $row->kdDPA),
		'kategori' => set_value('kategori', $row->kategori),
		'tahun' => set_value('tahun', $row->tahun),
		'Tanggal' => set_value('Tanggal', $row->Tanggal),
		'pa_id' => set_value('pa_id', $row->pa_id),
		'bendahara_id' => set_value('bendahara_id', $row->bendahara_id),
		'ppk_id' => set_value('ppk_id', $row->ppk_id),
	    );
            $this->_render_page('master_dpa/master_dpa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_dpa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdDPA', TRUE));
        } else {
            $data = array(
		'kategori' => $this->input->post('kategori',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'Tanggal' => $this->input->post('Tanggal',TRUE),
		'pa_id' => $this->input->post('pa_id',TRUE),
		'bendahara_id' => $this->input->post('bendahara_id',TRUE),
		'ppk_id' => $this->input->post('ppk_id',TRUE),
	    );

            $this->Master_dpa_model->update($this->input->post('kdDPA', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_dpa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_dpa_model->get_by_id($id);

        if ($row) {
            $this->Master_dpa_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_dpa'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_dpa'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('Tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('pa_id', 'pa id', 'trim|required');
	$this->form_validation->set_rules('bendahara_id', 'bendahara id', 'trim|required');
	$this->form_validation->set_rules('ppk_id', 'ppk id', 'trim|required');

	$this->form_validation->set_rules('kdDPA', 'kdDPA', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
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

/* End of file Master_dpa.php */
/* Location: ./application/controllers/Master_dpa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-04 00:01:36 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 04 Feb 2020 */
/*============================================================================*/
