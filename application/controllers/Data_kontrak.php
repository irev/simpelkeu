<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_kontrak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_kontrak_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('data_kontrak/data_kontrak_list');
        $this->template->load('template','data_kontrak/data_kontrak_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Data_kontrak_model->json();
    }

    public function read($id) 
    {
        $row = $this->Data_kontrak_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'Data Kontrak',
        'kdKontrak' => $row->kdKontrak,
        'nomorKontrak' => $row->nomorKontrak,
		'tglakhir' => $row->tglakhir,
		'TglKontrak' => $row->TglKontrak,
		'NomorPHO' => $row->NomorPHO,
		'tglPHO' => $row->tglPHO,
		'NomorFHO' => $row->NomorFHO,
		'tglFHO' => $row->tglFHO,
		'nilaiKontrak' => $row->nilaiKontrak,
		'namapaket' => $this->db->get('tbpaket',['kdPaket'=>$row->kdpaket])->row('nmPaket'),
		'kdpaket' => $row->kdpaket,
	    );
        $this->_render_page('data_kontrak/data_kontrak_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kontrak'));
        }
    }
    
    public function paket($id){
        $id = $this->uri->segment(3);
        $cek_kontrak = $this->db->get_where('data_kontrak', ['kdpaket'=>$id])->num_rows();
        $idkontrak = $this->db->get_where('data_kontrak', ['kdpaket'=>$id])->row('kdKontrak');

        //echo $this->db->last_query();
        if($cek_kontrak>0){
            //echo $cek_kontrak;
            $this->update($idkontrak);
        }else{
            // echo 'kontrak belum ada ';
            $this->create();
        }

    }

    
    public function byid($id) 
    {
        $cek_kontrak = $this->db->get_where('data_kontrak', ['kdpaket'=>$id])->num_rows();
        $idkontrak = $this->db->get_where('data_kontrak', ['kdpaket'=>$id])->row('kdKontrak');
        $rowkontrak = $this->db->get_where('data_kontrak', ['kdpaket'=>$id])->result();
        $row = $this->Data_kontrak_model->get_by_idpaket($id);
       // print_r($row);
        if ($row) {
            $data = array(
                'title' => 'Data Kontrak',
		'kdKontrak' => $row->kdKontrak,
		'tglakhir' => $row->tglakhir,
		'TglKontrak' => $row->TglKontrak,
		'NomorPHO' => $row->NomorPHO,
		'tglPHO' => $row->tglPHO,
		'NomorFHO' => $row->NomorFHO,
		'tglFHO' => $row->tglFHO,
		'nilaiKontrak' => $row->nilaiKontrak,
		'kdpaket' => $this->db->get('tbpaket',['kdPaket'=>$row->kdpaket])->row('nmPaket'),
	    );
            $this->_render_page('data_kontrak/data_kontrak_by_id',$data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('data_kontrak'));
            $this->create();
        }
        
    }


    public function create() 
    {
       
            $data = array(
                    'title' => 'data_kontrak',
                    'button' => 'Create',
                    'action' => site_url('data_kontrak/create_action'),
                    'kdKontrak' => set_value('nomorKontrak'),
                    'nomorKontrak' => set_value('nomorKontrak'),     
                    'tglakhir' => set_value('tglakhir'),
                    'TglKontrak' => set_value('TglKontrak'),
                    'NomorPHO' => set_value('NomorPHO'),
                    'tglPHO' => set_value('tglPHO'),
                    'NomorFHO' => set_value('NomorFHO'),
                    'tglFHO' => set_value('tglFHO'),
                    'nilaiKontrak' => set_value('nilaiKontrak'),
                    'kdpaket' => set_value('kdpaket'),
            );
                //$this->load->view('data_kontrak/data_kontrak_form', $data);
                $this->_render_page('data_kontrak/data_kontrak_form', $data);
        
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'kdKontrak' => 'kon'.md5($this->input->post('kdKontrak',TRUE)),
		'nomorKontrak' => $this->input->post('nomorKontrak',TRUE),
		'tglakhir' => $this->input->post('tglakhir',TRUE),
		'TglKontrak' => $this->input->post('TglKontrak',TRUE),
		'NomorPHO' => $this->input->post('NomorPHO',TRUE),
		'tglPHO' => $this->input->post('tglPHO',TRUE),
		'NomorFHO' => $this->input->post('NomorFHO',TRUE),
		'tglFHO' => $this->input->post('tglFHO',TRUE),
		'nilaiKontrak' => $this->input->post('nilaiKontrak',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_kontrak_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            //redirect(site_url('data_kontrak')); // asli
            redirect(site_url('paket/read/'.$this->input->post('kdpaket',TRUE)));
            
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_kontrak_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'data_kontrak',
                'button' => 'Update',
                'action' => site_url('data_kontrak/update_action'),
        'kdKontrak' => set_value('kdKontrak', $row->kdKontrak),
        'nomorKontrak' => set_value('nomorKontrak', $row->nomorKontrak),  
		'tglakhir' => set_value('tglakhir', $row->tglakhir),
		'TglKontrak' => set_value('TglKontrak', $row->TglKontrak),
		'NomorPHO' => set_value('NomorPHO', $row->NomorPHO),
		'tglPHO' => set_value('tglPHO', $row->tglPHO),
		'NomorFHO' => set_value('NomorFHO', $row->NomorFHO),
		'tglFHO' => set_value('tglFHO', $row->tglFHO),
		'nilaiKontrak' => set_value('nilaiKontrak', $row->nilaiKontrak),
		'kdpaket' => set_value('kdpaket', $row->kdpaket),
	    );
            $this->_render_page('data_kontrak/data_kontrak_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            //redirect(site_url('data_kontrak')); // asli
            redirect(site_url('paket/read/'.$row->kdpaket));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdKontrak', TRUE));
        } else {
            $data = array(
                'nomorKontrak' => $this->input->post('nomorKontrak',TRUE),
                'tglakhir' => $this->input->post('tglakhir',TRUE),
                'TglKontrak' => $this->input->post('TglKontrak',TRUE),
                'NomorPHO' => $this->input->post('NomorPHO',TRUE),
                'tglPHO' => $this->input->post('tglPHO',TRUE),
                'NomorFHO' => $this->input->post('NomorFHO',TRUE),
                'tglFHO' => $this->input->post('tglFHO',TRUE),
                'nilaiKontrak' => $this->input->post('nilaiKontrak',TRUE),
                'kdpaket' => $this->input->post('kdpaket',TRUE),
	        );

            $this->Data_kontrak_model->update($this->input->post('kdKontrak', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
             //redirect(site_url('data_kontrak')); // asli
             redirect(site_url('paket/read/'.$this->input->post('kdpaket',TRUE)));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_kontrak_model->get_by_id($id);
        $rowAddendum = $this->db->get_where('data_kontrak_addendum', ['kdKontrak'=>$id]);
        if ($rowAddendum->num_rows()==0) {
            if($row){
                $this->Data_kontrak_model->delete($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('paket/read/'.$row->kdpaket));
            }
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kontrak/read/'.$id));
            //echo 'kontrak   '; print_r($row); echo '   addendum row ';  print_r($rowAddendum->num_rows());
        }
    }

//delete Data_kontrak_addendum
public function deleteAddendum($id) 
{
    $row = $this->db->get_where('data_kontrak_addendum',['kdAddendum' => $id])->row();
    $kdKontrak = $this->uri->segment(4);
    if ($row && $kdKontrak != '') {
        //$this->Data_kontrak_addendum_model->delete($id);
        $this->db->where('kdAddendum', $id);
        $this->db->delete('data_kontrak_addendum');
        $this->session->set_flashdata('message', 'Delete Record Success');
        
        redirect(site_url('data_kontrak/read/'.$kdKontrak));
    } else {
        $this->session->set_flashdata('message', 'Record Not Found');
        redirect(site_url('data_kontrak/read/'.$kdKontrak));
    }
}


    public function _rules() 
    {
	$this->form_validation->set_rules('tglakhir', 'tglakhir', 'trim|required');
	$this->form_validation->set_rules('TglKontrak', 'tglkontrak', 'trim|required');
	$this->form_validation->set_rules('NomorPHO', 'nomorpho', 'trim|required');
	$this->form_validation->set_rules('tglPHO', 'tglpho', 'trim|required');
	$this->form_validation->set_rules('NomorFHO', 'nomorfho', 'trim|required');
	$this->form_validation->set_rules('tglFHO', 'tglfho', 'trim|required');
	$this->form_validation->set_rules('nilaiKontrak', 'nilaikontrak', 'trim|required|numeric');
	$this->form_validation->set_rules('kdpaket', 'kdpaket', 'trim|required');

	$this->form_validation->set_rules('kdKontrak', 'kdKontrak', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_kontrak.xls";
        $judul = "data_kontrak";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Tglakhir");
	xlsWriteLabel($tablehead, $kolomhead++, "TglKontrak");
	xlsWriteLabel($tablehead, $kolomhead++, "NomorPHO");
	xlsWriteLabel($tablehead, $kolomhead++, "TglPHO");
	xlsWriteLabel($tablehead, $kolomhead++, "NomorFHO");
	xlsWriteLabel($tablehead, $kolomhead++, "TglFHO");
	xlsWriteLabel($tablehead, $kolomhead++, "NilaiKontrak");
	xlsWriteLabel($tablehead, $kolomhead++, "Kdpaket");

	foreach ($this->Data_kontrak_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglakhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->TglKontrak);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NomorPHO);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglPHO);
	    xlsWriteLabel($tablebody, $kolombody++, $data->NomorFHO);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tglFHO);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nilaiKontrak);
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

/* End of file Data_kontrak.php */
/* Location: ./application/controllers/Data_kontrak.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:59:44 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*============================================================================*/
