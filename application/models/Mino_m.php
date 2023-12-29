<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mino_m extends CI_Model
{
    public function get() {
        return $this->db->get('min_o');
    }

    public function add_mino($post){
        $data = [
            'min_order' => $post['min_order'],
            'potongan' => $post['potongan'],
            'tgl_input' => $post['tgl_input'],
        ];

        return $this->db->insert('min_o', $data);
    }
}