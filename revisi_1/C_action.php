<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_action extends CI_Controller {
	function login_proses(){
		$this->load->model('m_nasabah');
		$username = $_POST['username'];
		$password = $_POST['password'];
		$data = $this->m_nasabah->get_user_login($username, $password);
		if($data){
			// jika username dan password ditemukan
			if($data->num_rows() == 1){
				$result = $data->result_array();
				$setArray = array(
					'username'=>$result[0]['username'],
					'password'=>$result[0]['password'],
					'nama'=>$result[0]['nama'],
					'foto'=>$result[0]['foto'],
					'tipe'=>$result[0]['tipe']
				);
				$this->session->set_userdata($setArray);
				if($this->session->tipe == 'admin'){
					redirect('permalink/home');
				}
					redirect('permalink/home_');
			}else{
				// jika user tidak ditemukan
				$result['user'] = true;
				$this->load->view('login', $result);
			}
		}else{
			$data['database'] = false;
			$this->load->view('login', $data);
		}
	}
	function log_out(){
		$this->session->unset_userdata(array(
			'username',
			'password',
			'nama',
			'foto',
			'tipe'
		));
		$this->session->sess_destroy();
		redirect('permalink/index');
	}

	function hapus_nasabah($param){
		$id = $param;
		$query = "DELETE FROM nasabah WHERE id_nasabah = '$id'";
		if($this->db->query($query)){
			redirect('permalink/data_nasabah');
		}else{
			echo "<script>alert('Gagal menghapus data...');</script>";
			redirect('permalink/nasabah');
		}
	}
	function hapus_pengajuan($param){
		$id = $param;
		$query = "DELETE FROM pengajuan WHERE id_pengajuan = '$id'";
		if($this->db->query($query)){
			redirect('permalink/data_pengajuan');
		}else{
			echo "<script>alert('Gagal menghapus data...');</script>";
			redirect('permalink/data_pengajuan');
		}
	}
	function hapus_user($param){
		$id=trim($param);
		if($this->db->query("DELETE FROM user WHERE id_login = '$id'")){
			redirect('permalink/data_user');
		}else{
			echo "<script>alert('Gagal menghapus data...');</script>";
			redirect('permalink/data_user');
		}
	}
	function ubahdata(){
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

		$this->db->where('id_nasabah', $_POST['id_nasabah']);
		if($this->db->update('nasabah', $data)){
			redirect('permalink/data_nasabah');
		}else{
			$this->session->set_userdata('val_nasabah', array(
				'flag'=>false,
				'value'=>'Data nasabah gagal diubah, silahkan ulangi lagi.'
			));
			redirect("permalink/edit_nasabah/".$_POST['id_nasabah']);
		}
	}
	function ubah_pengajuan(){
		$data['id_nasabah'] = $_POST['id_nasabah'];
		$data['tanggal_pengajuan'] = $_POST['tanggal_pengajuan'];
		$data['tanggal_jatuh_tempo'] = $_POST['tanggal_jatuh_tempo'];
		$data['nominal'] = $_POST['nominal'];
		$data['jangka_waktu'] = $_POST['jangka_waktu'];
		$data['total_angsuran'] = $_POST['total_angsuran'];

		$this->db->where('id_pengajuan', $_POST['id_pengajuan']);
		if($this->db->update('pengajuan', $data)){
			redirect('permalink/data_pengajuan');
		}else{
			$this->session->set_userdata('val_nasabah', array(
				'flag'=>false,
				'value'=>'Data pengajuan gagal diubah, silahkan ulangi lagi.'
			));
			redirect('permalink/edit_pengajuan/'.$_POST['id_pengajuan']);
		}
	}
	function ubah_status(){
		$data['status'] = 'sudah';
		$this->db->where('id_pengajuan', $_GET['id_pengajuan']);
		if($this->db->update('pengajuan', $data)){
			die(json_encode( array('result'=>true) ));
		}
		die(json_encode( array('result'=>false) ));
	}
	function get_jangka_waktu(){
		$today = trim($_GET['today']);
		$B_ = trim($_GET['booking']);

		$today_array = explode("-", $today);
		$booking_array = explode("-", $B_);

		$booking = new DateTime($booking_array[2].'-'.$booking_array[1].'-'.$booking_array[0]);
		$hari_ini = new DateTime($today_array[2].'-'.$today_array[1].'-'.$today_array[0]);
		$diff = $hari_ini->diff($booking);

		$str = "";
		if($diff->y > 0){
			$str.=$diff->y." Tahun ";
		}
		if($diff->m > 0){
			$str.=$diff->m." Bulan ";
		}
		if($diff->d > 0){
			$str.=$diff->d." Hari";
		}
		echo $str;
	}
	function print_laporan(){
		$kategori = $_POST['kategori'];
		$status = $_POST['status'];
		if(trim($kategori) == "nasabah"){
			redirect('laporan/nasabah');
		}else{
			redirect('laporan/pengajuan/'.$status);
		}
	}
	function input_user(){
		$this->load->model('m_nasabah');
		$data['nama'] = $_POST['nama'];
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		$data['tipe'] = $_POST['tipe'];

		if( !$_FILES['file']['error'] ){

			$ekstensi = array('png', 'jpg');

			$destinasi = './gambar/';

			$nama = $_FILES['file']['name'];
			$x = explode(".", $nama);
			$ek = strtolower(end($x));

			$file_tmp = $_FILES['file']['tmp_name'];

			$nama_baru = date('dmYHis').'.'.$ek;

			if(in_array($ek, $ekstensi) === true){
				if(move_uploaded_file($file_tmp, $destinasi.''.$nama_baru)){
					$data['foto'] = $nama_baru;
					if($this->m_nasabah->tambah_user($data)){
						redirect('permalink/data_user');
					}else{
						// jika gagal tersimpan di database
						$this->session->set_userdata('val_user', array(
							'flag'=>false,
							'value'=>'Sistem gagal menyimpan data ke database...'
						));
						redirect('permalink/form_user');
					}
				}else{
					// Bila gagal upload ke sistem
					$this->session->set_userdata('val_user', array(
							'flag'=>false,
							'value'=>'Gagal mengupload foto ke sistem...'
					));
					redirect('permalink/form_user');
				}
				
			}else{
				// jika ekstensi file tidak valid
				$this->session->set_userdata('val_user', array(
					'flag'=>false,
					'value'=>'Maaf format file anda tidak valid, harusnya yang berekstensi jpg atau png'
				));
				redirect('permalink/form_user');
			}

		}else{
			$this->session->set_userdata('val_user', array(
							'flag'=>false,
							'value'=>'Pilih foto untuk user'
			));
			redirect('permalink/form_user');
		}
	}

	function edit_user(){
		$this->load->model('m_nasabah');
		$id['id_login'] = $_POST['id'];
		$data['nama'] = $_POST['nama'];
		$data['username'] = $_POST['username'];
		$data['password'] = $_POST['password'];
		$data['tipe'] = $_POST['tipe'];
		print_r($_FILES['file']);

		ini_set('upload_max_filesize', '8M');
		print_r(ini_get('upload_max_filesize'));

		if( !$_FILES['file']['error'] ){

			$ekstensi = array('png', 'jpg');

			$destinasi = './gambar/';

			$nama = $_FILES['file']['name'];
			$x = explode(".", $nama);
			$ek = strtolower(end($x));

			$file_tmp = $_FILES['file']['tmp_name'];

			$nama_baru = date('dmYHis').'.'.$ek;
			// jika kondisi terdapat file

			if( in_array($ek, $ekstensi) === true ){
				
				if( move_uploaded_file($file_tmp, $destinasi.''.$nama_baru) ){
					$data['foto'] = $nama_baru;
					if( $this->m_nasabah->ubah_data_user($data, $id) ){
						redirect('permalink/data_user');
					}else{
						// jika gagal menyimpan data
						$this->session->set_userdata('val_user', array(
							'flag'=>false,
							'value'=>'Sistem gagal menyimpan data ke database...'
						));
						redirect('permalink/edit_data_user/'.$id['id_login']);
					}
				}else{
					// Bila gagal upload ke sistem
					$this->session->set_userdata('val_user', array(
							'flag'=>false,
							'value'=>'Gagal mengupload foto ke sistem...'
					));
					redirect('permalink/edit_data_user/'.$id['id_login']);
				}

			}else{
				// jika ekstensi file tidak valid
				$this->session->set_userdata('val_user', array(
					'flag'=>false,
					'value'=>'Maaf format file anda tidak valid, harusnya yang berekstensi jpg atau png'
				));
				redirect('permalink/edit_data_user/'.$id['id_login']);
			}

		}else{
			if( $this->m_nasabah->ubah_data_user($data, $id) ){
				redirect('permalink/data_user');
			}else{
				$this->session->set_userdata('val_user', array(
					'flag'=>false,
					'value'=>'Sistem gagal menyimpan data ke database...'
				));
				redirect('permalink/edit_data_user/'.$id['id_login']);
			}
		}
		// akhir dari fungsi edit_user
	}

	function get_join_data_nasabah($id){
		$query = "SELECT a.nama, a.nik, a.jenis_kelamin, a.alamat, a.kota, a.kewarganegaraan, b.nomor_pengajuan, b.tanggal_pengajuan, b.tanggal_jatuh_tempo, b.nominal, b.jangka_waktu, b.total_angsuran, b.status FROM nasabah a, pengajuan b WHERE a.id_nasabah = b.id_nasabah AND b.nomor_pengajuan = '{$id}'";
		$sql = $this->db->query($query);
		if ($sql->num_rows() == 1){
				$data = $sql->result_array();
				$data = $data[0];

				$str = "<tr><td><strong>No Pengajuan</strong></td>";
				$str .= "<td>{$data['nomor_pengajuan']}</td></tr>";

				$str .= "<tr><td><strong>Nama</strong></td>";
				$str .= "<td>{$data['nama']}</td></tr>";

				$str .= "<tr><td><strong>NIK</strong></td>";
				$str .= "<td>{$data['nik']}</td></tr>";

				$str .= "<tr><td><strong>Jenis Kelamin</strong></td>";
				$str .= "<td>{$data['jenis_kelamin']}</td></tr>";

				$str .= "<tr><td><strong>Alamat</strong></td>";
				$str .= "<td>{$data['alamat']}</td></tr>";

				$str .= "<tr><td><strong>Kota</strong></td>";
				$str .= "<td>{$data['kota']}</td></tr>";

				$str .= "<tr><td><strong>Kewarganegaraan</strong></td>";
				$str .= "<td>{$data['kewarganegaraan']}</td></tr>";

				$str .= "<tr><td><strong>Total Pinjaman</strong></td>";
				$str .= "<td>".number_format($data['nominal'], 2, ',', '.')."</td></tr>";

				$str .= "<tr><td><strong>Tanggal Pengajuan</strong></td>";
				$str .= "<td>{$data['tanggal_pengajuan']}</td></tr>";

				$str .= "<tr><td><strong>Jatuh Tempo</strong></td>";
				$str .= "<td>{$data['tanggal_jatuh_tempo']}</td></tr>";

				$str .= "<tr><td><strong>Durasi</strong></td>";
				$str .= "<td>{$data['jangka_waktu']}</td></tr>";

				$str .= "<tr><td><strong>Jumlah Angsuran</strong></td>";
				$str .= "<td>".number_format($data['total_angsuran'], 2, ',', '.')."</td></tr>";

				$str .= "<tr><td><strong>Status</strong></td>";
				$str .= "<td>{$data['status']}</td></tr>";
		}else{
			// jika data tidak ada
			$str = "<tr><td>No Data</td></tr>";
		}
		echo $str;
	}

	
} 

?>

