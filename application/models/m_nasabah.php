<?php
	class M_nasabah extends CI_Model{
		private function redirect_id_nasabah(){
			$sql = "select max(id_nasabah) as maxKode from nasabah";
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
			$char = "NSBH";
			$kodeBarang = $char."".sprintf("%04s", $no);
			return $kodeBarang;
		}
		private function redirect_id_pengajuan(){
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
			$char = "PNJN";
			$kodeBarang = $char."".sprintf("%04s", $no);
			return $kodeBarang;
		}
	    function tambah_nasabah($param){
	    	$per['id_nasabah'] = $this->redirect_id_nasabah();
	    	$data = array_merge($per, $param);
	    	$str = $this->db->insert_string('nasabah', $data);
	    	return $this->db->query($str);
	    }
	    function tambah_pengajuan($param){
	    	$per['id_pengajuan'] = $this->redirect_id_pengajuan();
	    	$per['status'] = 'belum';
	    	$data = array_merge($per, $param);
	    	$str = $this->db->insert_string('pengajuan', $data);
	    	return $this->db->query($str);
	    }
	    function tambah_user($param){
	    	$str = $this->db->insert_string('user', $param);
	    	return $this->db->query($str);
	    }

	    function select_data_nasabah(){
	    	$query = "SELECT * from nasabah LIMIT 50";
	    	$data = $this->db->query($query);
	    	$num = $data->num_rows();
	    	return ($num > 0) ? $data->result_array() : 0;
	    }
	    function get_data_nasabah($param){
	    	$id = $param;
	    	$query = "SELECT * FROM nasabah WHERE id_nasabah = '$id'";
	    	$sql = $this->db->query($query);
	    	$num = $sql->num_rows();
	    	return ($num > 0) ? $sql->result_array() : 0;
	    }
	    function ambil_data_nasabah_select(){
			$q = "";
			$query = "SELECT id_nasabah, nama FROM nasabah";
			$sql = $this->db->query($query);
			$batas = 10;
			$count = $sql->num_rows();
			if($count > $batas){
				$hal = ceil($count / $batas);
				for($index=1; $index<=$hal; $index++){
					$indexFirst = ($index * $batas) - $batas;
					$query = "SELECT id_nasabah, nama FROM nasabah LIMIT $indexFirst, $batas";
					$sql = $this->db->query($query);
					$result = $sql->result_array();
					foreach ($result as $data) {
						$q.="<option value='".$data['id_nasabah']."'>".$data['nama']."</option>";
					}
				}
			}else{
				$result = $sql->result_array();
				foreach ($result as $data) {
					$q.="<option value='".$data['id_nasabah']."'>".$data['nama']."</option>";
				}
			}
			return $q;
		}
		function data_pengajuan(){
			$query = "SELECT a.id_pengajuan, a.nomor_pengajuan, b.nama, b.pekerjaan, a.tanggal_pengajuan, a.tanggal_jatuh_tempo, a.nominal, a.total_angsuran, a.status FROM pengajuan a, nasabah b WHERE a.id_nasabah = b.id_nasabah";
			$sql = $this->db->query($query);
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
			}else{
				$data = false;
			}
			return $data;
		}
		function data_pengajuan_(){
			$query = "SELECT a.id_pengajuan, a.nomor_pengajuan, b.nama, b.pekerjaan, a.tanggal_pengajuan, a.tanggal_jatuh_tempo, a.jangka_waktu, a.nominal, a.total_angsuran, a.status FROM pengajuan a, nasabah b WHERE a.id_nasabah = b.id_nasabah AND a.status = 'belum'";
			$sql = $this->db->query($query);
			if($sql->num_rows() > 0){
				$data = $sql->result_array();
			}else{
				$data = false;
			}
			return $data;
		}
		function get_data_pengajuan($param){
			$id = trim($param);
			$query = "SELECT a.id_pengajuan, a.id_nasabah, b.nama, a.tanggal_pengajuan, a.tanggal_jatuh_tempo, a.nominal, a.jangka_waktu, a.total_angsuran FROM pengajuan a, nasabah b WHERE b.id_nasabah = a.id_nasabah AND a.id_pengajuan = '$id'";
			$sql = $this->db->query($query);
			if($sql->num_rows() == 1){
				$data = $sql->result_array();
			}else{
				$data = false;
			}
			return $data;
		}
		function get_user_login($username, $password){
			$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
			$sql = $this->db->query($query);
			return $sql;
		}
		function get_data_user(){
			$query = "SELECT * FROM user";
			$sql = $this->db->query($query);
			return $sql;
		}
		function ambil_data_user($param){
	    	$sql = $this->db->query("SELECT * FROM user WHERE id_login = '$param'");
	    	if($sql->num_rows() > 0){
	    		$data = $sql->result_array();
	    	}else{
	    		$data = false;
	    	}
	    	return $data;
	    }
	    function ubah_data_user($param, $id){
	    	$this->db->where('id_login', $id['id_login']);
	    	return $this->db->update('user', $param);
	    }

	}
?>