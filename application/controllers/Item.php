<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['item_m', 'category_m', 'unit_m', 'mino_m']);
        check_not_login();
    }

    public function index()
    {
        $data['category'] = $this->category_m->get()->result();
        $data['unit'] = $this->unit_m->get()->result();
        $data['item'] = $this->item_m->get()->result();
        $data['mino'] = $this->mino_m->get()->result();
        //var_dump($data['category']);
        $this->template->load('template', 'product/item/item_data', $data);
    }

    

    public function cek_barcode()
    {
        $barcode = $this->input->post('data');
        $cek_data = $this->item_m->cek_data($barcode)->row_array();
        $return_data = ($cek_data) ? "ADA" : "TIDAK ADA";

        header('Content-Type: application/json');
        echo json_encode($return_data);
    }

    public function save()
    {
        $post = $this->input->post();
        $this->item_m->save($post);
        $this->session->set_flashdata('pesan', 'Data item berhasil ditambah.');
        redirect('item');
            
    }

    public function edit()
    {
        $id = $this->input->post('item_id');
        $data = $this->item_m->get($id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
        //var_dump($data);
    }

    public function update()
    {
        $post = $this->input->post();
        $this->item_m->update($post);
        $this->session->set_flashdata('pesan', 'Data item berhasil diupdate.');
        redirect('item');
    }

    public function delete()
    {
        $id = $this->input->post('item_id');
        $item = $this->item_m->get($id)->row();

        if ($item->gambar != 'default.png') {
            unlink('./uploads/product/' . $item->gambar);
        }
        $this->item_m->delete($id);

        $this->session->set_flashdata('pesan', 'Data item berhasil di hapus!');
        redirect('item');
    }

    public function barcode_qrcode($id)
    {
        $data['item'] = $this->item_m->get($id)->row();
        $this->template->load('template', 'product/item/barcode_qrcode', $data);
    }

    public function barcode_print($id)
    {
        $data['item'] = $this->item_m->get($id)->row();
        $html = $this->load->view('product/item/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-' . $data['item']->barcode, 'A4', 'landscape');
    }
    public function qrcode_print($id)
    {
        $data['item'] = $this->item_m->get($id)->row();
        $html = $this->load->view('product/item/qrcode_print', $data, true);
        // var_dump($html);
        // die();
        $this->fungsi->PdfGenerator($html, 'qrcode-' . $data['item']->barcode, 'A4', 'potrait');
    }
}
