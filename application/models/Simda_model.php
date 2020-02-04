<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Simda_model extends CI_Model
{

    public $table = 'simda';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id,COL1,COL2,COL3,COL4,COL5,COL6,COL7,COL8,COL9,COL10,COL11,COL12,COL13,COL14,COL15,COL16,COL17,COL18,COL19,COL20,COL21,COL22,COL23,COL24,COL25,COL26,COL27,COL28,COL29,COL30,COL31,COL32,COL33,COL34,COL35,COL36,COL37,COL38,COL39,COL40,tglDPA,noDPA');
        $this->datatables->from('simda');
        //add this line for join
        //$this->datatables->join('table2', 'simda.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('simda_test/read/$1'),'Read')." | ".anchor(site_url('simda_test/update/$1'),'Update')." | ".anchor(site_url('simda_test/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
    }

	 // datatables
	 function search_data() {
        $this->datatables->select('id,COL1,COL2,COL3,COL4,COL5,COL6,COL7,COL8,COL9,COL10,COL11,COL12,COL13,COL14,COL15,COL16,COL17,COL18,COL19,COL20,COL21,COL22,COL23,COL24,COL25,COL26,COL27,COL28,COL29,COL30,COL31,COL32,COL33,COL34,COL35,COL36,COL37,COL38,COL39,COL40,tglDPA,noDPA');
        $this->datatables->from('simda');
        //add this line for join
        //$this->datatables->join('table2', 'simda.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('simda_test/read/$1'),'Read')." | ".anchor(site_url('simda_test/update/$1'),'Update')." | ".anchor(site_url('simda_test/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        return $this->datatables->generate();
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
        $this->db->like('id', $q);
	$this->db->or_like('COL1', $q);
	$this->db->or_like('COL2', $q);
	$this->db->or_like('COL3', $q);
	$this->db->or_like('COL4', $q);
	$this->db->or_like('COL5', $q);
	$this->db->or_like('COL6', $q);
	$this->db->or_like('COL7', $q);
	$this->db->or_like('COL8', $q);
	$this->db->or_like('COL9', $q);
	$this->db->or_like('COL10', $q);
	$this->db->or_like('COL11', $q);
	$this->db->or_like('COL12', $q);
	$this->db->or_like('COL13', $q);
	$this->db->or_like('COL14', $q);
	$this->db->or_like('COL15', $q);
	$this->db->or_like('COL16', $q);
	$this->db->or_like('COL17', $q);
	$this->db->or_like('COL18', $q);
	$this->db->or_like('COL19', $q);
	$this->db->or_like('COL20', $q);
	$this->db->or_like('COL21', $q);
	$this->db->or_like('COL22', $q);
	$this->db->or_like('COL23', $q);
	$this->db->or_like('COL24', $q);
	$this->db->or_like('COL25', $q);
	$this->db->or_like('COL26', $q);
	$this->db->or_like('COL27', $q);
	$this->db->or_like('COL28', $q);
	$this->db->or_like('COL29', $q);
	$this->db->or_like('COL30', $q);
	$this->db->or_like('COL31', $q);
	$this->db->or_like('COL32', $q);
	$this->db->or_like('COL33', $q);
	$this->db->or_like('COL34', $q);
	$this->db->or_like('COL35', $q);
	$this->db->or_like('COL36', $q);
	$this->db->or_like('COL37', $q);
	$this->db->or_like('COL38', $q);
	$this->db->or_like('COL39', $q);
	$this->db->or_like('COL40', $q);
	$this->db->or_like('tglDPA', $q);
	$this->db->or_like('noDPA', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('COL1', $q);
	$this->db->or_like('COL2', $q);
	$this->db->or_like('COL3', $q);
	$this->db->or_like('COL4', $q);
	$this->db->or_like('COL5', $q);
	$this->db->or_like('COL6', $q);
	$this->db->or_like('COL7', $q);
	$this->db->or_like('COL8', $q);
	$this->db->or_like('COL9', $q);
	$this->db->or_like('COL10', $q);
	$this->db->or_like('COL11', $q);
	$this->db->or_like('COL12', $q);
	$this->db->or_like('COL13', $q);
	$this->db->or_like('COL14', $q);
	$this->db->or_like('COL15', $q);
	$this->db->or_like('COL16', $q);
	$this->db->or_like('COL17', $q);
	$this->db->or_like('COL18', $q);
	$this->db->or_like('COL19', $q);
	$this->db->or_like('COL20', $q);
	$this->db->or_like('COL21', $q);
	$this->db->or_like('COL22', $q);
	$this->db->or_like('COL23', $q);
	$this->db->or_like('COL24', $q);
	$this->db->or_like('COL25', $q);
	$this->db->or_like('COL26', $q);
	$this->db->or_like('COL27', $q);
	$this->db->or_like('COL28', $q);
	$this->db->or_like('COL29', $q);
	$this->db->or_like('COL30', $q);
	$this->db->or_like('COL31', $q);
	$this->db->or_like('COL32', $q);
	$this->db->or_like('COL33', $q);
	$this->db->or_like('COL34', $q);
	$this->db->or_like('COL35', $q);
	$this->db->or_like('COL36', $q);
	$this->db->or_like('COL37', $q);
	$this->db->or_like('COL38', $q);
	$this->db->or_like('COL39', $q);
	$this->db->or_like('COL40', $q);
	$this->db->or_like('tglDPA', $q);
	$this->db->or_like('noDPA', $q);
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






/* End of file Simda_model.php */
/* Location: ./application/models/Simda_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 04:56:21 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/

