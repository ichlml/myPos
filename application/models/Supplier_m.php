<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select();
        $this->db->from('supplier');
        if ($id != null) {
            $this->db->where('supplier_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function save($post)
    {
        $data = [
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'desc' => $this->input->post('desc')
        ];

        $this->db->insert('supplier', $data);
    }

    public function update($post)
    {
        $data = [
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'desc' => $this->input->post('desc'),
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('supplier_id', $this->input->post('supplier_id'));
        $this->db->update('supplier', $data);
    }

    public function cek_data($name)
    {
        $this->db->select();
        $this->db->from('supplier');
        $this->db->where('name', $name);
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('supplier_id', $id);
        $this->db->delete('supplier');
    }

    public function req_stok() {
        return $this->db->query("SELECT  *,p_item.name as nm_brg, p_item.stock, supplier.name as nm_supp, supplier.address as almt, t_stock.date as tanggal, t_stock.qty as jml_perm, p_unit.name as kategori FROM p_item inner join p_unit using(unit_id) inner join t_stock using(item_id) inner join supplier using(supplier_id) WHERE status_stock = 'minta' ");
    }

}
