<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permalink extends CI_Controller {
	private $template_header = 'template/header';
	private $template_footer = 'template/footer';
	private $template_header_kepala = 'template/header_kepala';
	private function cek_kepala(){
		if($this->session->tipe != 'kepala'){
			redirect('c_action/log_out');
		}
	}
	private function cek_admin(){
		if($this->session->tipe != 'admin'){
			redirect('c_action/log_out');
		}
	}
	function index(){
		$this->load->view('login');
	}
	public function home()
	{
		$this->cek_admin();
		$header['title'] = "Home";
		$header['active'] = "home";
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/home');
		$this->load->view($this->template_footer);
	}
	public function register(){
		$this->cek_admin();
		$header['title'] = "Register";
		$header['active'] = "register";
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/register');
		$this->load->view($this->template_footer);
	}
	public function data_nasabah(){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		$header['title'] = "Data Nasabah";
		$header['active'] = "data_nasabah";
		$header['css'] = array(
			base_url().'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'
		);
		$footer['js'] = array(
			base_url().'bower_components/datatables.net/js/jquery.dataTables.min.js',
			base_url().'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
			base_url().'plugin/plugin-nasabah.js'
		);
		$result['data'] = $this->m_nasabah->select_data_nasabah();
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/nasabah', $result);
		$this->load->view($this->template_footer, $footer);
	}
	public function insertdata(){
		$this->cek_admin();
		$data['nama'] = $_POST['nama'];
		$data['nik'] = $_POST['nik'];
		$data['no_telp'] = $_POST['no_telp'];
		$data['tempat_lahir'] = $_POST['tempat_lahir'];
		$data['tanggal_lahir'] = "".$_POST['tgl']."-".$_POST['bln']."-".$_POST['thn'];
		$data['jenis_kelamin'] = $_POST['jenis_kelamin'];
		$data['alamat'] = $_POST['alamat'];
		$data['kota'] = $_POST['kota'];
		$data['status_perkawinan'] = $_POST['status_perkawinan'];
		$data['kewarganegaraan'] = $_POST['kewarganegaraan'];
		$data['pekerjaan'] = $_POST['pekerjaan'];
		$data['penghasilan'] = $_POST['penghasilan'];
		$data['tunjangan'] = $_POST['tunjangan'];
		$this->load->model('m_nasabah');
		$header['title'] = "Register";
		$header['active'] = 'register';
		if($this->m_nasabah->tambah_nasabah($data)){
			$this->session->set_userdata('val_user', array(
				'flag'=>true,
				'value'=>'Data telah berhasil tersimpan..'
			));
		}else{
			$this->session->set_userdata('val_user', array(
				'flag'=>false,
				'value'=>'Data gagal tersimpan, mohon untuk diulangi lagi..'
			));
		}
		redirect('permalink/register');
	}
	function edit_nasabah($id){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		$data['data'] = $this->m_nasabah->get_data_nasabah($id);
		$date = explode("-", $data['data'][0]['tanggal_lahir']);
		$data['data'][0]['tanggal'] = $date[0];
		$data['data'][0]['bulan'] = $date[1];
		$data['data'][0]['tahun'] = $date[2];
		$header['title'] = "Ubah Nasabah";
		$header['active'] = 'data_nasabah';
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/edit-nasabah', $data);
		$this->load->view($this->template_footer);
	}
	private function get_nomor_pengajuan(){
		$sql = "select max(id_pengajuan) as maxKode from pengajuan";
			$getSql = $this->db->query($sql);
			$get = $getSql->result_array();
			$kode = $get[0]['maxKode'];
			if(strlen($kode) > 1){
				$no = (int) substr($kode, 4, 4);
				$no++;
			}else{
				// jika kode adalah NULL
				$no = (int) $kode;
				$no++;
			}
			$kodeBarang = $no;
			return $kodeBarang;
	}
	function pengajuan(){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		$nomor = $this->get_nomor_pengajuan();
		$header['title'] = "Pengajuan";
		$header['active'] = "pengajuan";
		$header['css'] = array(
			base_url().'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
			base_url().'bower_components/select2/dist/css/select2.min.css'
		);
		$footer['js'] = array(
			base_url().'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			base_url().'bower_components/select2/dist/js/select2.full.min.js',
			base_url().'plugin/plugin-pengajuan.js'
		);
		$data['nasabah'] = $this->m_nasabah->ambil_data_nasabah_select();
		$data['nomor'] = trim($nomor);
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/pengajuan', $data);
		$this->load->view($this->template_footer, $footer);
	}
	function insert_pengajuan(){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		if($this->m_nasabah->tambah_pengajuan( $_POST )){
			$this->session->set_userdata('pengajuan_val', array(
				'flag'=>true,
				'value'=>'Data telah berhasil tersimpan.'
			));
		}else{
			$this->session->set_userdata('pengajuan_val', array(
				'flag'=>false,
				'value'=>'Data gagal tersimpan.'
			));
		}
		redirect('permalink/pengajuan');
	}
	function data_pengajuan(){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		$header['title'] = "Data Pengajuan";
		$header['active'] = "data_pengajuan";
		$header['css'] = array(
			base_url().'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'
		);
		$footer['js'] = array(
			base_url().'bower_components/datatables.net/js/jquery.dataTables.min.js',
			base_url().'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
			base_url().'plugin/plugin-nasabah.js'
		);
		$result['data'] = $this->m_nasabah->data_pengajuan();
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/data_pengajuan', $result);
		$this->load->view($this->template_footer, $footer);
	}
	function edit_pengajuan($id_pengajuan = ""){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		$get_data = $this->m_nasabah->get_data_pengajuan($id_pengajuan);
		$header['title'] = "Ubah Pengajuan";
		$header['active'] = 'data_pengajuan';
		if(is_array($get_data)){
			$header['css'] = array(
				base_url().'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
				base_url().'bower_components/select2/dist/css/select2.min.css'
			);
			$footer['js'] = array(
				base_url().'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
				base_url().'bower_components/select2/dist/js/select2.full.min.js',
				base_url().'plugin/plugin-pengajuan.js'
			);
			$data['result'] = $get_data;
			$this->load->view($this->template_header, $header);
			$this->load->view('nasabah/edit-pengajuan', $data);
			$this->load->view($this->template_footer, $footer);
		}else{
			redirect('permalink/pengajuan');
		}
	}
	function laporan(){
		$this->cek_admin();
		$header['title'] = "Cetak Laporan";
		$header['active'] = 'laporan';
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/laporan');
		$this->load->view($this->template_footer);
	}
	function form_user(){
		$this->cek_admin();
		$header['title'] = "Input User";
		$header['active'] = 'form_user';
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/form-user');
		$this->load->view($this->template_footer);
	}
	function data_user(){
		$this->cek_admin();
		$this->load->model('m_nasabah');
		$sql = $this->m_nasabah->get_data_user();
		$header['title'] = "Kelola User";
		$header['active'] = 'kelola_user';
		if($sql->num_rows() > 0){
			$result['data'] = $sql->result_array();
		}else{
			$result['data'] = false;
		}
		$header['css'] = array(
			base_url().'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'
		);
		$footer['js'] = array(
			base_url().'bower_components/datatables.net/js/jquery.dataTables.min.js',
			base_url().'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'
		);
		$this->load->view($this->template_header, $header);
		$this->load->view('nasabah/user', $result);
		$this->load->view($this->template_footer, $footer);
	}
	function edit_data_user($param){
		$this->cek_admin();
		$id = trim($param);
		$this->load->model('m_nasabah');
		$data = $this->m_nasabah->ambil_data_user($id);
		if(is_array($data)){
			$result['data'] = $data;
			$header['title'] = "Edit User";
			$header['active'] = 'kelola_user';
			$this->load->view($this->template_header, $header);
			$this->load->view('nasabah/edit-user', $result);
			$this->load->view($this->template_footer);
		}else{
			echo "<script>alert('Sistem gagal mengambil data...');</script>";
			redirect('permalink/data_user');
		}
	}

	# method - method dibawah ini merupakan controller untuk user kepala
	function home_(){
		$this->cek_kepala();
		$header['title'] = "Home";
		$header['active'] = "home";
		$this->load->view($this->template_header_kepala, $header);
		$this->load->view('kepala/home');
		$this->load->view($this->template_footer);
	}
	function data_pengajuan_(){
		$this->cek_kepala();
		$this->load->model('m_nasabah');
		$header['title'] = "Data Pengajuan";
		$header['active'] = "data_pengajuan";
		$header['css'] = array(
			base_url().'bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'
		);
		$footer['js'] = array(
			base_url().'bower_components/datatables.net/js/jquery.dataTables.min.js',
			base_url().'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js',
			base_url().'plugin/plugin-pengajuan_.js',
			base_url().'plugin/plugin-nasabah.js'
		);
		$result['data'] = $this->m_nasabah->data_pengajuan_();
		$this->load->view($this->template_header_kepala, $header);
		$this->load->view('kepala/pengajuan', $result);
		$this->load->view($this->template_footer, $footer);
	}
	function laporan_(){
		$this->cek_kepala();
		$header['title'] = "Cetak Laporan";
		$header['active'] = 'laporan';
		$this->load->view($this->template_header_kepala, $header);
		$this->load->view('kepala/laporan');
		$this->load->view($this->template_footer);
	}

}
?>
