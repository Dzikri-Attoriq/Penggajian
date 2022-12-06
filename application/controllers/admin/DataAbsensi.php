<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataAbsensi extends CI_Controller {

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
		$data['title'] = "Data Absensi Pegawai";

		if((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '') ) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulanTahun = $bulan.$tahun;
        } else if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = date('Y');
            $bulanTahun = $bulan.$tahun;
        } else if(isset($_GET['tahun']) && $_GET['tahun'] != '') {
            $bulan = date('F');
            $tahun = $_GET['tahun'];
            $bulanTahun = $bulan.$tahun;
        } else {
            $bulan = date('F');
            $tahun = date('Y');
            $bulanTahun = $bulan.$tahun;
        }

		$data['absensi'] = $this->db->query("
			SELECT data_kehadiran.*, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.jabatan 
			FROM data_kehadiran 
			INNER JOIN data_pegawai ON data_kehadiran.nik = data_pegawai.nik
			INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_pegawai.jabatan ASC")->result();
		
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataAbsensi', $data);
		$this->load->view('templates_admin/footer');
	}


	public function inputAbsensi() {

		if((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '') ) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulanTahun = $bulan.$tahun;
        } else if(isset($_GET['bulan']) && $_GET['bulan'] != '') {
            $bulan = $_GET['bulan'];
            $tahun = date('Y');
            $bulanTahun = $bulan.$tahun;
        } else if(isset($_GET['tahun']) && $_GET['tahun'] != '') {
            $bulan = date('F');
            $tahun = $_GET['tahun'];
            $bulanTahun = $bulan.$tahun;
        } else {
            $bulan = date('F');
            $tahun = date('Y');
            $bulanTahun = $bulan.$tahun;
        }

		if($this->input->post('submit', TRUE) == 'submit') {
			$post = $this->input->post(null,TRUE);
			foreach($post['bulan'] as $key => $value) {
				if($post['bulan'][$key] != '' || $post['nik'][$key] != '') {
					$simpan[] = [
						'bulan' => $post['bulan'][$key],
						'nik' => $post['nik'][$key],
						'nama_pegawai' => $post['nama_pegawai'][$key],
						'jenis_kelamin' => $post['jenis_kelamin'][$key],
						'nama_jabatan' => $post['nama_jabatan'][$key],
						'hadir' => $post['hadir'][$key],
						'sakit' => $post['sakit'][$key],
						'izin' => $post['izin'][$key],
						'alpha' => $post['alpha'][$key],
					];
				}
			}
			$this->PenggajianModel->insert_batch('kehadiran', $simpan);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
										  Berhasil! <strong>menambahkan</strong> data absensi.
										  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										    <span aria-hidden="true">&times;</span>
										  </button>
										</div>');
			redirect(base_url('admin/DataAbsensi/index?bulan='.$bulan.'&tahun='.$tahun));
		} 

		$data['title'] = "Form Input Absensi";

		$data['inputAbsensi'] = $this->db->query("
			SELECT data_pegawai.*, data_jabatan.nama_jabatan 
			FROM data_pegawai
			INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
			WHERE NOT EXISTS 
			(SELECT * FROM data_kehadiran WHERE bulan = '$bulanTahun' && data_pegawai.nik = data_kehadiran.nik)
			ORDER BY data_pegawai.jabatan ASC ")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/formInputAbsensi', $data);
		$this->load->view('templates_admin/footer');
	}

	

}