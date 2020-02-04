<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_jaminan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_jaminan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('data_jaminan/data_jaminan_list');
        $this->template->load('template','data_jaminan/data_jaminan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Data_jaminan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Data_jaminan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'data_jaminan',
		'kdJaminan' => $row->kdJaminan,
		'penjamin' => $row->penjamin,
		'nilai' => $row->nilai,
		'tgl' => $row->tgl,
		'Type' => $row->Type,
		'kdpaket' => $row->kdpaket,
	    );
            $this->load->view('data_jaminan/data_jaminan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_jaminan'));
        }
    }

    public function paket($id){
        //$id = $this->uri->segment(3);
        $cek_kontrak = $this->db->get_where('data_jaminan', ['kdpaket'=>$id])->num_rows();
        $idkontrak = $this->db->get_where('data_jaminan', ['kdpaket'=>$id])->row('kdJaminan');
        //echo $this->db->last_query();
        //if($cek_kontrak){
            //echo $cek_kontrak;
        //    $this->update($idkontrak);
        //}else{
            // echo 'kontrak belum ada ';
            $this->create();
       // }

    }


    public function create() 
    {
        $id =  $this->uri->segment(3);
        $data = array(
            'title' => 'data_jaminan',
            'button' => 'Create',
            'action' => site_url('data_jaminan/create_action/'.$id),
	    'kdJaminan' => set_value('kdJaminan'),
	    'penjamin' => set_value('penjamin'),
	    'nilai' => set_value('nilai'),
	    'tgl' => set_value('tgl'),
	    'Type' => set_value('Type'),
	    'kdpaket' => set_value('kdpaket'),
	);
        //$this->load->view('data_jaminan/data_jaminan_form', $data);
        $this->_render_page('data_jaminan/data_jaminan_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kdJaminan' => $this->input->post('kdJaminan',TRUE),
		'penjamin' => $this->input->post('penjamin',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
		'Type' => $this->input->post('Type',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_jaminan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('paket/read/'.$this->input->post('kdpaket',TRUE)));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_jaminan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'data_jaminan',
                'button' => 'Update',
                'action' => site_url('data_jaminan/update_action'),
		'kdJaminan' => set_value('kdJaminan', $row->kdJaminan),
		'penjamin' => set_value('penjamin', $row->penjamin),
		'nilai' => set_value('nilai', $row->nilai),
		'tgl' => set_value('tgl', $row->tgl),
		'Type' => set_value('Type', $row->Type),
		'kdpaket' => set_value('kdpaket', $row->kdpaket),
	    );
            $this->_render_page('data_jaminan/data_jaminan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_jaminan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdJaminan', TRUE));
        } else {
            $data = array(
		'kdJaminan' => $this->input->post('kdJaminan',TRUE),
		'penjamin' => $this->input->post('penjamin',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'tgl' => $this->input->post('tgl',TRUE),
		'Type' => $this->input->post('Type',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_jaminan_model->update($this->input->post('kdJaminan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_jaminan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_jaminan_model->get_by_id($id);

        if ($row) {
            $this->Data_jaminan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_jaminan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_jaminan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('penjamin', 'penjamin', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required|numeric');
	$this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('Type', 'type', 'trim|required');
	$this->form_validation->set_rules('kdpaket', 'kdpaket', 'trim|required');

	$this->form_validation->set_rules('kdJaminan', 'kdJaminan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_jaminan.xls";
        $judul = "data_jaminan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Penjamin");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Kdpaket");

	foreach ($this->Data_jaminan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->penjamin);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Type);
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

/* End of file Data_jaminan.php */
/* Location: ./application/controllers/Data_jaminan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:46:14 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*============================================================================*/
