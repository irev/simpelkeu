<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_realisasi_model extends CI_Model
{

    public $table = 'data_realisasi';
    public $id = 'kdRealisasi';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('kdRealisasi', $q);
	$this->db->or_like('ke', $q);
	$this->db->or_like('progres', $q);
	$this->db->or_like('fisik', $q);
	$this->db->or_like('potMCLALU', $q);
	$this->db->or_like('potUMK', $q);
	$this->db->or_like('potRETENSI', $q);
	$this->db->or_like('nilaiBAP', $q);
	$this->db->or_like('pajakPPH', $q);
	$this->db->or_like('pajakPPN', $q);
	$this->db->or_like('noSPP', $q);
	$this->db->or_like('tglSPP', $q);
	$this->db->or_like('noSPM', $q);
	$this->db->or_like('tglSPM', $q);
	$this->db->or_like('JenisTagihan', $q);
	$this->db->or_like('tglTAGIHAN', $q);
	$this->db->or_like('noTAGIHAN', $q);
	$this->db->or_like('kdpaket', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kdRealisasi', $q);
	$this->db->or_like('ke', $q);
	$this->db->or_like('progres', $q);
	$this->db->or_like('fisik', $q);
	$this->db->or_like('potMCLALU', $q);
	$this->db->or_like('potUMK', $q);
	$this->db->or_like('potRETENSI', $q);
	$this->db->or_like('nilaiBAP', $q);
	$this->db->or_like('pajakPPH', $q);
	$this->db->or_like('pajakPPN', $q);
	$this->db->or_like('noSPP', $q);
	$this->db->or_like('tglSPP', $q);
	$this->db->or_like('noSPM', $q);
	$this->db->or_like('tglSPM', $q);
	$this->db->or_like('JenisTagihan', $q);
	$this->db->or_like('tglTAGIHAN', $q);
	$this->db->or_like('noTAGIHAN', $q);
	$this->db->or_like('kdpaket', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}






/* End of file Data_realisasi_model.php */
/* Location: ./application/models/Data_realisasi_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-28 09:40:53 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 28 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/

