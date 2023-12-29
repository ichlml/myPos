<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item_m extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('p_item.*, p_item.stock,  p_category.name as name_category, p_unit.name as name_unit');
        $this->db->from('p_item');
        $this->db->join('p_category', 'p_item.category_id = p_category.category_id');
        $this->db->join('p_unit', 'p_item.unit_id = p_unit.unit_id');
        if ($id != null) {
            $this->db->where('item_id', $id);
        }
        $this->db->order_by('barcode', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_stokkosong()
    {
        return $this->db->query("SELECT  count(*) as kosong FROM p_item inner join t_stock using(item_id) inner join supplier using(supplier_id) WHERE stock <= 10 and status_stock = 'diterima'");
    }

    public function res_stokkosong()
    {
        return $this->db->query("SELECT  *,p_item.name as nm_brg, p_item.stock, supplier.name as nm_supp, supplier.address as almt, p_unit.name as kategori FROM p_item inner join t_stock using(item_id) inner join p_unit using(unit_id) inner join supplier using(supplier_id) WHERE stock <= 10 and status_stock = 'diterima'");
    }

    public function getuntug()
    {
        return $this->db->query("SELECT sum(tot_price_a) as hargaawal, sum(final_price) as harga FROM t_sale where date=curdate() ");
    }

    public function save($post)
    {
        $data = [
            'barcode' => $post['barcode'],
            'name' => $post['nama_produk'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price_a' => $post['price_a'],
            'price' => $post['price']
        ];

        $this->db->insert('p_item', $data);
    }

    public function update($post)
    {
        $data = [
            'barcode' => $post['barcode'],
            'name' => $post['nama_produk'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit'],
            'price_a' => $post['price_a'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];

        $this->db->where('item_id', $this->input->post('item_id'));
        $this->db->update('p_item', $data);
    }

    public function cek_data($barcode)
    {
        $this->db->select();
        $this->db->from('p_item');
        $this->db->where('barcode', $barcode);
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('item_id', $id);
        $this->db->delete('p_item');
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE p_item SET stock = stock + '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE p_item SET stock = stock - '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }
}
