<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['sale_m', 'stock_m']);
        check_not_login();
    }

    public function sale_report()
    {
        $data['sale'] = $this->sale_m->get_sale()->result();
        // var_dump($data['sale']);
        $this->template->load('template', 'reports/sale_report', $data);
    }

    public function stock_report()
    {
        $this->template->load('template', 'reports/stock_report');
    }

    public function detail()
    {
        $sale_id = $this->input->post('sale_id');
        $data = $this->sale_m->get_sale_detail($sale_id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function stock_print() {
        $post = $this->input->post();
        $data['tgl_a'] = $this->input->post('tgl_a');
        $data['tgl_b'] = $this->input->post('tgl_b');
        $data['get_stock'] = $this->stock_m->getStock($post)->result();
        $this->load->view('reports/print_stockreport', $data);
    }

    public function sale_print() {
        $post = $this->input->post();
        $data['tgl_a'] = $this->input->post('tgl_a');
        $data['tgl_b'] = $this->input->post('tgl_b');
        $data['keu'] = $this->sale_m->getOmset($post)->row();
        $data['get_sale'] = $this->sale_m->getSale($post)->result();
        // var_dump($data['keu']);
        // die;
        $this->load->view('reports/print_salereport', $data);

    }
}
