<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paket_model extends CI_Model
{

    public $table = 'tbpaket';
    public $id = 'kdPaket';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('kdPaket,nmPaket,tahun,md5namatahun,groups.description as bidang');
        $this->datatables->from('tbpaket');
        //add this line for join
        $this->datatables->join('groups', 'tbpaket.bidang = groups.id');       
        $this->datatables->add_column('pagu','0');
        $this->datatables->add_column('action', anchor(site_url('paket/read/$1'),'Read')." | ".anchor(site_url('paket/update/$1'),'Update')." | ".anchor(site_url('paket/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kdPaket');
        return $this->datatables->generate();
        //echo $this->db->last_query();
    }

    function jsonByBidang($bidang) {
        $this->datatables->select('
        tbpaket.nmPaket as nmPaket, tbpaket.tahun as tahun , tbpaket.kdPaket as kdPaket, groups.name as bidang , paket_detail.kdPekerjaan, 
       (SELECT SUM(simda.COL40) as pagu FROM simda
       JOIN paket_detail on paket_detail.kdPekerjaan=simda.id
       WHERE paket_detail.kdPaket=tbpaket.kdPaket
       ) as pagu');
        $this->datatables->from('tbpaket');
        //add this line for join
        $this->datatables->join('paket_detail', 'paket_detail.kdpaket=tbpaket.kdPaket','LEFT');
        $this->datatables->join('groups', 'tbpaket.bidang = groups.id');
        $this->datatables->where('tbpaket.bidang', $bidang);
        $this->datatables->group_by('tbpaket.kdPaket');
        $this->datatables->add_column('action', anchor(site_url('paket/read/$1'),'Read')." | ".anchor(site_url('paket/update/$1'),'Update')." | ".anchor(site_url('paket/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'kdPaket');
        //$this->datatables->add_column('Query', $this->db->last_query());
        return $this->datatables->generate();
    }

    // data paket dan pagu
    function jsonPaket(){
                /*SELECT tbpaket.*, paket_detail.kdPekerjaan, 
                (SELECT SUM(simda.COL40) as pagu FROM simda
                JOIN paket_detail on paket_detail.kdPekerjaan=simda.id
                WHERE paket_detail.kdPaket=tbpaket.kdPaket
                ) as Pagu
                FROM `tbpaket` 
                LEFT JOIN paket_detail on paket_detail.kdpaket=tbpaket.kdPaket
                GROUP by tbpaket.kdPaket
                */
                $this->datatables->select('
                 tbpaket.nmPaket as nmPaket, tbpaket.tahun as tahun , tbpaket.kdPaket as kdPaket, groups.name as bidang , paket_detail.kdPekerjaan, 
                (SELECT SUM(simda.COL40) as pagu FROM simda
                JOIN paket_detail on paket_detail.kdPekerjaan=simda.id
                WHERE paket_detail.kdPaket=tbpaket.kdPaket
                ) as pagu                
                ');
                $this->datatables->from('tbpaket');
                $this->datatables->join('paket_detail', 'paket_detail.kdpaket=tbpaket.kdPaket','LEFT');
                $this->datatables->join('groups', 'tbpaket.bidang = groups.id');
                $this->datatables->group_by('tbpaket.kdPaket');
                //$this->datatables->add_column('action', anchor(site_url('paket/read/$1'),'Read',['class' => 'btn btn-xs btn-primary'])." | ".anchor(site_url('paket/update/$1'),'Update',['class' => 'btn btn-xs btn-warning'] )." | ".anchor(site_url('paket/delete/$1'),'Delete',['class'=>'btn btn-xs btn-danger','onclick'=>'javasciprt: return confirm(\'Anda Yakin menghapus data \n $2 ?\')']), 'kdPaket, nmPaket');
                $this->datatables->add_column('action', anchor(site_url('paket/read/$1'),'Read',['class' => 'btn btn-xs btn-primary'])." | ".anchor(site_url('paket/update/$1'),'Update',['class' => 'btn btn-xs btn-warning'] )." | ".anchor(site_url('paket/delete/$1'),'Delete',['class'=>'btn btn-xs btn-danger','onclick'=>'javasciprt: return konfirmasiDelete(\'$2\')']), 'kdPaket, nmPaket');
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
        $this->db->like('kdPaket', $q);
        $this->db->or_like('nmPaket', $q);
        $this->db->or_like('tahun', $q);
        $this->db->or_like('md5namatahun', $q);
        $this->db->or_like('bidang', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('kdPaket', $q);
        $this->db->or_like('nmPaket', $q);
        $this->db->or_like('tahun', $q);
        $this->db->or_like('md5namatahun', $q);
        $this->db->or_like('bidang', $q);
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
        $this->delete_kontrak($id);
        $this->delete_jaminan($id);
        $this->delete_pejabat($id);
        $this->delete_rekanan($id);
        $this->delete_paket_detail($id);
        /// delete paket
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    private function delete_paket_detail($id)
    {
        $this->db->where('kdpaket', $id);
        $this->db->delete('paket_detail');
    }

    // delete kontrak
    private function delete_kontrak($id)
    {
        $idkontrak = $this->db->get_where('data_kontrak', ['kdpaket'=>$id])->row('kdKontrak');
        // delete addendum
        $this->db->where('kdKontrak',$idkontrak);
        $this->db->delete('data_kontrak_addendum');
        // delete kontrak
        $this->db->where('kdpaket', $id);
        $this->db->delete('data_kontrak');

    }
   
    private function delete_jaminan($id)
    {
        $this->db->where('kdpaket', $id);
        $this->db->delete('data_jaminan');
    }

    private function delete_pejabat($id)
    {
        $this->db->where('kdpaket', $id);
        $this->db->delete('data_pejabat');
    }

    private function delete_rekanan($id)
    {
        $this->db->where('kdpaket', $id);
        $this->db->delete('data_rekanan');
    }


}






/* End of file Paket_model.php */
/* Location: ./application/models/Paket_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:20:41 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/

