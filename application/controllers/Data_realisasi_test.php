<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_realisasi_test extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_realisasitest_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('data_realisasi_test/data_realisasi_list');
        $this->template->load('template','data_realisasi_test/data_realisasi_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Data_realisasitest_model->json();
    }

    public function read($id) 
    {
        $row = $this->Data_realisasitest_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'data_realisasi',
		'kdRealisasi' => $row->kdRealisasi,
		'ke' => $row->ke,
		'progres' => $row->progres,
		'fisik' => $row->fisik,
		'potMCLALU' => $row->potMCLALU,
		'potUMK' => $row->potUMK,
		'potRETENSI' => $row->potRETENSI,
		'nilaiBAP' => $row->nilaiBAP,
		'pajakPPH' => $row->pajakPPH,
		'pajakPPN' => $row->pajakPPN,
		'noSPP' => $row->noSPP,
		'tglSPP' => $row->tglSPP,
		'noSPM' => $row->noSPM,
		'tglSPM' => $row->tglSPM,
		'JenisTagihan' => $row->JenisTagihan,
		'tglTAGIHAN' => $row->tglTAGIHAN,
		'noTAGIHAN' => $row->noTAGIHAN,
		'kdpaket' => $row->kdpaket,
	    );
            $this->load->view('data_realisasi_test/data_realisasi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_realisasi_test'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'data_realisasi',
            'button' => 'Create',
            'action' => site_url('data_realisasi_test/create_action'),
	    'kdRealisasi' => set_value('kdRealisasi'),
	    'ke' => set_value('ke'),
	    'progres' => set_value('progres'),
	    'fisik' => set_value('fisik'),
	    'potMCLALU' => set_value('potMCLALU'),
	    'potUMK' => set_value('potUMK'),
	    'potRETENSI' => set_value('potRETENSI'),
	    'nilaiBAP' => set_value('nilaiBAP'),
	    'pajakPPH' => set_value('pajakPPH'),
	    'pajakPPN' => set_value('pajakPPN'),
	    'noSPP' => set_value('noSPP'),
	    'tglSPP' => set_value('tglSPP'),
	    'noSPM' => set_value('noSPM'),
	    'tglSPM' => set_value('tglSPM'),
	    'JenisTagihan' => set_value('JenisTagihan'),
	    'tglTAGIHAN' => set_value('tglTAGIHAN'),
	    'noTAGIHAN' => set_value('noTAGIHAN'),
	    'kdpaket' => set_value('kdpaket'),
	);
        //$this->load->view('data_realisasi_test/data_realisasi_form', $data);
        $this->_render_page('data_realisasi_test/data_realisasi_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'ke' => $this->input->post('ke',TRUE),
		'progres' => $this->input->post('progres',TRUE),
		'fisik' => $this->input->post('fisik',TRUE),
		'potMCLALU' => $this->input->post('potMCLALU',TRUE),
		'potUMK' => $this->input->post('potUMK',TRUE),
		'potRETENSI' => $this->input->post('potRETENSI',TRUE),
		'nilaiBAP' => $this->input->post('nilaiBAP',TRUE),
		'pajakPPH' => $this->input->post('pajakPPH',TRUE),
		'pajakPPN' => $this->input->post('pajakPPN',TRUE),
		'noSPP' => $this->input->post('noSPP',TRUE),
		'tglSPP' => $this->input->post('tglSPP',TRUE),
		'noSPM' => $this->input->post('noSPM',TRUE),
		'tglSPM' => $this->input->post('tglSPM',TRUE),
		'JenisTagihan' => $this->input->post('JenisTagihan',TRUE),
		'tglTAGIHAN' => $this->input->post('tglTAGIHAN',TRUE),
		'noTAGIHAN' => $this->input->post('noTAGIHAN',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_realisasitest_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_realisasi_test'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_realisasitest_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'data_realisasi',
                'button' => 'Update',
                'action' => site_url('data_realisasi_test/update_action'),
		'kdRealisasi' => set_value('kdRealisasi', $row->kdRealisasi),
		'ke' => set_value('ke', $row->ke),
		'progres' => set_value('progres', $row->progres),
		'fisik' => set_value('fisik', $row->fisik),
		'potMCLALU' => set_value('potMCLALU', $row->potMCLALU),
		'potUMK' => set_value('potUMK', $row->potUMK),
		'potRETENSI' => set_value('potRETENSI', $row->potRETENSI),
		'nilaiBAP' => set_value('nilaiBAP', $row->nilaiBAP),
		'pajakPPH' => set_value('pajakPPH', $row->pajakPPH),
		'pajakPPN' => set_value('pajakPPN', $row->pajakPPN),
		'noSPP' => set_value('noSPP', $row->noSPP),
		'tglSPP' => set_value('tglSPP', $row->tglSPP),
		'noSPM' => set_value('noSPM', $row->noSPM),
		'tglSPM' => set_value('tglSPM', $row->tglSPM),
		'JenisTagihan' => set_value('JenisTagihan', $row->JenisTagihan),
		'tglTAGIHAN' => set_value('tglTAGIHAN', $row->tglTAGIHAN),
		'noTAGIHAN' => set_value('noTAGIHAN', $row->noTAGIHAN),
		'kdpaket' => set_value('kdpaket', $row->kdpaket),
	    );
            $this->_render_page('data_realisasi_test/data_realisasi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_realisasi_test'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdRealisasi', TRUE));
        } else {
            $data = array(
		'ke' => $this->input->post('ke',TRUE),
		'progres' => $this->input->post('progres',TRUE),
		'fisik' => $this->input->post('fisik',TRUE),
		'potMCLALU' => $this->input->post('potMCLALU',TRUE),
		'potUMK' => $this->input->post('potUMK',TRUE),
		'potRETENSI' => $this->input->post('potRETENSI',TRUE),
		'nilaiBAP' => $this->input->post('nilaiBAP',TRUE),
		'pajakPPH' => $this->input->post('pajakPPH',TRUE),
		'pajakPPN' => $this->input->post('pajakPPN',TRUE),
		'noSPP' => $this->input->post('noSPP',TRUE),
		'tglSPP' => $this->input->post('tglSPP',TRUE),
		'noSPM' => $this->input->post('noSPM',TRUE),
		'tglSPM' => $this->input->post('tglSPM',TRUE),
		'JenisTagihan' => $this->input->post('JenisTagihan',TRUE),
		'tglTAGIHAN' => $this->input->post('tglTAGIHAN',TRUE),
		'noTAGIHAN' => $this->input->post('noTAGIHAN',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_realisasitest_model->update($this->input->post('kdRealisasi', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_realisasi_test'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_realisasitest_model->get_by_id($id);

        if ($row) {
            $this->Data_realisasitest_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_realisasi_test'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_realisasi_test'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('ke', 'ke', 'trim|required');
	$this->form_validation->set_rules('progres', 'progres', 'trim|required|numeric');
	$this->form_validation->set_rules('fisik', 'fisik', 'trim|required|numeric');
	$this->form_validation->set_rules('potMCLALU', 'potmclalu', 'trim|required|numeric');
	$this->form_validation->set_rules('potUMK', 'potumk', 'trim|required|numeric');
	$this->form_validation->set_rules('potRETENSI', 'potretensi', 'trim|required|numeric');
	$this->form_validation->set_rules('nilaiBAP', 'nilaibap', 'trim|required|numeric');
	$this->form_validation->set_rules('pajakPPH', 'pajakpph', 'trim|required|numeric');
	$this->form_validation->set_rules('pajakPPN', 'pajakppn', 'trim|required|numeric');
	$this->form_validation->set_rules('noSPP', 'nospp', 'trim|required');
	$this->form_validation->set_rules('tglSPP', 'tglspp', 'trim|required');
	$this->form_validation->set_rules('noSPM', 'nospm', 'trim|required');
	$this->form_validation->set_rules('tglSPM', 'tglspm', 'trim|required');
	$this->form_validation->set_rules('JenisTagihan', 'jenistagihan', 'trim|required');
	$this->form_validation->set_rules('tglTAGIHAN', 'tgltagihan', 'trim|required');
	$this->form_validation->set_rules('noTAGIHAN', 'notagihan', 'trim|required');
	$this->form_validation->set_rules('kdpaket', 'kdpaket', 'trim|required');

	$this->form_validation->set_rules('kdRealisasi', 'kdRealisasi', 'trim');
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

/* End of file Data_realisasi_test.php */
/* Location: ./application/controllers/Data_realisasi_test.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-03 15:55:54 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 03 Feb 2020 */
/*============================================================================*/
