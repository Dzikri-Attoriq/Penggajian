<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataPenggajian extends CI_Controller {

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
		$data['title'] = "Data Gaji Pegawai";

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

        $data['alpha'] =  $this->db->get_where('potongan_gaji',['potongan' => 'alpha'])->row_array();
        $data['izin'] =  $this->db->get_where('potongan_gaji',['potongan' => 'izin'])->row_array();
        $data['sakit'] =  $this->db->get_where('potongan_gaji',['potongan' => 'sakit'])->row_array();
		$data['gaji'] = $this->db->query("
			SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.izin, data_kehadiran.sakit
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_pegawai.nik = data_kehadiran.nik
			INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_pegawai.jabatan ASC")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dataGaji', $data);
		$this->load->view('templates_admin/footer');
	}



	public function cetakGaji() {
		$data['title'] = "Cetak Data Gaji Pegawai";

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

        $data['alpha'] =  $this->db->get_where('potongan_gaji',['potongan' => 'alpha'])->row_array();
        $data['izin'] =  $this->db->get_where('potongan_gaji',['potongan' => 'izin'])->row_array();
        $data['sakit'] =  $this->db->get_where('potongan_gaji',['potongan' => 'sakit'])->row_array();
		$data['cetakGaji'] = $this->db->query("
			SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.tj_transport, data_jabatan.uang_makan, data_kehadiran.alpha, data_kehadiran.izin, data_kehadiran.sakit
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_pegawai.nik = data_kehadiran.nik
			INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
			WHERE data_kehadiran.bulan = '$bulanTahun'
			ORDER BY data_pegawai.jabatan ASC")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('admin/cetakDataGaji', $data);
	}







}