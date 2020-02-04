<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_dpa2 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_dpa_model2');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('master_dpa2/master_dpa_list');
        $this->template->load('template','master_dpa2/master_dpa_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Master_dpa_model2->json();
    }

    public function read($id) 
    {
        $row = $this->Master_dpa_model2->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'master_dpa',
		'kdDPA' => $row->kdDPA,
		'tahun' => $row->tahun,
		'Tanggal' => $row->Tanggal,
		'pa_id' => $row->pa_id,
		'bendahara_id' => $row->bendahara_id,
		'ppk_id' => $row->ppk_id,
	    );
            $this->load->view('master_dpa2/master_dpa_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_dpa2'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'master_dpa',
            'button' => 'Create',
            'action' => site_url('master_dpa2/create_action'),
	    'kdDPA' => set_value('kdDPA'),
	    'tahun' => set_value('tahun'),
	    'Tanggal' => set_value('Tanggal'),
	    'pa_id' => set_value('pa_id'),
	    'bendahara_id' => set_value('bendahara_id'),
	    'ppk_id' => set_value('ppk_id'),
	);
        //$this->load->view('master_dpa2/master_dpa_form', $data);
        $this->_render_page('master_dpa2/master_dpa_form', $data);
        
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
		'pa_id' => $this->input->post('pa_id',TRUE),
		'bendahara_id' => $this->input->post('bendahara_id',TRUE),
		'ppk_id' => $this->input->post('ppk_id',TRUE),
	    );

            $this->Master_dpa_model2->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_dpa2'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_dpa_model2->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'master_dpa',
                'button' => 'Update',
                'action' => site_url('master_dpa2/update_action'),
		'kdDPA' => set_value('kdDPA', $row->kdDPA),
		'tahun' => set_value('tahun', $row->tahun),
		'Tanggal' => set_value('Tanggal', $row->Tanggal),
		'pa_id' => set_value('pa_id', $row->pa_id),
		'bendahara_id' => set_value('bendahara_id', $row->bendahara_id),
		'ppk_id' => set_value('ppk_id', $row->ppk_id),
	    );
            $this->_render_page('master_dpa2/master_dpa_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_dpa2'));
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
		'pa_id' => $this->input->post('pa_id',TRUE),
		'bendahara_id' => $this->input->post('bendahara_id',TRUE),
		'ppk_id' => $this->input->post('ppk_id',TRUE),
	    );

            $this->Master_dpa_model2->update($this->input->post('kdDPA', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_dpa2'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_dpa_model2->get_by_id($id);

        if ($row) {
            $this->Master_dpa_model2->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_dpa2'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_dpa2'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
	$this->form_validation->set_rules('Tanggal', 'tanggal', 'trim|required');
	$this->form_validation->set_rules('pa_id', 'pa id', 'trim|required');
	$this->form_validation->set_rules('bendahara_id', 'bendahara id', 'trim|required');
	$this->form_validation->set_rules('ppk_id', 'ppk id', 'trim|required');

	$this->form_validation->set_rules('kdDPA', 'kdDPA', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_dpa.xls";
        $judul = "master_dpa";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Pa Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Bendahara Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Ppk Id");

	foreach ($this->Master_dpa_model2->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Tanggal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pa_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bendahara_id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ppk_id);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=master_dpa.doc");

        $data = array(
            'master_dpa_data' => $this->Master_dpa_model2->get_all(),
            'start' => 0
        );
        
        $this->_render_page('master_dpa2/master_dpa_doc',$data);
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

/* End of file Master_dpa2.php */
/* Location: ./application/controllers/Master_dpa2.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-17 00:55:46 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 17 Jan 2020 */
/*============================================================================*/
