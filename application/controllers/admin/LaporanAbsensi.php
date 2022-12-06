<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanAbsensi extends CI_Controller {

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
		$data['title'] = "Laporan Absensi Pegawai";
		
		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/filterLaporanAbsensi');
		$this->load->view('templates_admin/footer');
	}



	public function cetakLaporanAbsensi() {
		$data['title'] = "Cetak Laporan Gaji Pegawai";

		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		if( $bulan != null && $tahun != null ) {
		    $bulan = $this->input->post('bulan');
		    $tahun = $this->input->post('tahun');
		    $bulanTahun = $bulan.$tahun;
		} else if($bulan != null && $tahun == null) {
		    $bulan = $this->input->post('bulan');
		    $tahun = date('Y');
		    $bulanTahun = $bulan.$tahun;
		} else if($bulan == null && $tahun != null) {
		    $bulan = date('F');
		    $tahun = $this->input->post('tahun');
		    $bulanTahun = $bulan.$tahun;
		} else {
		    $bulan = date('F');
		    $tahun = date('Y');
		    $bulanTahun = $bulan.$tahun;
		}

		$data['lapKehadiran'] = $this->db->query("
			SELECT * FROM data_kehadiran
			WHERE bulan = '$bulanTahun' 
			ORDER BY nama_jabatan ASC")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('admin/cetakLaporanAbsensi', $data);
	}













}	