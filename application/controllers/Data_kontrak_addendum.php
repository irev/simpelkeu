<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_kontrak_addendum extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Data_kontrak_addendum_model','Data_kontrak_model']);
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('data_kontrak_addendum/data_kontrak_addendum_list');
        $this->template->load('template','data_kontrak_addendum/data_kontrak_addendum_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Data_kontrak_addendum_model->json();
    }

    public function read($id) 
    {
        $row = $this->Data_kontrak_addendum_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'data_kontrak_addendum',
		'kdAddendum' => $row->kdAddendum,
		'kdKontrak' => $row->kdKontrak,
		'Tgl' => $row->Tgl,
		'nilai' => $row->nilai,
		'tglakhir' => $row->tglakhir,
	    );
            $this->load->view('data_kontrak_addendum/data_kontrak_addendum_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kontrak_addendum'));
        }
    }

    public function kontrak($id) 
    {
        $id = $this->uri->segment(3);
        $cek_kontrak = $this->db->get_where('data_kontrak_addendum', ['kdKontrak'=>$id])->num_rows();
        $idAddendum = $this->db->get_where('data_kontrak_addendum', ['kdKontrak'=>$id])->row('kdAddendum');
        $this->create();
        /*
        //echo $this->db->last_query();
        if($cek_kontrak>0){
            //echo $cek_kontrak;
            $this->create();
        }else{
            // echo 'kontrak belum ada ';
            $this->update($idAddendum);
        }
 */       
    }



    private function create() 
    {
        $id = $this->uri->segment(3);
        $data = array(
            'title' => 'data_kontrak_addendum',
            'button' => 'Create',
            'action' => site_url('data_kontrak_addendum/create_action/'.$id),
            'kdAddendum' => set_value('kdAddendum'),
            'kdKontrak' => set_value('kdKontrak'),
            'Tgl' => set_value('Tgl'),
            'nilai' => set_value('nilai'),
            'tglakhir' => set_value('tglakhir'),
	    );
        //$this->load->view('data_kontrak_addendum/data_kontrak_addendum_form', $data);
        $this->_render_page('data_kontrak_addendum/data_kontrak_addendum_form', $data);
        
    }
    
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                
		'kdAddendum' => 'add'.md5($this->input->post('kdAddendum',TRUE)),
		'nomorAddendum' => $this->input->post('kdAddendum',TRUE),
		'kdKontrak' => $this->input->post('kdKontrak',TRUE),
		'Tgl' => $this->input->post('Tgl',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'tglakhir' => $this->input->post('tglakhir',TRUE),
        );
        $kdKontrak = $this->input->post('kdKontrak',TRUE);
        $row = $this->Data_kontrak_model->get_by_id($kdKontrak);
            $this->Data_kontrak_addendum_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_kontrak/read/'.$kdKontrak)); //asli
            //echo $row->kdpaket;
            //print_r($row);
            //redirect(site_url('paket/read/'.$row->kdpaket)); 
        }
    }
    
    private function update($id) 
    {
        $row = $this->Data_kontrak_addendum_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'data_kontrak_addendum',
                'button' => 'Update',
                'action' => site_url('data_kontrak_addendum/update_action'),
		'kdAddendum' => set_value('kdAddendum', $row->kdAddendum),
		'kdKontrak' => set_value('kdKontrak', $row->kdKontrak),
		'Tgl' => set_value('Tgl', $row->Tgl),
		'nilai' => set_value('nilai', $row->nilai),
		'tglakhir' => set_value('tglakhir', $row->tglakhir),
	    );
            $this->_render_page('data_kontrak_addendum/data_kontrak_addendum_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kontrak_addendum'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdAddendum', TRUE));
        } else {
            $data = array(
		'kdKontrak' => $this->input->post('kdKontrak',TRUE),
		'Tgl' => $this->input->post('Tgl',TRUE),
		'nilai' => $this->input->post('nilai',TRUE),
		'tglakhir' => $this->input->post('tglakhir',TRUE),
	    );

            $this->Data_kontrak_addendum_model->update($this->input->post('kdAddendum', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_kontrak_addendum'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_kontrak_addendum_model->get_by_id($id);

        if ($row) {
            $this->Data_kontrak_addendum_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_kontrak_addendum'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kontrak_addendum'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kdKontrak', 'kdkontrak', 'trim|required');
	$this->form_validation->set_rules('Tgl', 'tgl', 'trim|required');
	$this->form_validation->set_rules('nilai', 'nilai', 'trim|required|numeric');
	$this->form_validation->set_rules('tglakhir', 'tglakhir', 'trim|required');

	$this->form_validation->set_rules('kdAddendum', 'kdAddendum', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_kontrak_addendum.xls";
        $judul = "data_kontrak_addendum";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KdKontrak");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl");
	xlsWriteLabel($tablehead, $kolomhead++, "Nilai");
	xlsWriteLabel($tablehead, $kolomhead++, "Tglakhir");

	foreach ($this->Data_kontrak_addendum_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdKontrak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Tgl);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilai);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglakhir);

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

/* End of file Data_kontrak_addendum.php */
/* Location: ./application/controllers/Data_kontrak_addendum.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:59:52 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*============================================================================*/
