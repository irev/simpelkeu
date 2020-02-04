<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Paket_model','Simda_model','Data_pejabat_model','Data_jaminan_model']);
        $this->load->library('form_validation');        
        $this->load->library('datatables');
        /// HANYA ADMIN
        $group = array(1, 2, 3 , 4);
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->in_group($group))
		{
			$this->session->set_flashdata('message', 'You must be an admin to view this page');
			redirect('auth');
        }
        
    }

    public function index()
    {
        // Setting page top
        $data['title'] = 'Paket';

        $this->template->load('template','paket/tbpaket_list',$data);
        /*
        $bidang = $this->input->get('bidang');
        if($bidang =''){
            $this->template->load('template','paket/tbpaket_list');
        }else{
            $this->template->load('template','paket/tbpaket_list_bybidang');
        }
        */
        
       
    } 
    
    public function json($id=null) {
        header('Content-Type: application/json');
        if($id==null){
            
            echo $this->Paket_model->jsonPaket(); // modif query untuk dapatkan tot pagu 
            //echo $this->Paket_model->json();
        }else{
            echo $this->Paket_model->jsonByBidang($id);
        }
    }

    public function read($id) 
    {
        $row = $this->Paket_model->get_by_id($id);
        if ($row) {

            $detail = $this->db->get_where('paket_detail', ['kdPaket'=>$id])->row();
            $details = $this->db->get_where('paket_detail', ['kdPaket'=>$id])->num_rows();

            if($details ==1){
                $dpa = $this->db->get_where('simda',['id' => $detail->kdPekerjaan])->row();
            }else{
                //$dpa = $this->db->get_where('simda',['id' => $detail->kdPekerjaan])->row();
                $dpa='';
            }
            $details = array(

            );
            $data = array(
                'title' => 'Paket',
                'kdPaket' => $row->kdPaket,
                'nmPaket' => $row->nmPaket,
                'tahun' => $row->tahun,
                'md5namatahun' => $row->md5namatahun,
                'bidang' => $this->db->get_where('groups',['id' => $row->bidang])->row('name'),
                'ruas' => $this->db->get_where('paket_detail', ['kdPaket' => $row->kdPaket]),
                'dpa' =>  $dpa,
                'last_querys' => $this->db->last_query(),
               
            );
            $this->template->load('template','paket/tbpaket_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paket'));
        }
    }

    public function intro(){
        $data = array(
            'title' => 'tbpaket',
            'button' => 'Create',
            'action' => site_url('paket/create_action'),
            'kdPaket' => set_value('kdPaket'),
            'nmPaket' => set_value('nmPaket'),
            'tahun' => set_value('tahun'),
            'md5namatahun' => set_value('md5namatahun'),
            'bidang' => set_value('bidang'),
        );
        $this->_render_page('paket/tb_paket_intro', $data);
    }

    public function create() 
    {
        $data = array(
            'title' => 'Paket',
            'button' => 'Create',
            'action' => site_url('paket/create_action'),
            'kdPaket' => set_value('kdPaket'),
            'nmPaket' => set_value('nmPaket'),
            'tahun' => set_value('tahun'),
            'md5namatahun' => set_value('md5namatahun'),
            'bidang' => set_value('bidang'),
            'kdPekerjaan' => set_value('kdPekerjaan'), 
	    );
        //$this->load->view('paket/tbpaket_form', $data);
        $this->_render_page('paket/tbpaket_form', $data);
        
    }
    public function multicreate() 
    {
        $data = array(
            'title' => 'Paket',
            'button' => 'Create',
            'action' => site_url('paket/multicreate_action'),
            'kdPaket' => set_value('kdPaket'),
            'nmPaket' => set_value('nmPaket'),
            'tahun' => set_value('tahun'),
            'md5namatahun' => set_value('md5namatahun'),
            'bidang' => set_value('bidang'),
	    );
        //$this->load->view('paket/tbpaket_form', $data);
        $this->_render_page('paket/tbpaket_form_multi', $data);
        
    }
    
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $kodePaket = 'pak_'.md5($this->input->post('nmPaket',TRUE).$this->input->post('tahun',TRUE));
            $data = array(
                'kdPaket' => $kodePaket,        
                'nmPaket' => $this->input->post('nmPaket',TRUE),
                'tahun' => $this->input->post('tahun',TRUE),
                'md5namatahun' => md5($this->input->post('nmPaket',TRUE).$this->input->post('tahun',TRUE)), //$this->input->post('md5namatahun',TRUE),
                'bidang' => $this->input->post('bidang',TRUE),
            );
            $ruasPekerjaan = array(
                'detailpaket' => 'dtl_'.$this->input->post('kdPekerjaan',TRUE),
                'kdPaket' => $kodePaket,        
                'kdPekerjaan' => $this->input->post('kdPekerjaan',TRUE),  
            ); 
            $this->Paket_model->insert($data);
            $this->db->insert('paket_detail', $ruasPekerjaan);
            $this->session->set_flashdata('message', 'Tambah Record Success');
            redirect(site_url('paket/read/'.$kodePaket)); //paket/read/$kodePaket
        }
    }


    public function multicreate_action() 
    {
        $this->_multi_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->multicreate();
        } else {
            $kodePaket = 'pak_'.md5($this->input->post('nmPaket',TRUE).$this->input->post('tahun',TRUE));
            $data = array(
                'kdPaket' => $kodePaket,        
                'nmPaket' => $this->input->post('nmPaket',TRUE),
                'tahun' => $this->input->post('tahun',TRUE),
                'md5namatahun' => md5($this->input->post('nmPaket',TRUE).$this->input->post('tahun',TRUE)), //$this->input->post('md5namatahun',TRUE),
                'bidang' => $this->input->post('bidang',TRUE),
                //'kdPekerjaan' => $this->input->post('kdPekerjaan',TRUE),
            );
           $kdPekerjaan =  $this->input->post('kdPekerjaan',TRUE);
           $ruasPekerjaan =array(); 
            foreach ($kdPekerjaan as $key => $val) {
                $ruasPekerjaan []= array(
                    'detailpaket' => 'dtl_'.$this->input->post('kdPekerjaan',TRUE)[$key],
                    'kdPaket' => $kodePaket,        
                    'kdPekerjaan' => $this->input->post('kdPekerjaan',TRUE)[$key],  
                );
            }
            $this->Paket_model->insert($data);
            $this->db->insert_batch('paket_detail', $ruasPekerjaan); // ruas pekerjaan
            $this->session->set_flashdata('message', 'Tambah Record Success '.$this->db->insert_id());
            redirect(site_url('paket/read/'.$kodePaket)); //paket/read/$kodePaket
        }
    }
    
    public function update($id) 
    {
        $row = $this->Paket_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'Edit Paket',
                'button' => 'Edit',
                'segment1' =>'',
                'segment2' =>'Paket',
                'segment3' =>'Edit',
                'action' => site_url('paket/update_action/'.$id),
                'kdPaket' => set_value('kdPaket', $row->kdPaket),
                'nmPaket' => set_value('nmPaket', $row->nmPaket),
                'tahun' => set_value('tahun', $row->tahun),
                'md5namatahun' => set_value('md5namatahun', $row->md5namatahun),
                'bidang' => set_value('bidang', $row->bidang),
            );
            $cekDetailPaket = $this->db->get_where('paket_detail' , ['kdPaket'=>$id])->num_rows();
            if($cekDetailPaket>1){
                $this->_render_page('paket/tbpaket_form_multi', $data);
            }else{
                $this->_render_page('paket/tbpaket_form', $data);
            } 

        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paket'));
        }
    }
    
    public function update_action() 
    {  
        $kdPekerjaan =  $this->input->post('kdPekerjaan',TRUE);
        if(is_array($kdPekerjaan)){
            $this->_multi_rules();
        }else{
            $this->_rules();
        }
        
        $idpaket =$this->input->post('kdPaket', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('kdPaket', TRUE));
            echo 'lol';
            die();
        } else {
            $data = array(
            'nmPaket' => $this->input->post('nmPaket',TRUE),
            'tahun' => $this->input->post('tahun',TRUE),
            //'md5namatahun' => $this->input->post('md5namatahun',TRUE),
            'bidang' => $this->input->post('bidang',TRUE),
        );
        /*
        * LOGIKA UPDATE PAKET 
        * HAPUS PAKET_DETAIL YANG MEMLIKI IDPAKET YG AKAN DIEDIT
        * LALU INSERT DATA DETAIL PAKET yang di input dari selek pekerjaan
        */
        $cekDetailPaket = $this->db->get_where('paket_detail' , ['kdPaket'=>$idpaket])->num_rows();
        
        $kdPekerjaan =  $this->input->post('kdPekerjaan',TRUE);
        
        if(is_array($kdPekerjaan)){
            $ruasPekerjaan =array(); 
            foreach ($kdPekerjaan as $key => $val) {
                $ruasPekerjaan []= array(
                    'detailpaket' => 'dtl_'.$this->input->post('kdPekerjaan',TRUE)[$key],
                    'kdPaket' =>$idpaket,        
                    'kdPekerjaan' => $this->input->post('kdPekerjaan',TRUE)[$key],  
                );   
            }
            if($cekDetailPaket>0){
                $this->db->delete('paket_detail', ['kdPaket'=>$idpaket]);
            } 
            $this->db->insert_batch('paket_detail', $ruasPekerjaan); // ruas pekerjaan   
        }

            $this->Paket_model->update($this->input->post('kdPaket', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('paket'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Paket_model->get_by_id($id);

        if ($row) {
            //delete paket
            $this->Paket_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('paket'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('paket'));
        }
    }

//delete Data_kontrak_addendum
    public function deleteAddendum($id) 
    {
        $row = $this->db->get_where('data_kontrak_addendum',['kdAddendum' => $id])->row();

        if ($row) {
            //$this->Data_kontrak_addendum_model->delete($id);
            $this->db->where('kdAddendum', $id);
            $this->db->delete('data_kontrak_addendum');
            $this->session->set_flashdata('message', 'Delete Record Success');
            $kdPaket = $this->uri->segment(4);
            redirect(site_url('paket/read/'.$kdPaket));
            //paket/read/
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_kontrak_addendum'));
        }
    }



    public function delete_jaminan($id) 
    {
        $row = $this->Data_jaminan_model->get_by_id($id);

        if ($row) {
            $this->Data_jaminan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function _rules() 
    {
        $this->form_validation->set_rules('nmPaket', 'nmpaket', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        //$this->form_validation->set_rules('md5namatahun', 'md5namatahun', 'trim|required');
        $this->form_validation->set_rules('bidang', 'bidang', 'trim|required');
        $this->form_validation->set_rules('kdPekerjaan', 'kd Pekerjaan', 'trim|required');

        //$this->form_validation->set_rules('kdPaket', 'kdPaket', 'trim|is_unique[tbpaket.kdPaket]');
        $this->form_validation->set_rules('kdPaket', 'kdPaket', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
    
    public function _multi_rules() 
    {
        $this->form_validation->set_rules('nmPaket', 'nmpaket', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        //$this->form_validation->set_rules('md5namatahun', 'md5namatahun', 'trim|required');
        $this->form_validation->set_rules('bidang', 'bidang', 'trim|required');
        $this->form_validation->set_rules('kdPekerjaan[]', 'kd Pekerjaan', 'trim|required');

        //$this->form_validation->set_rules('kdPaket', 'kdPaket', 'trim|is_unique[tbpaket.kdPaket]');
        $this->form_validation->set_rules('kdPaket', 'kdPaket', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function cek_paket_detail($id){
         $row = $this->db->get_where('paket_detail',['detailpaket' => 'dtl_'.$id])->num_rows();
        if($row>0){
            echo 1;
            return true;
        }else{
            echo 0;
            return false;
        }
       return false;
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

	foreach ($this->Paket_model->get_all() as $data) {
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

/* End of file Paket.php */
/* Location: ./application/controllers/Paket.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:20:41 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*============================================================================*/
