<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPegawai extends CI_Controller {

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
		$data['title'] = "Data Pegawai";
		$data['pegawai'] = $this->PenggajianModel->get_data('pegawai','jabatan')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataPegawai', $data);
		$this->load->view('templates_admin/footer');
	}


	public function tambahData() {
		$data['title'] = "Tambah Data Pegawai";
		$data['jabatan'] = $this->PenggajianModel->get_data('jabatan','nama_jabatan')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formTambahPegawai', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambahDataAksi() {
		$this->_rules();
		$this->form_validation->set_rules('nik','NIK', 'required|numeric|is_unique[pegawai.nik]');
		$this->form_validation->set_rules('username','Username', 'required|trim|is_unique[pegawai.username]');
		$this->form_validation->set_rules('password','Password', 'required|trim|min_length[8]');

		if($this->form_validation->run() == false) {
			$this->tambahData();
		} else {
			$nik = $this->input->post('nik', true);
			$nama_pegawai = $this->input->post('nama_pegawai', true);
			$jenis_kelamin = $this->input->post('jenis_kelamin', true);
			$jabatan = $this->input->post('jabatan', true);
			$tanggal_masuk = $this->input->post('tanggal_masuk', true);
			$status = $this->input->post('status', true);
			$username = $this->input->post('username', true);
			$password = md5($this->input->post('password', true));
			$upload = $_FILES['foto']['name'];

			if($upload) {
				$config ['upload_path'] = './assets/img/profile/';
				$config['allowed_types'] = 'gif|jpg|jpeg|webp|jfif';
				$config['max_size'] = 2048;
				$this->load->library('upload', $config);
				if($this->upload->do_upload('foto')) {
					$foto = $this->upload->data('file_name');
				} else {
					$this->upload->display_errors();
				}
			}
			$data = [
				'nik' => $nik,
				'nama_pegawai' => $nama_pegawai,
				'username' => $username,
				'password' => $password,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' => $jabatan,
				'tanggal_masuk' => $tanggal_masuk == '' ? date('Y-m-d') : $tanggal_masuk ,
				'status' => $status,
				'hak_akses' => $jabatan == "Admin" ? 1 : 2,
				'foto' => $foto == '' ? 'default.jpg' : $foto
			];

			$this->PenggajianModel->insert_data($data, 'pegawai');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>menambahkan</strong> data pegawai <strong>"'.$this->input->post('nik').'".</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/DataPegawai'));

		}
	}



	public function _rules() {
		$this->form_validation->set_rules('nama_pegawai','Nama Pegawai', 'required');
		$this->form_validation->set_rules('jenis_kelamin','Gender', 'required');
		$this->form_validation->set_rules('jabatan','Jabtan', 'required');
		$this->form_validation->set_rules('status','Status', 'required');

		$this->form_validation->set_message('required','%s tidak boleh kosong.');
		$this->form_validation->set_message('numeric','%s harus berisi angka dan titik(.).');
		$this->form_validation->set_message('is_unique','%s telah terdaftar.');
		$this->form_validation->set_message('matches','%s tidak sama dengan Konfirmasi Password.');
		$this->form_validation->set_message('min_length','%s minimal 8 karakter.');
	}



	public function updateData($id) {
		$data['title'] = "Edit Data Pegawai";
		$where = ['id_pegawai' => $id];
		$data['jabatan'] = $this->PenggajianModel->get_data('jabatan','nama_jabatan')->result();
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id' ")->row_array();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formUpdatePegawai', $data);
		$this->load->view('templates_admin/footer');
	}


	public function updateDataAksi() {
		$this->_rules();
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		
		$password = $this->input->post('password1', true);
		if ($password != null) {
			$this->form_validation->set_rules('password1', 'Password', 'trim|matches[password2]|min_length[8]');
			$this->form_validation->set_rules('password2', 'Konfirmas Password', 'trim|matches[password1]|min_length[8]');
			$this->db->set('password', md5($password));
		}

		if($this->form_validation->run() == false) {
			$this->updateData($this->input->post('id_pegawai'));
		} else {
			if($this->PenggajianModel->check_keberadaan('pegawai','nik', $this->input->post('nik'), 'id_pegawai', $this->input->post('id_pegawai'))->num_rows() > 0) {
				$post = $this->input->post(null);
				$this->session->set_flashdata('error'," <small class='pl-3' style='color: red;'>NIK <b>$post[nik]</b> telah di pakai.</small>");
				redirect(base_url('admin/DataPegawai/updateData/'.$post['id_pegawai']));
			} else {
				if ($this->PenggajianModel->check_keberadaan('pegawai','username', $this->input->post('username'), 'id_pegawai', $this->input->post('id_pegawai'))->num_rows() > 0) {
					$post = $this->input->post(null);
					$this->session->set_flashdata('error'," <small class='pl-3' style='color: red;'>NIK <b>$post[username]</b> telah di pakai.</small>");
					redirect(base_url('admin/DataPegawai/updateData/'.$post['id_pegawai']));
				} else {
					$id_pegawai = $this->input->post('id_pegawai', true);
					$nik = $this->input->post('nik', true);
					$nama_pegawai = $this->input->post('nama_pegawai', true);
					$jenis_kelamin = $this->input->post('jenis_kelamin', true);
					$jabatan = $this->input->post('jabatan', true);
					$tanggal_masuk = $this->input->post('tanggal_masuk', true);
					$status = $this->input->post('status', true);
					$username = $this->input->post('username', true);
					$upload = $_FILES['foto']['name'];
					$where = ['id_pegawai' => $id_pegawai];


					if($upload) {
						$config ['upload_path'] = './assets/img/profile/';
						$config['allowed_types'] = 'gif|jpg|jpeg|webp|jfif';
						$config['max_size'] = 2048;
						$this->load->library('upload', $config);
						if($this->upload->do_upload('foto')) {
							$checkFoto = $this->db->get_where('pegawai',$where)->row_array();
							$oldFoto = $checkFoto['foto'];
							if($oldFoto != 'default.jpg') {
								unlink(FCPATH. 'assets/img/profile/'.$oldFoto);
							}

							$foto = $this->upload->data('file_name');
							$this->db->set('foto',$foto);
						} else {
							$this->upload->display_errors();
						}
					}
					$data = [
						'nik' => $nik,
						'nama_pegawai' => $nama_pegawai,
						'username' => $username,
						'jenis_kelamin' => $jenis_kelamin,
						'jabatan' => $jabatan,
						'tanggal_masuk' => $tanggal_masuk == '' ? date('Y-m-d') : $tanggal_masuk ,
						'status' => $status,
						'hak_akses' => $jabatan == "Admin" ? 1 : 2,
					];

					$this->PenggajianModel->update_data('pegawai',$data, $where);
					$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
												  Berhasil! <strong>meng-edit</strong> data pegawai <strong>"'.$this->input->post('nik').'".</strong>
												  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												    <span aria-hidden="true">&times;</span>
												  </button>
												</div>');
					redirect(base_url('admin/DataPegawai'));
				}
			}
		}
	}



	public function deleteData($id) {
		$where = ['id_pegawai' => $id];
		$query = $this->db->get_where('pegawai',$where)->row_array();
		$oldFoto = $query['foto'];
		if($oldFoto != 'default.jpg') {
			unlink(FCPATH. 'assets/img/profile/'.$oldFoto);
		}
		$this->PenggajianModel->delete_data($where, 'pegawai');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>meng-hapus</strong> data pegawai <strong>"'.$query['nik'].'".</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
		redirect(base_url('admin/DataPegawai'));
	}



}