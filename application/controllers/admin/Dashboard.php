<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('hak_akses') != 1) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
										  <strong>Anda belum login!</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
				redirect(base_url('Auth'));
		}
	}

	public function index() {
		$data['title'] = "Dashboard";
		$data['pegawai'] = $this->db->get('pegawai')->num_rows();
		$data['admin'] = $this->db->get_where('pegawai',['jabatan' => 'Admin'])->num_rows();
		$data['kehadiran'] = $this->db->get('kehadiran')->num_rows();
		$data['jabatan'] = $this->db->get('jabatan')->num_rows();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates_admin/footer');
	}

}