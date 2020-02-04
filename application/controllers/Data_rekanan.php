<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_rekanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_rekanan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('data_rekanan/data_rekanan_list');
        $this->template->load('template','data_rekanan/data_rekanan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Data_rekanan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Data_rekanan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'Data Rekanan',
		'id' => $row->id,
		'Type' => $row->Type,
		'perusahaan' => $row->perusahaan,
		'alamat' => $row->alamat,
		'npwp' => $row->npwp,
		'bank' => $row->bank,
		'rekening' => $row->rekening,
        'direktur' => $row->direktur,
        'jabatan' => $row->jabatan,
		'bentuk' => $row->bentuk,
		'kdpaket' => $row->kdpaket,
	    );
            $this->load->view('data_rekanan/data_rekanan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_rekanan'));
        }
    }


    public function paket($id){
        //pak_0b7750b2bcebbbbaed389278cba78985
        $row = $this->db->get_where('data_rekanan',['kdpaket'=>$id])->num_rows();
        $idrekanan = $this->db->get_where('data_rekanan',['kdpaket'=>$id])->row('id');
        //echo $this->db->last_query(); // Bugging
        if($row < 0){
            $this->create();
        }else{
            $this->update($idrekanan);
        }
        

    }


    public function create() 
    {
        $kdpaket = $this->uri->segment(3);
        $data = array(
            'title' => 'Data Rekanan',
            'button' => 'Simpan',
            'action' => site_url('data_rekanan/create_action/'.$kdpaket),
            'headerBox'=>'Data Rekanan',
            'headButton'=>'<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                           <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>',
            'footer'=> '<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        <a href="'.site_url('paket/read/'.$kdpaket).'" class="btn btn-md btn-danger pull-right"><i class="fa fa-arrow-left"></i> Kembali</a></form>' , 
	    'id' => set_value('id'),
	    'Type' => set_value('Type'),
	    'perusahaan' => set_value('perusahaan'),
	    'alamat' => set_value('alamat'),
	    'npwp' => set_value('npwp'),
	    'bank' => set_value('bank'),
	    'rekening' => set_value('rekening'),
	    'direktur' => set_value('direktur'),
	    'jabatan' => set_value('jabatan'),
	    'bentuk' => set_value('Type'),
	    'kdpaket' => set_value('kdpaket'),
	);
        //$this->load->view('data_rekanan/data_rekanan_form', $data);
        $this->_render_page('data_rekanan/data_rekanan_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $id = 'rek_'.md5($this->input->post('kdpaket',TRUE)); // id rekanan MD5
            $data = array(
                'id' => $id, //$this->input->post('id',TRUE),
                'Type' => $this->input->post('Type',TRUE),
                'perusahaan' => $this->input->post('perusahaan',TRUE),
                'alamat' => $this->input->post('alamat',TRUE),
                'npwp' => $this->input->post('npwp',TRUE),
                'bank' => $this->input->post('bank',TRUE),
                'rekening' => $this->input->post('rekening',TRUE),
                'direktur' => $this->input->post('direktur',TRUE),
                'jabatan' => $this->input->post('jabatan',TRUE),
                'bentuk' => $this->input->post('Type',TRUE),
                'kdpaket' => $this->input->post('kdpaket',TRUE),
	        );

            $this->Data_rekanan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('paket/read/'.$id));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Data_rekanan_model->get_by_id($id);
        //echo print_r($row); //buging
        //echo ' '.$id; //buging
        if ($row) {
            $data = array(
                'title' => 'Data Rekanan',
                'button' => 'Edit',
                'action' => site_url('data_rekanan/update_action'),
                'headerBox'=>'Data Rekanan',
                'headButton'=>'<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>',
                'footer'=> '<button type="submit" class="btn btn-md btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            <a href="'.site_url('paket/read/'.$row->kdpaket).'" class="btn btn-md btn-danger pull-right"><i class="fa fa-arrow-left"></i> Kembali</a></form>' , 
                'id' => set_value('id', $row->id),
                'Type' => set_value('Type', $row->Type),
                'perusahaan' => set_value('perusahaan', $row->perusahaan),
                'alamat' => set_value('alamat', $row->alamat),
                'npwp' => set_value('npwp', $row->npwp),
                'bank' => set_value('bank', $row->bank),
                'rekening' => set_value('rekening', $row->rekening),
                'direktur' => set_value('direktur', $row->direktur),
                'jabatan' => set_value('jabatan', $row->jabatan),
                'bentuk' => set_value('bentuk', $row->bentuk),
                'kdpaket' => set_value('kdpaket', $row->kdpaket),
	    );
            $this->_render_page('data_rekanan/data_rekanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            echo $this->db->last_query();
           // redirect(site_url('paket/read/'.$row->kdpaket));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'Type' => $this->input->post('Type',TRUE),
		'perusahaan' => $this->input->post('perusahaan',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'npwp' => $this->input->post('npwp',TRUE),
		'bank' => $this->input->post('bank',TRUE),
		'rekening' => $this->input->post('rekening',TRUE),
		'direktur' => $this->input->post('direktur',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'bentuk' => $this->input->post('Type',TRUE),
		'kdpaket' => $this->input->post('kdpaket',TRUE),
	    );

            $this->Data_rekanan_model->update($this->input->post('kdpaket', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            //echo $this->db->last_query();
            redirect(site_url('paket/read/'.$this->input->post('kdpaket',TRUE)));
            //echo site_url('paket/read/'.$this->input->post('kdpaket',TRUE));
            
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Data_rekanan_model->get_by_id($id);

        if ($row) {
            $this->Data_rekanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_rekanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_rekanan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('Type', 'type', 'trim|required');
	$this->form_validation->set_rules('perusahaan', 'perusahaan', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('npwp', 'npwp', 'trim|required');
	$this->form_validation->set_rules('bank', 'bank', 'trim|required');
	$this->form_validation->set_rules('rekening', 'rekening', 'trim|required');
	$this->form_validation->set_rules('direktur', 'direktur', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('bentuk', 'bentuk', 'trim');
	$this->form_validation->set_rules('kdpaket', 'kdpaket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "data_rekanan.xls";
        $judul = "data_rekanan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Perusahaan");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Npwp");
	xlsWriteLabel($tablehead, $kolomhead++, "bank");
	xlsWriteLabel($tablehead, $kolomhead++, "Rekening");
	xlsWriteLabel($tablehead, $kolomhead++, "Direktur");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Type");
	xlsWriteLabel($tablehead, $kolomhead++, "Kdpaket");

	foreach ($this->Data_rekanan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Type);
	    xlsWriteLabel($tablebody, $kolombody++, $data->perusahaan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->npwp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->bank);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rekening);
	    xlsWriteLabel($tablebody, $kolombody++, $data->direktur);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
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

/* End of file Data_rekanan.php */
/* Location: ./application/controllers/Data_rekanan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 05:02:21 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*============================================================================*/