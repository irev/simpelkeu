<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbpaket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbpaket_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('tbpaket/tbpaket_list');
        $this->template->load('template','tbpaket/tbpaket_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbpaket_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbpaket_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'tbpaket',
		'kdPaket' => $row->kdPaket,
		'nmPaket' => $row->nmPaket,
		'tahun' => $row->tahun,
		'md5namatahun' => $row->md5namatahun,
		'bidang' => $row->bidang,
	    );
            $this->load->view('tbpaket/tbpaket_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbpaket'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'tbpaket',
            'button' => 'Create',
            'action' => site_url('tbpaket/create_action'),
	    'kdPaket' => set_value('kdPaket'),
	    'nmPaket' => set_value('nmPaket'),
	    'tahun' => set_value('tahun'),
	    'md5namatahun' => set_value('md5namatahun'),
	    'bidang' => set_value('bidang'),
	);
        //$this->load->view('tbpaket/tbpaket_form', $data);
        $this->_render_page('tbpaket/tbpaket_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nmPaket' => $this->input->post('nmPaket',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'md5namatahun' => $this->input->post('md5namatahun',TRUE),
		'bidang' => $this->input->post('bidang',TRUE),
	    );

            $this->Tbpaket_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('tbpaket'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbpaket_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'tbpaket',
                'button' => 'Update',
                'action' => site_url('tbpaket/update_action'),
		'kdPaket' => set_value('kdPaket', $row->kdPaket),
		'nmPaket' => set_value('nmPaket', $row->nmPaket),
		'tahun' => set_value('tahun', $row->tahun),
		'md5namatahun' => set_value('md5namatahun', $row->md5namatahun),
		'bidang' => set_value('bidang', $row->bidang),
	    );
            $this->_render_page('tbpaket/tbpaket_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbpaket'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdPaket', TRUE));
        } else {
            $data = array(
		'nmPaket' => $this->input->post('nmPaket',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'md5namatahun' => $this->input->post('md5namatahun',TRUE),
		'bidang' => $this->input->post('bidang',TRUE),
	    );

            $this->Tbpaket_model->update($this->input->post('kdPaket', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbpaket'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbpaket_model->get_by_id($id);

        if ($row) {
            $this->Tbpaket_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbpaket'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbpaket'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nmPaket', 'nmpaket', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('md5namatahun', 'md5namatahun', 'trim|required');
	$this->form_validation->set_rules('bidang', 'bidang', 'trim|required');

	$this->form_validation->set_rules('kdPaket', 'kdPaket', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbpaket.xls";
        $judul = "tbpaket";
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
	xlsWriteLabel($tablehead, $kolomhead++, "NmPaket");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun");
	xlsWriteLabel($tablehead, $kolomhead++, "Md5namatahun");
	xlsWriteLabel($tablehead, $kolomhead++, "Bidang");

	foreach ($this->Tbpaket_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmPaket);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->md5namatahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bidang);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
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

/* End of file Tbpaket.php */
/* Location: ./application/controllers/Tbpaket.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:19:04 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*============================================================================*/
