<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rpp_model extends CI_Model
{

    public $table = 't_rpp';
    public $id = 'id_rpp';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_rpp,judul_rpp,id_guru,id_matpel,status_persetujuan,catatan_revisi,tanggal_upload');
        $this->datatables->from('t_rpp');
        //add this line for join
        //$this->datatables->join('table2', 't_rpp.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('datarpp/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('datarpp/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('datarpp/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_rpp');
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
        $this->db->like('id_rpp', $q);
	$this->db->or_like('judul_rpp', $q);
	$this->db->or_like('id_guru', $q);
	$this->db->or_like('id_matpel', $q);
	$this->db->or_like('status_persetujuan', $q);
	$this->db->or_like('catatan_revisi', $q);
	$this->db->or_like('tanggal_upload', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_rpp', $q);
	$this->db->or_like('judul_rpp', $q);
	$this->db->or_like('id_guru', $q);
	$this->db->or_like('id_matpel', $q);
	$this->db->or_like('status_persetujuan', $q);
	$this->db->or_like('catatan_revisi', $q);
	$this->db->or_like('tanggal_upload', $q);
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
    //get data guru
    function show_data_guru()
    {
        $this->db->select("*");
        $this->db->from('t_guru');
        return $this->db->get()->result();
    }
    function show_data_matpel()
    {
        $this->db->select("*");
        $this->db->from('t_matpel');
        return $this->db->get()->result();
    }

}

/* End of file Rpp_model.php */
/* Location: ./application/models/Rpp_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-07-03 04:20:45 */
/* http://harviacode.com */