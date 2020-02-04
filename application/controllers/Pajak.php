<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pajak extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pajak_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        //$this->load->view('pajak/pajak_list');
        $this->template->load('template','pajak/pajak_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Pajak_model->json();
    }

    public function read($id) 
    {
        $row = $this->Pajak_model->get_by_id($id);
        if ($row) {
            $data = array(
                'title' => 'pajak',
                'id' => $row->id,
                'pasal' => $row->pasal,
                'jenis' => $row->jenis,
                'kegiatan' => $row->kegiatan,
                'jenisKegiatan' => $row->jenisKegiatan,
                'kualifikasi' => $row->kualifikasi,
                'potongan' => $row->potongan,
                'ket' => $row->ket,
	        );
            $this->load->view('pajak/pajak_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pajak'));
        }
    }

    public function create() 
    {
        $data = array(
            'title' => 'pajak',
            'button' => 'Create',
            'action' => site_url('pajak/create_action'),
	    'id' => set_value('id'),
	    'pasal' => set_value('pasal'),
	    'jenis' => set_value('jenis'),
	    'kegiatan' => set_value('kegiatan'),
	    'jenisKegiatan' => set_value('jenisKegiatan'),
	    'kualifikasi' => set_value('kualifikasi'),
	    'potongan' => set_value('potongan'),
	    'ket' => set_value('ket'),
	);
        //$this->load->view('pajak/pajak_form', $data);
        $this->_render_page('pajak/pajak_form', $data);
        
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'pasal' => $this->input->post('pasal',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'kegiatan' => $this->input->post('kegiatan',TRUE),
		'jenisKegiatan' => $this->input->post('jenisKegiatan',TRUE),
		'kualifikasi' => $this->input->post('kualifikasi',TRUE),
		'potongan' => $this->input->post('potongan',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Pajak_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pajak'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Pajak_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'pajak',
                'button' => 'Update',
                'action' => site_url('pajak/update_action'),
		'id' => set_value('id', $row->id),
		'pasal' => set_value('pasal', $row->pasal),
		'jenis' => set_value('jenis', $row->jenis),
		'kegiatan' => set_value('kegiatan', $row->kegiatan),
		'jenisKegiatan' => set_value('jenisKegiatan', $row->jenisKegiatan),
		'kualifikasi' => set_value('kualifikasi', $row->kualifikasi),
		'potongan' => set_value('potongan', $row->potongan),
		'ket' => set_value('ket', $row->ket),
	    );
            $this->_render_page('pajak/pajak_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pajak'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'pasal' => $this->input->post('pasal',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'kegiatan' => $this->input->post('kegiatan',TRUE),
		'jenisKegiatan' => $this->input->post('jenisKegiatan',TRUE),
		'kualifikasi' => $this->input->post('kualifikasi',TRUE),
		'potongan' => $this->input->post('potongan',TRUE),
		'ket' => $this->input->post('ket',TRUE),
	    );

            $this->Pajak_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pajak'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Pajak_model->get_by_id($id);

        if ($row) {
            $this->Pajak_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pajak'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pajak'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('pasal', 'pasal', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');
	$this->form_validation->set_rules('jenisKegiatan', 'jeniskegiatan', 'trim|required');
	$this->form_validation->set_rules('kualifikasi', 'kualifikasi', 'trim|required');
	$this->form_validation->set_rules('potongan', 'potongan', 'trim|required|numeric');
	$this->form_validation->set_rules('ket', 'ket', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pajak.xls";
        $judul = "pajak";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Pasal");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "JenisKegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kualifikasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Potongan");
	xlsWriteLabel($tablehead, $kolomhead++, "Ket");

	foreach ($this->Pajak_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pasal);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenisKegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kualifikasi);
	    xlsWriteNumber($tablebody, $kolombody++, $data->potongan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ket);

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

/* End of file Pajak.php */
/* Location: ./application/controllers/Pajak.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 17:27:29 */
/* http://harviacode.com */
/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*============================================================================*/
