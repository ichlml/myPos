<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_m extends CI_Model
{
    public function get_stock($id = null)
    {
        $this->db->select('*');
        $this->db->from('t_stock');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function req_stok() {
        return $this->db->query("SELECT  *,p_item.name as nm_brg, p_item.stock, supplier.name as nm_supp, supplier.address as almt FROM p_item inner join t_stock using(item_id) inner join supplier using(supplier_id) WHERE status_stock = 'proses' ");
    }

    public function validasi_req($post) {
        $this->db->set('status_stock','proses');
        $this->db->where('stock_id', $post['stock_id']);
        return $this->db->update('t_stock');
    }

    public function validasi_($post) {
        $this->db->set('status_stock','diterima');
        $this->db->where('stock_id', $post['stock_id']);
        return $this->db->update('t_stock');
    }

    public function get($id = null)
    {
        $this->db->select('t_stock.*,p_item.barcode, p_item.name as item_name, supplier.name as supplier_name');
        $this->db->from('t_stock');
        $this->db->join('p_item', 'p_item.item_id=t_stock.item_id');
        $this->db->join('supplier', 'supplier.supplier_id=t_stock.supplier_id', 'left');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_out()
    {
        $this->db->select('t_stock.*,p_item.barcode, p_item.name as item_name, supplier.name as supplier_name');
        $this->db->from('t_stock');
        $this->db->join('p_item', 'p_item.item_id=t_stock.item_id');
        $this->db->join('supplier', 'supplier.supplier_id=t_stock.supplier_id', 'left');
        $this->db->where('type', 'out');
        $query = $this->db->get();
        return $query;
    }

    public function add_stock_in($post)
    {
        $data = [
            'item_id' => $post['item_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier'] == null ? null : $post['supplier'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->insert('t_stock', $data);
    }

    public function prosesminta($post)
    {
        $data = [
            'item_id' => $post['item_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'supplier_id' => $post['id_supp'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'status_stock' => 'minta',
            'user_id' => $this->session->userdata('userid')
        ];

        return $this->db->insert('t_stock', $data);
    }

    public function add_stock_out($post)
    {
        $data = [
            'item_id' => $post['item_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->insert('t_stock', $data);
    }

    public function del($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('t_stock');
    }

    public function getStock($post) {

        // $this->db->select('*, p_item.name as nm_brg, p_item.stock, supplier.name as nm_supp, supplier.address as alm, t_stock.date as tanggal');
        // $this->db->from('p_item');
        // $this->db->join('t_stock', 'item_id');
        // $this->db->join('supplier', 'supplier_id');
        // $this->db->where('t_stock.date >=', $post['tgl_a']);
        // $this->db->where('t_stock.date <=', $post['tgl_b']);
        return $this->db->query("SELECT * FROM p_item");
    }
}
