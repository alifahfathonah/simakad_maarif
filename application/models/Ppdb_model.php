<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ppdb_model extends CI_Model
{

    public $table = 't_ppdb';
    public $id = 'id_pendaftaran';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_pendaftaran,nama_lengkap,tempat_lahir,tanggal_lahir,nisn,asal_sekolah,alamat,no_telp_siswa,nama_wali,no_telp_wali,file_ijazah,file_skhun,file_foto,status_penerimaan');
        $this->datatables->from('t_ppdb');
       // $this->datatables->where('status_penerimaan','Ditolak');

        //add this line for join
        //$this->datatables->join('table2', 't_ppdb.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('ppdb/terima/$1'),'<i class="fa fa-check" aria-hidden="true"></i>', array('class' => 'btn btn-success btn-sm'))." 
            ".anchor(site_url('ppdb/update/$1'),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('ppdb/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_pendaftaran');
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
        $this->db->like('id_pendaftaran', $q);
	$this->db->or_like('nama_lengkap', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('nisn', $q);
	$this->db->or_like('asal_sekolah', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_telp_siswa', $q);
	$this->db->or_like('nama_wali', $q);
	$this->db->or_like('no_telp_wali', $q);
	$this->db->or_like('file_ijazah', $q);
	$this->db->or_like('file_skhun', $q);
	$this->db->or_like('file_foto', $q);
	$this->db->or_like('status_penerimaan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_pendaftaran', $q);
	$this->db->or_like('nama_lengkap', $q);
	$this->db->or_like('tempat_lahir', $q);
	$this->db->or_like('tanggal_lahir', $q);
	$this->db->or_like('nisn', $q);
	$this->db->or_like('asal_sekolah', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('no_telp_siswa', $q);
	$this->db->or_like('nama_wali', $q);
	$this->db->or_like('no_telp_wali', $q);
	$this->db->or_like('file_ijazah', $q);
	$this->db->or_like('file_skhun', $q);
	$this->db->or_like('file_foto', $q);
	$this->db->or_like('status_penerimaan', $q);
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

/* End of file Ppdb_model.php */
/* Location: ./application/models/Ppdb_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-04-21 22:37:19 */
/* http://harviacode.com */