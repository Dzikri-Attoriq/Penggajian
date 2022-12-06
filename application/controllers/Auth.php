<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index() {
		$this->_rules();

		if($this->form_validation->run() == false) {
			$data['title'] = "Form Login";

			$this->load->view('templates_admin/header', $data);
			$this->load->view('form_login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$cek = $this->PenggajianModel->cek_login($username, $password);
			if($cek == false) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
										  <strong>Username/Password</strong> salah!
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
				redirect(base_url('Auth'));
			} else {
				$params = [
					'id_pegawai' => $cek['id_pegawai'],
					'nik' => $cek['nik'],
					'hak_akses' => $cek['hak_akses'],
					'nama_pegawai' => $cek['nama_pegawai'],
					'foto' => $cek['foto'],
					'password' => $cek['password'],
				];
				$this->session->set_userdata($params);
				switch ($cek['hak_akses']) {
					case 1:
						redirect(base_url('admin/Dashboard'));
						break;

					case 2:
						redirect(base_url('pegawai/Dashboard'));
						break;
					
					default:
						break;
				}
			}
		}
	}



	public function _rules() {
		$this->form_validation->set_rules('username','Username','required|trim');
		$this->form_validation->set_rules('password','Password','required|trim');

		$this->form_validation->set_message('required','%s harus di isi.');
	}



	public function logout() {
		$this->session->unset_userdata('id_pegawai');
		$this->session->unset_userdata('nik');
		$this->session->unset_userdata('hak_akses');
		$this->session->unset_userdata('nama_pegawai');
		$this->session->unset_userdata('foto');
		$this->session->unset_userdata('password');
		$this->session->sess_destroy();

		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  <strong>Berhasil</strong> logout.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
		redirect(base_url('Auth'));
	}








}
