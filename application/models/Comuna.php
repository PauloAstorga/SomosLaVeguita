<?php

class Comuna extends CI_Model {

    public $table = 'comuna';
    public $table_id = 'id';

    public function __construct() {

    }

    function find($id){
        $this->db->select();
        $this->db->from($this->table);
        $this->db->where($this->table_id, $id);

        $query = $this->db->get();
        return $query->row();
    }

    function findAll(){
        $this->db->select();
        $this->db->from($this->table);

        $query = $this->db->get();
        return $query->result();
    }

    function insert($data){
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    function update($id, $data){
        $this->db->update($this->table, $data);
        $this->db->where($this->table_id, $id);
    }

    function delete($id){
        $this->db->delete($this->table);
        $this->db->where($this->table_id, $id);
    }

}