<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public $table = 'menu';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('menu.id as id ,menu.name as name,link,icon,is_active,is_parent,group,groups.name as grp,groups.id as idg, groups.name as nameg, (SELECT `sMenu`.`name` FROM `menu` as `sMenu` WHERE `sMenu`.`id` = `menu`.`is_parent`) as name_parent');
        $this->datatables->from('menu');
        //add this line for join
        $this->datatables->join('groups', 'menu.group = groups.id');
        $this->datatables->edit_column('link', '<a href="'.base_url().'$1" target="_blank" title="Menu $1"><i class="fa fa-link"></i> $1</a>','link');
        $this->datatables->edit_column('icon', '<i class="$1"></i> $1','icon');
        $this->datatables->edit_column('is_active', '<a href="menu/active/$2" class="btn btn-xs activ_$1"><i class="$1 $2"></i> $1</a>','is_active, id');
        $this->datatables->edit_column('is_parent', '$1 $2' ,'is_parent, name_parent');
        $this->datatables->edit_column('group', '# $1. $2','group, grp');
        $this->datatables->add_column('action', anchor(site_url('menu/read/$1'),'Read',['class'=>'btn btn-xs btn-primary'])." | ".anchor(site_url('menu/update/$1'),'Update', ['class'=>'btn btn-xs btn-warning'])." | ".anchor(site_url('menu/delete/$1'),'Delete',['class'=>'btn btn-xs btn-danger','onclick'=>'javasciprt: return confirm(\'Are You Sure ?\')']), 'id');
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
	$this->db->or_like('name', $q);
	$this->db->or_like('link', $q);
	$this->db->or_like('icon', $q);
	$this->db->or_like('is_active', $q);
	$this->db->or_like('is_parent', $q);
	$this->db->or_like('group', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('name', $q);
	$this->db->or_like('link', $q);
	$this->db->or_like('icon', $q);
	$this->db->or_like('is_active', $q);
	$this->db->or_like('is_parent', $q);
	$this->db->or_like('group', $q);
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






/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-16 20:08:23 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 16 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/

