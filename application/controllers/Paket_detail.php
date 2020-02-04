<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paket_detail extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Paket_detail_model');
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
    }

    public function index()
    {
        //$this->load->view('paket_detail/paket_detail_list');
        $this->template->load('template','paket_detail/paket_detail_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Paket_detail_model->json();
    }

    public function read($id) 
    {
        $row = $this->Paket_detail_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'paket_detail',
		'detailpaket' => $row->detailpaket,
		'kdPaket' => $row->kdPaket,
		'kdPekerjaan' => $row->kdPekerjaan,
	    );
            $this->load->view('paket_detail/paket_detail_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paket_detail'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'paket_detail',
            'button' => 'Create',
            'action' => site_url('paket_detail/create_action'),
	    'detailpaket' => set_value('detailpaket'),
	    'kdPaket' => set_value('kdPaket'),
	    'kdPekerjaan' => set_value('kdPekerjaan'),
	);
        //$this->load->view('paket_detail/paket_detail_form', $data);
        $this->_render_page('paket_detail/paket_detail_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kdPaket' => $this->input->post('kdPaket',TRUE),
		'kdPekerjaan' => $this->input->post('kdPekerjaan',TRUE),
	    );

            $this->Paket_detail_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('paket_detail'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Paket_detail_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'paket_detail',
                'button' => 'Update',
                'action' => site_url('paket_detail/update_action'),
		'detailpaket' => set_value('detailpaket', $row->detailpaket),
		'kdPaket' => set_value('kdPaket', $row->kdPaket),
		'kdPekerjaan' => set_value('kdPekerjaan', $row->kdPekerjaan),
	    );
            $this->_render_page('paket_detail/paket_detail_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paket_detail'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('detailpaket', TRUE));
        } else {
            $data = array(
		'kdPaket' => $this->input->post('kdPaket',TRUE),
		'kdPekerjaan' => $this->input->post('kdPekerjaan',TRUE),
	    );

            $this->Paket_detail_model->update($this->input->post('detailpaket', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('paket_detail'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Paket_detail_model->get_by_id($id);

        if ($row) {
            $this->Paket_detail_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('paket_detail'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paket_detail'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kdPaket', 'kdpaket', 'trim|required');
	$this->form_validation->set_rules('kdPekerjaan', 'kdpekerjaan', 'trim|required');

	$this->form_validation->set_rules('detailpaket', 'detailpaket', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "paket_detail.xls";
        $judul = "paket_detail";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KdPaket");
	xlsWriteLabel($tablehead, $kolomhead++, "KdPekerjaan");

	foreach ($this->Paket_detail_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdPaket);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdPekerjaan);

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

/* End of file Paket_detail.php */
/* Location: ./application/controllers/Paket_detail.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:22:32 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*============================================================================*/
