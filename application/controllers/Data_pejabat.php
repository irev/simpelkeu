<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_pejabat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_pejabat_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('data_pejabat/data_pejabat_list');
        $this->template->load('template','data_pejabat/data_pejabat_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Data_pejabat_model->json();
    }

    public function read($id) 
    {
        $row = $this->Data_pejabat_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'data_pejabat',
		'kpa' => $row->kpa,
		'nipkpa' => $row->nipkpa,
		'pptk' => $row->pptk,
		'nippptk' => $row->nippptk,
		'pengawas' => $row->pengawas,
		'nippengawas' => $row->nippengawas,
		'kdpaket' => $row->kdpaket,
	    );
            $this->load->view('data_pejabat/data_pejabat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_pejabat'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'data_pejabat',
            'button' => 'Create',
            'action' => site_url('data_pejabat/create_action'),
	    'kpa' => set_value('kpa'),
	    'nipkpa' => set_value('nipkpa'),
	    'pptk' => set_value('pptk'),
	    'nippptk' => set_value('nippptk'),
	    'pengawas' => set_value('pengawas'),
	    'nippengawas' => set_value('nippengawas'),
	    'kdpaket' => set_value('kdpaket'),
	);
        //$this->load->view('data_pejabat/data_pejabat_form', $data);
        $this->_render_page('data_pejabat/data_pejabat_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'kpa' => $this->input->post('kpa',TRUE),
		'nipkpa' => $this->input->post('nipkpa',TRUE),
		'pptk' => $this->input->post('pptk',TRUE),
		'nippptk' => $this->input->post('nippptk',TRUE),
		'pengawas' => $this->input->post('pengawas',TRUE),
		'nippengawas' => $this->input->post('nippengawas',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_pejabat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_pejabat'));
        }
    }
    
    public function update($id) 
    {
        //$row = $this->Data_pejabat_model->get_by_id($id);
        $row = $this->db->get_where('data_pejabat',['kdpaket'=>$id])->row();

        if ($row) {
            $data = array(
                'title' => 'data_pejabat',
                'button' => 'Update',
                'action' => site_url('data_pejabat/update_action/'.$row->kdpaket),
		'kpa' => set_value('kpa', $row->kpa),
		'nipkpa' => set_value('nipkpa', $row->nipkpa),
		'pptk' => set_value('pptk', $row->pptk),
		'nippptk' => set_value('nippptk', $row->nippptk),
		'pengawas' => set_value('pengawas', $row->pengawas),
		'nippengawas' => set_value('nippengawas', $row->nippengawas),
		'kdpaket' => set_value('kdpaket', $row->kdpaket),
	    );
            $this->_render_page('data_pejabat/data_pejabat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('data_pejabat'));
            redirect(site_url('paket/read/'.$row->kdpaket));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdpaket', TRUE));
        } else {
            $data = array(
                'kpa' => $this->input->post('kpa',TRUE),
                'nipkpa' => $this->input->post('nipkpa',TRUE),
                'pptk' => $this->input->post('pptk',TRUE),
                'nippptk' => $this->input->post('nippptk',TRUE),
                'pengawas' => $this->input->post('pengawas',TRUE),
                'nippengawas' => $this->input->post('nippengawas',TRUE),
                //'kdpaket' => $this->input->post('kdpaket',TRUE),
            );

            $this->Data_pejabat_model->update($this->input->post('kdpaket', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            //echo $this->db->last_query();
            redirect(site_url('paket/read/'. $this->input->post('kdpaket',TRUE)));
        }
    }
    
    public function paket($id){
        $row = $this->db->get_where('data_pejabat',['kdpaket'=>$id]);
        if($row->num_rows()>0){
             $ids = $this->db->get_where('data_pejabat',['kdpaket'=>$id])->row('kdpaket');
            //echo $this->db->last_query();
            $this->update($ids);
        }else{
            $this->create();
        }
    }






    public function delete($id) 
    {
        $row = $this->Data_pejabat_model->get_by_id($id);

        if ($row) {
            $this->Data_pejabat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_pejabat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_pejabat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kpa', 'kpa', 'trim|required');
	$this->form_validation->set_rules('nipkpa', 'nipkpa', 'trim|required');
	$this->form_validation->set_rules('pptk', 'pptk', 'trim|required');
	$this->form_validation->set_rules('nippptk', 'nippptk', 'trim|required');
	$this->form_validation->set_rules('pengawas', 'pengawas', 'trim');
	$this->form_validation->set_rules('nippengawas', 'nippengawas', 'trim');
	$this->form_validation->set_rules('kdpaket', 'kdpaket', 'trim|required');

	//$this->form_validation->set_rules('kpa', 'kpa', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_pejabat.xls";
        $judul = "data_pejabat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nipkpa");
	xlsWriteLabel($tablehead, $kolomhead++, "Pptk");
	xlsWriteLabel($tablehead, $kolomhead++, "Nippptk");
	xlsWriteLabel($tablehead, $kolomhead++, "Pengawas");
	xlsWriteLabel($tablehead, $kolomhead++, "Nippengawas");
	xlsWriteLabel($tablehead, $kolomhead++, "Kdpaket");

	foreach ($this->Data_pejabat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nipkpa);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pptk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nippptk);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pengawas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nippengawas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdpaket);

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

/* End of file Data_pejabat.php */
/* Location: ./application/controllers/Data_pejabat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 19:30:19 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*============================================================================*/
