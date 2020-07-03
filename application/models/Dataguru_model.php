<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dataguru_model extends CI_Model
{

    public $table = 't_guru';
    public $id = 'id_guru';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_guru,nipy,nik,nama_guru,jenis_kelamin,tanggal_lahir,induk');
        $this->datatables->from('t_guru');
        //add this line for join
        //$this->datatables->join('table2', 't_guru.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('dataguru/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('dataguru/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('dataguru/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_guru');
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
        $this->db->like('id_guru', $q);
	$this->db->or_like('nipy', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nama_guru', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('induk', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_guru', $q);
	$this->db->or_like('nipy', $q);
	$this->db->or_like('nik', $q);
	$this->db->or_like('nama_guru', $q);
	$this->db->or_like('jenis_kelamin', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('induk', $q);
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

/* End of file Dataguru_model.php */
/* Location: ./application/models/Dataguru_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-28 13:57:35 */
/* http://harviacode.com */