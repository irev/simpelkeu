<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_opd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_opd_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('master_opd/master_opd_list');
        $this->template->load('template','master_opd/master_opd_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Master_opd_model->json();
    }

    public function read($id) 
    {
        $row = $this->Master_opd_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'Master OPD',
		'kdOPD' => $row->kdOPD,
		'nmOPD' => $row->nmOPD,
		'Alamat' => $row->Alamat,
		'Telpon' => $row->Telpon,
	    );
            $this->_render_page('master_opd/master_opd_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_opd'));
        }
    }


    public function setting() 
    {
       $row = $this->db->get('master_opd')->num_rows();
       $Data = $this->db->get('master_opd')->row();

       if($row>0){
           $this->update($Data->kdOPD); 
       }else{
        $this->create();
       }
        
    }

    private function create() 
    {
        $data = array(
            'title' => 'Master OPD',
            'button' => 'Create',
            'action' => site_url('master_opd/create_action'),
	    'kdOPD' => set_value('kdOPD'),
	    'nmOPD' => set_value('nmOPD'),
	    'Alamat' => set_value('Alamat'),
	    'Telpon' => set_value('Telpon'),
	);
        //$this->load->view('master_opd/master_opd_form', $data);
        $this->_render_page('master_opd/master_opd_form', $data);
        
    }

    
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kdOPD' => $this->input->post('kdOPD',TRUE),
		'nmOPD' => $this->input->post('nmOPD',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Telpon' => $this->input->post('Telpon',TRUE),
	    );
            $this->Master_opd_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_opd'));
        }
    }
    
    private function update($id) 
    {
        $row = $this->Master_opd_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'Master OPD',
                'button' => 'Update',
                'action' => site_url('master_opd/update_action'),
		'kdOPD' => set_value('kdOPD', $row->kdOPD),
		'nmOPD' => set_value('nmOPD', $row->nmOPD),
		'Alamat' => set_value('Alamat', $row->Alamat),
		'Telpon' => set_value('Telpon', $row->Telpon),
	    );
            $this->_render_page('master_opd/master_opd_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_opd'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules_update();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdOPD-last', TRUE));
        } else {
            $data = array(
        'kdOPD' => $this->input->post('kdOPD', TRUE),      
		'nmOPD' => $this->input->post('nmOPD',TRUE),
		'Alamat' => $this->input->post('Alamat',TRUE),
		'Telpon' => $this->input->post('Telpon',TRUE),
	    );

            $this->Master_opd_model->update($this->input->post('kdOPD-last', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            //echo $this->db->last_query();
            redirect(site_url('master_opd'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_opd_model->get_by_id($id);

        if ($row) {
            $this->Master_opd_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_opd'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_opd'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('nmOPD', 'nmopd', 'trim|required');
    $this->form_validation->set_rules('Alamat', 'alamat', 'trim|required',
        array('required' => 'Silahkan isi alamat kantor OPD')
    );
    $this->form_validation->set_rules('Telpon', 'telpon', 'trim|required',
    array('required' => 'Silahkan isi Telpon kantor OPD')
    );

    $this->form_validation->set_rules('kdOPD', 'kdOPD', 'trim|required|is_unique[master_opd.kdOPD]',
            array('required' => 'Pilih Nama OPD'),
            array('is_unique' => 'is_unique required')
    );
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_update() 
    {
    $this->form_validation->set_rules('nmOPD', 'nmopd', 'trim|required');
    $this->form_validation->set_rules('Alamat', 'alamat', 'trim|required',
        array('required' => 'Silahkan isi alamat kantor OPD')
    );
    $this->form_validation->set_rules('Telpon', 'telpon', 'trim|required',
    array('required' => 'Silahkan isi Telpon kantor OPD')
    );
    /*
    $this->form_validation->set_rules('kdOPD', 'kdOPD', 'trim|required|is_unique[master_opd.kdOPD]',
            array('required' => 'Pilih Nama OPD'),
            array('is_unique' => 'is_unique required')
    );
    */
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

/* End of file Master_opd.php */
/* Location: ./application/controllers/Master_opd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 18:04:45 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 20 Jan 2020 */
/*============================================================================*/
