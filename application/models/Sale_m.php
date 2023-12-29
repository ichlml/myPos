<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale_m extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no FROM t_sale WHERE MID(invoice,3,6) = DATE_FORMAT(CURRENT_DATE(), '%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "MP" . date('ymd') . $no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*,p_item.barcode,p_item.stock, p_item.item_id, p_item.name as item_name, t_cart.price as cart_price');
        $this->db->from('t_cart');
        $this->db->join('p_item', 't_cart.item_id=p_item.item_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_sale($post)
    {
        $data = [
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'] != null ? $post['costumer_id'] : null,
            'total_price' => $post['sub_total'],
            'tot_price_a' => $post['total_awal'],
            'discount' => $post['discount'],
            'final_price' => $post['grand_total'],
            'cash' => $post['cash'],
            'uang_kembalian' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->insert('t_sale', $data);
        return $this->db->insert_id();
    }

    public function add_sale_detail($data)
    {
        $this->db->insert_batch('t_sale_detail', $data);
    }

    public function get($id = null)
    {
        $this->db->select('*,p_item.barcode, p_item.name as item_name, t_cart.price as cart_price, t_cart.item_id as cart_item');
        $this->db->from('t_cart');
        $this->db->join('p_item', 't_cart.item_id=p_item.item_id');
        if ($id != null) {
            $this->db->where('cart_id', $id);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $sql = "SELECT MAX(cart_id) AS cart_no FROM t_cart";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int)$row->cart_no) + 1;
        } else {
            $car_no = '1';
        }
        
        $params = [
            'cart_id' => $car_no,
            'item_id' => $post['item_id'],
            'price' => $post['price'],
            'discount_item' => 0,
            'qty' => $post['qty'],
            'tot_price_a' => $post['tot_price_a'],
            'total' => $post['total'],
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->insert('t_cart', $params);
    }

    //pengurangan Stok
    public function update_stok_biyd($item_id, $stock_update)
    {
        $data = [
            'stock' => $stock_update
        ];
        $this->db->where('item_id', $item_id);
        return $this->db->update('p_item', $data);
    }


    public function update_cart($post)
    {
        $data = [
            'price' => $post['item_price'],
            'discount_item' => $post['item_discount'],
            'qty' => $post['item_qty'],
            'total' => (($post['item_price'] * $post['item_qty']) - $post['item_discount']),
            'user_id' => $this->session->userdata('userid')
        ];

        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('t_cart', $data);
    }

    public function update_cart_qty($post)
    {
        $sql = "UPDATE t_cart SET price = '$post[price]', qty = qty + '$post[qty]', total = '$post[price]' * qty WHERE item_id = '$post[item_id]'";
        return $this->db->query($sql);
    }

    public function del_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('t_cart');
    }

    public function get_sale($id = null)
    {
        $this->db->select('*, customer.name as customer_name, user.name as user_name, t_sale.created as sale_created');
        $this->db->from('t_sale');
        $this->db->join('user', 't_sale.user_id=user.user_id');
        $this->db->join('customer', 't_sale.customer_id=customer.customer_id', 'left');
        if ($id != null) {
            $this->db->where('sale_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($sale_id = null)
    {
        $this->db->Select('*, p_unit.name as nm_unit, p_item.name as nm_barang');
        $this->db->from('t_sale_detail');
        $this->db->join('p_item', 't_sale_detail.item_id=p_item.item_id');
        $this->db->join('p_unit', 'p_unit.unit_id=p_item.unit_id');
        if ($sale_id != null) {
            $this->db->where('t_sale_detail.sale_id', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function sale_detail()
    {
        $this->db->select('*, SUM(qty) as qty');
        $this->db->from('t_sale_detail');
        $this->db->join('p_item', 't_sale_detail.item_id=p_item.item_id');
        $this->db->group_by('t_sale_detail.item_id');
        $this->db->order_by('t_sale_detail.qty', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function getBarcode($barcode)
    {
        $hasil = $this->db->query("SELECT * FROM p_item where barcode ='$barcode'");
        if($hasil->num_rows() > 0){
            foreach ($hasil->result() as $data){
                $hsl = array(
                    'item_id' => $data->item_id,
                    'price' => $data->price,
                    'price_a' => $data->price_a,
                    'stock' => $data->stock,
                );
            }
            return $hsl;
        }
    }

    public function getSale($post) {
        $a = $post['tgl_a'];
        $b = $post['tgl_b'];
        return $this->db->query("SELECT invoice, p_item.barcode, p_item.`name` as nm_brg, p_category.name as category, p_unit.name as unit, p_item.price as harga, t_sale_detail.qty as jumlah, t_sale_detail.tot_price_a, t_sale_detail.total, t_sale.date as tanggal FROM `t_sale` inner join t_sale_detail using(sale_id) inner join p_item using(item_id) inner join p_category using(category_id) inner join p_unit using(unit_id) where t_sale.date between '$a' AND '$b'");
    }

    public function getOmset($post) {
        $a = $post['tgl_a'];
        $b = $post['tgl_b'];
        // return $this->db->select("SELECT SUM(tot_price_a) as total_awal, SUM(final_price) as total  from t_sale where date between '$a' AND '$b' ");
        $this->db->select("SUM(tot_price_a) as total_awal, SUM(final_price) as total");
        $this->db->from('t_sale');
        $this->db->where('date >=', $a);
        $this->db->where('date <=', $b);
        return $this->db->get();
    }
}
