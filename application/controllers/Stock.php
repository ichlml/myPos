<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['supplier_m', 'item_m', 'stock_m']);
        check_not_login();
    }

    public function stock_in_index()
    {
        $data['stock'] = $this->stock_m->get()->result();
        $this->template->load('template', 'transaction/stock_in/stock_in_data', $data);
    }

    public function stokhabis()
    {
        $data['habis'] = $this->item_m->res_stokkosong()->result();
        // var_dump($data['habis']);
        $this->template->load('template', 'stock/habis/stock_data', $data);
    }

    public function req_stok()
    {
        $data['req_stok'] = $this->stock_m->req_stok()->result();
        // var_dump($data['habis']);
        $this->template->load('template', 'stock/req/req_data', $data);
    }

    public function stock_out_index()
    {
        $data['stock'] = $this->stock_m->get_stock_out()->result();
        $this->template->load('template', 'transaction/stock_out/stock_out_data', $data);
    }

    public function stock_in_add()
    {
        $data['item'] = $this->item_m->get()->result();
        $data['supplier'] = $this->supplier_m->get()->result();
        $this->template->load('template', 'transaction/stock_in/stock_in_form', $data);
    }

    public function stock_out_add()
    {
        $data['item'] = $this->item_m->get()->result();
        $data['supplier'] = $this->supplier_m->get()->result();
        $this->template->load('template', 'transaction/stock_out/stock_out_form', $data);
    }

    public function prosesminta(){
        $post = $this->input->post(null, true);
        $add = $this->stock_m->prosesminta($post);

        if ($add) {
            $this->session->set_flashdata('pesan', 'Permintaan Stok berhasil ditambah');
                redirect('stock/stokhabis');
        }else {
            $this->session->set_flashdata('pesan', 'Permintaan Stok gagal ditambah');
                redirect('stock/stokhabis');
        }
    }

    public function validasi_req() {
        $post = $this->input->post(null, true);
        $validasi = $this->stock_m->validasi_req($post);
        if ($validasi) {
            // $this->item_m->update_stock_in($post);
            $this->session->set_flashdata('pesan', 'Validasi Stock-in berhasil');
            redirect('supplier/stok_supp');
        }else{
            $this->session->set_flashdata('pesan', 'Validasi Stock-in gagal');
            redirect('supplier/stok_supp');
        }
    }

    public function validasi_() {
        $post = $this->input->post(null, true);
        $validasi = $this->stock_m->validasi_($post);
        if ($validasi) {
            $this->item_m->update_stock_in($post);
            $this->session->set_flashdata('pesan', 'Validasi Stock-in berhasil');
            redirect('stock/req_stok');
        }else{
            $this->session->set_flashdata('pesan', 'Validasi Stock-in gagal');
            redirect('stock/req_stok');
        }
    }

    public function process()
    {
        if (isset($_POST['in_add'])) {
            $post = $this->input->post(null, true);
            $this->stock_m->add_stock_in($post);
            $this->item_m->update_stock_in($post);

            // if ($this->db->affected_rows() > 0) {
            //     $options = array(
            //         'cluster' => 'ap1',
            //         'useTLS' => true
            //     );
            //     $pusher = new Pusher\Pusher(
            //         'd4392a044ecee1cce52a',
            //         '2ee60baddf74f9ad2925',
            //         '1041444',
            //         $options
            //     );

                // $data['message'] = 'hello world';
                // $pusher->trigger('my-channel', 'my-event', $data);
                $this->session->set_flashdata('pesan', 'Data Stock-In berhasil ditambah');
                redirect('stock/in');
            // }
        } else {
            $post = $this->input->post(null, true);
            $this->stock_m->add_stock_out($post);
            $this->item_m->update_stock_out($post);

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('pesan', 'Data Stock-Out berhasil ditambah');
                redirect('stock/out');
            }
        }
    }

    public function stock_in_del()
    {
        $stock_id = $this->input->post('stock_id');
        $item_id = $this->input->post('item_id');
        $qty = $this->stock_m->get_stock($stock_id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_id' => $item_id
        ];
        $this->item_m->update_stock_out($data);
        $this->stock_m->del($stock_id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('pesan', 'Data Stock-In berhasil dihapus');
            redirect('stock/in');
        }
    }

    public function stock_out_del()
    {
        $stock_id = $this->input->post('stock_id');
        $item_id = $this->input->post('item_id');
        $qty = $this->stock_m->get_stock($stock_id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_id' => $item_id
        ];
        $this->item_m->update_stock_out($data);
        $this->stock_m->del($stock_id);

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('pesan', 'Data Stock-Out berhasil dihapus');
            redirect('stock/out');
        }
    }
}
