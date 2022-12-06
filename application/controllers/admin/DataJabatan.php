<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataJabatan extends CI_Controller {

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
		$data['title'] = "Data Jabatan";
		$data['jabatan'] =  $this->PenggajianModel->get_data('jabatan','nama_jabatan')->result();

		
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataJabatan', $data);
		$this->load->view('templates_admin/footer');
	}


	public function tambahData() {
		$data['title'] = "Tambah Data Jabatan";

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/tambahDataJabatan', $data);
		$this->load->view('templates_admin/footer');
	}


	public function tambahDataAksi() {
		$this->_rules();
		$this->form_validation->set_rules('nama_jabatan','Nama Jabatan', 'required|is_unique[jabatan.nama_jabatan]');
		if($this->form_validation->run() == false) {
			$this->tambahData();
		} else {
			$nama_jabatan = $this->input->post('nama_jabatan');
			$gaji_pokok = $this->input->post('gaji_pokok');
			$tj_transport = $this->input->post('tj_transport');
			$uang_makan = $this->input->post('uang_makan');

			$data = [
				'nama_jabatan' => $nama_jabatan,
				'gaji_pokok' => $gaji_pokok,
				'tj_transport' => $tj_transport,
				'uang_makan' => $uang_makan
			];
			$this->PenggajianModel->insert_data($data, 'jabatan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>menambahkan</strong> data jabatan <strong>"'.$this->input->post('nama_jabatan').'".</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/DataJabatan'));
		}
	}


	public function _rules() {
		$this->form_validation->set_rules('gaji_pokok','Gaji Pokok', 'required|integer');
		$this->form_validation->set_rules('tj_transport','Tunjangan Transportasi', 'required|integer');
		$this->form_validation->set_rules('uang_makan','Uang Makan', 'required|integer');

		$this->form_validation->set_message('required','%s tidak boleh kosong.');
		$this->form_validation->set_message('integer','%s harus berisi angka.');
		$this->form_validation->set_message('is_unique','%s telah terdaftar.');
	}


	public function updateData($id) {
		$data['title'] = "Edit Data Jabatan";
		$where = ['id_jabatan' => $id];
		$data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan = '$id' ")->row_array();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/updateDataJabatan', $data);
		$this->load->view('templates_admin/footer');
	}


	public function updateDataAksi() {
		$this->_rules();
		$this->form_validation->set_rules('nama_jabatan','Nama Jabatan', 'required');
		if($this->form_validation->run() == false) {
			$this->updateData($this->input->post('id_jabatan'));
		} else {
			if($this->PenggajianModel->check_keberadaan('jabatan','nama_jabatan', $this->input->post('nama_jabatan'), 'id_jabatan', $this->input->post('id_jabatan'))->num_rows() > 0) {
				$post = $this->input->post(null);
				$this->session->set_flashdata('error'," <small class='pl-3' style='color: red;'>Nama Jabatan <b>$post[nama_jabatan]</b> telah di pakai.</small>");
				redirect(base_url('admin/DataJabatan/updateData/'.$post['id_jabatan']));
			} else {
			$id = $this->input->post('id_jabatan');
			$nama_jabatan = $this->input->post('nama_jabatan');
			$gaji_pokok = $this->input->post('gaji_pokok');
			$tj_transport = $this->input->post('tj_transport');
			$uang_makan = $this->input->post('uang_makan');

			$data = [
				'nama_jabatan' => $nama_jabatan,
				'gaji_pokok' => $gaji_pokok,
				'tj_transport' => $tj_transport,
				'uang_makan' => $uang_makan
			];
			$where = [
				'id_jabatan' => $id
			];
			$this->PenggajianModel->update_data('jabatan', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>meng-edit</strong> data jabatan <strong>"'.$this->input->post('nama_jabatan').'"</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/DataJabatan'));
			}
			
		}
	}


	public function deleteData($id) {
		$where = ['id_jabatan' => $id];
		$query = $this->db->get_where('jabatan',$where)->row_array();
		$this->PenggajianModel->delete_data($where, 'jabatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>meng-hapus</strong> data jabatan <strong>"'.$query['nama_jabatan'].'".</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/DataJabatan'));
	}


}