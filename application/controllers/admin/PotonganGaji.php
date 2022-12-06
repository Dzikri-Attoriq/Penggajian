<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PotonganGaji extends CI_Controller {

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
		$data['title'] = "Setting Potongan Gaji";
		$data['potGaji'] = $this->PenggajianModel->get_data('potongan_gaji','potongan')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/potonganGaji', $data);
		$this->load->view('templates_admin/footer');
	}


	public function _rules() {
		$this->form_validation->set_rules('jml_potongan','Jumlah Potongan', 'required|integer');

		$this->form_validation->set_message('required','%s tidak boleh kosong.');
		$this->form_validation->set_message('integer','%s harus berisi angka.');
		$this->form_validation->set_message('is_unique','%s telah terdaftar.');
	}



	public function tambahData() {
		$data['title'] = "Tambah Potongan Gaji";

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formPotonganGaji', $data);
		$this->load->view('templates_admin/footer');
	}



	public function tambahDataAksi() {
		$this->_rules();
		$this->form_validation->set_rules('potongan','Jenis Potongan', 'required|is_unique[potongan_gaji.potongan]');
		if($this->form_validation->run() == false) {
			$this->tambahData();
		} else {
			$potongan = $this->input->post('potongan');
			$jml_potongan = $this->input->post('jml_potongan');

			$data = [
				'potongan' => $potongan,
				'jml_potongan' => $jml_potongan,
			];
			$this->PenggajianModel->insert_data($data, 'potongan_gaji');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>menambahkan</strong> data potongan gaji <strong>"'.$this->input->post('potongan').'".</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/PotonganGaji'));
		}
	}


	public function updateData($id) {
		$data['title'] = "Edit Data Jabatan";
		$where = ['id' => $id];
		$data['potGaji'] = $this->db->query("SELECT * FROM data_potongan_gaji WHERE id = '$id' ")->row_array();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/updatePotonganGaji', $data);
		$this->load->view('templates_admin/footer');
	}



	public function updateDataAksi() {
		$this->_rules();
		$this->form_validation->set_rules('potongan','Jenis Potongan', 'required');
		if($this->form_validation->run() == false) {
			$this->updateData($this->input->post('id'));
		} else {
			if($this->PenggajianModel->check_keberadaan('potongan_gaji','potongan', $this->input->post('potongan'), 'id', $this->input->post('id'))->num_rows() > 0) {
				$post = $this->input->post(null);
				$this->session->set_flashdata('error'," <small class='pl-3' style='color: red;'>Nama Jenis potongan <b>$post[potongan]</b> telah di pakai.</small>");
				redirect(base_url('admin/PotonganGaji/updateData/'.$post['id']));
			} else {
			$id = $this->input->post('id');
			$potongan = $this->input->post('potongan');
			$jml_potongan = $this->input->post('jml_potongan');

			$data = [
				'potongan' => $potongan,
				'jml_potongan' => $jml_potongan,
			];
			$where = [
				'id' => $id
			];
			$this->PenggajianModel->update_data('potongan_gaji', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>meng-edit</strong> data potongan gaji <strong>"'.$this->input->post('potongan').'"</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/PotonganGaji'));
			}
			
		}
	}



	public function deleteData($id) {
		$where = ['id' => $id];
		$query = $this->db->get_where('potongan_gaji',$where)->row_array();
		$this->PenggajianModel->delete_data($where, 'potongan_gaji');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>meng-hapus</strong> data potongan gaji <strong>"'.$query['potongan'].'".</strong>
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/PotonganGaji'));
	}



}