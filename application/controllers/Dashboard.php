<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		check_not_login();
		$this->load->model(['user_m', 'item_m', 'supplier_m', 'customer_m', 'sale_m', 'stock_m']);
	}

	public function index()
	{
		$data['product'] = $this->sale_m->sale_detail()->result();
		$data['item'] = $this->item_m->get()->result();
		$data['untungperhari'] = $this->item_m->getuntug()->row();
		$data['supplier'] = $this->supplier_m->get()->result();
		$data['user'] = $this->user_m->list()->result();
		$data['customer'] = $this->customer_m->get()->result();
		$data['stok_habis'] = $this->item_m->get_stokkosong()->row();
		// var_dump($data['product']);
		$this->template->load('template', 'dashboard', $data);
	}

	public function Supplier()
	{
		// $data['product'] = $this->sale_m->sale_detail()->result();
		// $data['item'] = $this->item_m->get()->result();
		// $data['untungperhari'] = $this->item_m->getuntug()->row();
		// $data['supplier'] = $this->supplier_m->get()->result();
		// $data['user'] = $this->user_m->list()->result();
		// $data['customer'] = $this->customer_m->get()->result();
		$data['req_stok'] = $this->supplier_m->req_stok()->result();
		// var_dump($data['product']);
		$this->template->load('template', 'supplier', $data);
	}

	
}
