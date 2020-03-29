<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_proses extends CI_Controller {
	function insert(){
		$data = array(
			'nama' => $_POST['nama'], 
			'nip' => $_POST['nip'], 
			'nama_barang' => $_POST['nama_barang'],
			'kode_barang' => $_POST['kode_barang'],
			'ukuran' => $_POST['ukuran'],
			'jumlah' => $_POST['jumlah'],
			'warna' => $_POST['warna'],
			'buyer' => $_POST['buyer']
		);
		$str = $this->db->insert_string('produksi', $data);
		if($this->db->query($str)){
			redirect('Ctrl_app/daftar');
		}else{
			// fail
			
		}
	}
	function update(){
		$id = $_GET['id'];
		$data = array(
			'nama' => $_POST['nama'], 
			'nip' => $_POST['nip'], 
			'nama_barang' => $_POST['nama_barang'],
			'kode_barang' => $_POST['kode_barang'],
			'ukuran' => $_POST['ukuran'],
			'jumlah' => $_POST['jumlah'],
			'warna' => $_POST['warna'],
			'buyer' => $_POST['buyer']
		);
		if($this->db->update('produksi', $data, array('id' => $id))){
			redirect('Ctrl_app/daftar');
		}else{
			redirect("Ctrl_app/editable?id=$id");
		}
	}
	function hapus(){
		$id = $_GET['id'];
		if($this->db->query("delete from produksi where id=$id")){
			redirect('Ctrl_app/daftar');
		}else{
			redirect('Ctrl_app/daftar');
			echo '<script>alert("Sistem gagal menghapus data...");</script>';
		}
	}
	function loginProses(){
		if(isset($_POST['username']) and isset($_POST['password'])){
			$query = "SELECT * FROM user where username='".$_POST['username']."' and password='".$_POST['password']."'";
			$sql = $this->db->query($query);
			if($sql->num_rows() == 1){
				$result = $sql->result_array();
				$username = $result[0]['username'];
				$nama = $result[0]['nama'];
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('nama', $nama);
				redirect('Ctrl_app/home');
			}else{
				// bila username tidak ditemukan
				$data['ket'] = false;
				redirect('Ctrl_app');
			}
				
		}else{
			$this->load->view('Ctrl_app/login');
		}
	}
}
