<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_pegawai_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('master_pegawai/master_pegawai_list');
        $this->template->load('template','master_pegawai/master_pegawai_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Master_pegawai_model->json();
    }

    public function read($id) 
    {
        $row = $this->Master_pegawai_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'master_pegawai',
		'id_peg' => $row->id_peg,
		'nama' => $row->nama,
		'nip' => $row->nip,
		'jabatan' => $row->jabatan,
		'pendidikan' => $row->pendidikan,
		'jurusan' => $row->jurusan,
		'pangkat' => $row->pangkat,
		'golongan' => $row->golongan,
		'ruang' => $row->ruang,
		'tempat' => $row->tempat,
		'tanggal_lahir' => $row->tanggal_lahir,
		'tgl_aktif' => $row->tgl_aktif,
		'status' => $row->status,
		'date_update' => $row->date_update,
	    );
            $this->load->view('master_pegawai/master_pegawai_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_pegawai'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'master_pegawai',
            'button' => 'Create',
            'action' => site_url('master_pegawai/create_action'),
	    'id_peg' => set_value('id_peg'),
	    'nama' => set_value('nama'),
	    'nip' => set_value('nip'),
	    'jabatan' => set_value('jabatan'),
	    'pendidikan' => set_value('pendidikan'),
	    'jurusan' => set_value('jurusan'),
	    'pangkat' => set_value('pangkat'),
	    'golongan' => set_value('golongan'),
	    'ruang' => set_value('ruang'),
	    'tempat' => set_value('tempat'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'tgl_aktif' => set_value('tgl_aktif'),
	    'status' => set_value('status'),
	    'date_update' => set_value('date_update'),
	);
        //$this->load->view('master_pegawai/master_pegawai_form', $data);
        $this->_render_page('master_pegawai/master_pegawai_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'nip' => $this->input->post('nip',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'jurusan' => $this->input->post('jurusan',TRUE),
		'pangkat' => $this->input->post('pangkat',TRUE),
		'golongan' => $this->input->post('golongan',TRUE),
		'ruang' => $this->input->post('ruang',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'tgl_aktif' => $this->input->post('tgl_aktif',TRUE),
		'status' => $this->input->post('status',TRUE),
		'date_update' => $this->input->post('date_update',TRUE),
	    );

            $this->Master_pegawai_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_pegawai'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_pegawai_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'master_pegawai',
                'button' => 'Update',
                'action' => site_url('master_pegawai/update_action'),
		'id_peg' => set_value('id_peg', $row->id_peg),
		'nama' => set_value('nama', $row->nama),
		'nip' => set_value('nip', $row->nip),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'pendidikan' => set_value('pendidikan', $row->pendidikan),
		'jurusan' => set_value('jurusan', $row->jurusan),
		'pangkat' => set_value('pangkat', $row->pangkat),
		'golongan' => set_value('golongan', $row->golongan),
		'ruang' => set_value('ruang', $row->ruang),
		'tempat' => set_value('tempat', $row->tempat),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'tgl_aktif' => set_value('tgl_aktif', $row->tgl_aktif),
		'status' => set_value('status', $row->status),
		'date_update' => set_value('date_update', $row->date_update),
	    );
            $this->_render_page('master_pegawai/master_pegawai_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_pegawai'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_peg', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'nip' => $this->input->post('nip',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'pendidikan' => $this->input->post('pendidikan',TRUE),
		'jurusan' => $this->input->post('jurusan',TRUE),
		'pangkat' => $this->input->post('pangkat',TRUE),
		'golongan' => $this->input->post('golongan',TRUE),
		'ruang' => $this->input->post('ruang',TRUE),
		'tempat' => $this->input->post('tempat',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'tgl_aktif' => $this->input->post('tgl_aktif',TRUE),
		'status' => $this->input->post('status',TRUE),
		'date_update' => $this->input->post('date_update',TRUE),
	    );

            $this->Master_pegawai_model->update($this->input->post('id_peg', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_pegawai'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_pegawai_model->get_by_id($id);

        if ($row) {
            $this->Master_pegawai_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_pegawai'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('nip', 'nip', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('pendidikan', 'pendidikan', 'trim|required');
	$this->form_validation->set_rules('jurusan', 'jurusan', 'trim|required');
	$this->form_validation->set_rules('pangkat', 'pangkat', 'trim|required');
	$this->form_validation->set_rules('golongan', 'golongan', 'trim|required');
	$this->form_validation->set_rules('ruang', 'ruang', 'trim|required');
	$this->form_validation->set_rules('tempat', 'tempat', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('tgl_aktif', 'tgl aktif', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');
	$this->form_validation->set_rules('date_update', 'date update', 'trim|required');

	$this->form_validation->set_rules('id_peg', 'id_peg', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_pegawai.xls";
        $judul = "master_pegawai";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Nip");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Pendidikan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jurusan");
	xlsWriteLabel($tablehead, $kolomhead++, "Pangkat");
	xlsWriteLabel($tablehead, $kolomhead++, "Golongan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ruang");
	xlsWriteLabel($tablehead, $kolomhead++, "Tempat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Lahir");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Aktif");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Date Update");

	foreach ($this->Master_pegawai_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pendidikan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jurusan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pangkat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->golongan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ruang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tempat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_lahir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_aktif);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->date_update);

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

/* End of file Master_pegawai.php */
/* Location: ./application/controllers/Master_pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-20 21:38:37 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 20 Jan 2020 */
/*============================================================================*/
