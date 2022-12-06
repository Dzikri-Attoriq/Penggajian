<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gantiPassword extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if(!$this->session->userdata('id_pegawai')) {
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
		$data['title'] = "Ubah Password";

		if($this->session->userdata('hak_akses') == 1) {
			$this->load->view('templates_admin/header', $data);
			$this->load->view('templates_admin/sidebar');
			$this->load->view('formGantiPassword', $data);
			$this->load->view('templates_admin/footer');
		} else if($this->session->userdata('hak_akses') == 2) {
			$this->load->view('templates_pegawai/header', $data);
			$this->load->view('templates_pegawai/sidebar');
			$this->load->view('formGantiPassword', $data);
			$this->load->view('templates_pegawai/footer');
		} else {
			redirect(base_url('Auth'));
		}
	}



	public function gantiPasswordAksi() {
		$this->_rules();
		if($this->form_validation->run() == false) {
			$this->index();
		} else {
			$passnow = md5($this->input->post('passnow'));
			$passnew = $this->input->post('passnew');
			$passconf = $this->input->post('passconf');
			if($passnow != $this->session->userdata('password')) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
										  <strong>Password Sebelumnya salah!</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
				$this->index();
			} else {
				if($passnew == $this->input->post('passnow')) {
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
										  <strong>Password baru tidak boleh sama dengan Password Sebelumnya!</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
					$this->index();
				} else {
					$data = ['password' => md5($passnew)];
					$id = ['id_pegawai' => $this->session->userdata('id_pegawai')];
					$this->PenggajianModel->update_data('pegawai',$data, $id);
						$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
													  Berhasil! <strong>meng-ubah</strong> password.
													  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													    <span aria-hidden="true">&times;</span>
													  </button>
													</div>');
						redirect(base_url('Auth'));
				}
			}
		}
	}



	public function _rules() {
		$this->form_validation->set_rules('passnow','Password Sekarang','required|trim');
		$this->form_validation->set_rules('passnew','Password Baru','required|trim|min_length[8]|matches[passconf]');
		$this->form_validation->set_rules('passconf','Konfirmasi Password Baru','required|trim|matches[passnew]');

		$this->form_validation->set_message('required','%s harus di isi.');
		$this->form_validation->set_message('min_length','%s minimal 8 karakter.');
		$this->form_validation->set_message('matches','%s tidak sama dengan Konfirmasi Password.');
	}




}