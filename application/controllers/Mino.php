<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mino extends CI_Controller
{
    public function __construct(){
        parent:: __construct();
        $this->load->model(['item_m', 'category_m', 'unit_m', 'stock_m', 'mino_m']);
        check_not_login();
    }

    public function index()
    {
        $data['category'] = $this->category_m->get()->result();
        $data['unit'] = $this->unit_m->get()->result();
        $data['item'] = $this->item_m->get()->result();
        $data['stock'] = $this->stock_m->get()->result();
        $data['mino'] = $this->mino_m->get()->result();
        //var_dump($data['category']);
        $this->template->load('template', 'product/mino/data_mino', $data);
    }

    public function add(){
        $this->template->load('template', 'product/mino/add_mino');
    }

    public function process(){
        $post = $this->input->post(null, true);
        $add_mino = $this->mino_m->add_mino($post);
        // print_r($add_mino);
        // exit;
        if(add_mino){
            $this->session->set_flashdata('pesan', 'Minimal Order berhasil ditambah');
            redirect('mino');
        }else{
            $this->session->set_flashdata('pesan', 'Minimal Order gagal ditambah');
            redirect('mino');
        }
    }
}