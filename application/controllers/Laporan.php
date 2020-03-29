<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('pdf');
		$this->nama = $this->session->nama;
		$this->status = $this->session->tipe;
	}
	private function rupiah($angka){
		$result = "".number_format($angka, 2, ',', '.');
		return $result;
	}
	function nasabah(){
		$pdf = new FPDF('P', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(0, 5,'KSP SAHABAT BINTANG MANDIRI',0,1, 'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(190,8,'Jl.Kanal No.5 Lamper Lor, Semarang, 50242',0,1,'C');

        $pdf->SetFillColor(0,0,0);
        $pdf->Cell(0, 0.5, '', 1, 1, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 0, "DATA NASABAH", 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(90, 4, 'Oleh : '.$this->nama, 0, 0);
        $pdf->Cell(0, 4, 'Tanggal : '.date('d-m-Y'), 0, 1, 'R');
        $pdf->Cell(90, 4, 'Status : '.$this->status, 0, 0);
        $pdf->Cell(0, 4, 'Jam : '.date('H:i:s'), 0, 1, 'R');
        $pdf->Ln(2);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFillColor(108,200,255);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(28,6,'NIK',1,0, 'C', true);
        $pdf->Cell(46,6,'NAMA',1,0, 'C', true);
        $pdf->Cell(27,6,'TANGGAL LHR',1,0, 'C', true);
        $pdf->Cell(32,6,'KOTA',1,0, 'C', true);
        $pdf->Cell(29,6,'PEKERJAAN', 1,0, 'C', true);
        $pdf->Cell(29,6, 'PENGHASILAN',1,1, 'C', true);

        //
        $pdf->SetFillColor(239,171,222);
        $pdf->SetFont('Arial','',8);
       	$fill = false;
       	$querySQL = "SELECT * from nasabah LIMIT 50";
       	$sql = $this->db->query($querySQL);
       	if($sql->num_rows() > 0){
       		$data = $sql->result_array();
       		foreach($data as $value){
       			$pdf->Cell(28,6,$value['nik'] ,1,0, 'L', $fill);
        		$pdf->Cell(46,6,$value['nama'],1,0, 'C', $fill);
        		$pdf->Cell(27,6,$value['tanggal_lahir'],1,0, 'C', $fill);
        		$pdf->Cell(32,6,$value['kota'],1,0, 'C', $fill);
        		$pdf->Cell(29,6,$value['pekerjaan'], 1,0, 'C', $fill);
        		$pdf->Cell(29,6,$this->rupiah($value['penghasilan']),1,1, 'C', $fill);
        		$fill = !$fill;
       		}
       	}
        $pdf->Output();
	}
	function pengajuan($status = ''){
		$pdf = new FPDF('P', 'mm', 'A4');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',16);
        // mencetak string 
        $pdf->Cell(0, 5,'KSP SAHABAT BINTANG MANDIRI',0,1, 'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(190,8,'Jl.Kanal No.5 Lamper Lor, Semarang, 50242',0,1,'C');

        $pdf->SetFillColor(0,0,0);
        $pdf->Cell(0, 0.5, '', 1, 1, 'C', true);

        $pdf->Ln(5);
        $pdf->SetFont('Arial','B',12);
        if(trim($status) == 'sudah'){
        	$pdf->Cell(0, 0, "DATA PENGAJUAN ACC", 0, 1, 'C');
        }else{
        	$pdf->Cell(0, 0, "DATA PENGAJUAN BELUM ACC", 0, 1, 'C');
        }
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(90, 4, 'Oleh : '.$this->nama, 0, 0);
        $pdf->Cell(0, 4, 'Tanggal : '.date('d-m-Y'), 0, 1, 'R');
        $pdf->Cell(90, 4, 'Status : '.$this->status, 0, 0);
        $pdf->Cell(0, 4, 'Jam : '.date('H:i:s'), 0, 1, 'R');
        $pdf->Ln(2);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->SetFillColor(108,200,255);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(28,6,'NO.PENGAJUAN',1,0, 'C', true);
        $pdf->Cell(46,6,'NAMA',1,0, 'C', true);
        $pdf->Cell(27,6,'TGL.PENGAJUAN',1,0, 'C', true);
        $pdf->Cell(32,6,'TGL.JATUH TEMPO',1,0, 'C', true);
        $pdf->Cell(29,6,'NOMINAL', 1,0, 'C', true);
        $pdf->Cell(29,6, 'ANGSURAN',1,1, 'C', true);

        //
        $pdf->SetFillColor(239,171,222);
        $pdf->SetFont('Arial','',8);
        $fill = false;
        if(trim($status) == "sudah"){
        	$querySQL = "SELECT a.nomor_pengajuan, b.nama, a.tanggal_pengajuan, a.tanggal_jatuh_tempo, a.nominal, a.total_angsuran FROM pengajuan a, nasabah b WHERE a.id_nasabah = b.id_nasabah AND a.status = 'sudah'";
        	$sql = $this->db->query($querySQL);
        	if($sql->num_rows() > 0){
        		$data = $sql->result_array();
        		foreach ($data as $value) {
        			$pdf->Cell(28,6,$value['nomor_pengajuan'] ,1,0, 'L', $fill);
        			$pdf->Cell(46,6,$value['nama'],1,0, 'C', $fill);
        			$pdf->Cell(27,6,$value['tanggal_pengajuan'],1,0, 'C', $fill);
        			$pdf->Cell(32,6,$value['tanggal_jatuh_tempo'],1,0, 'C', $fill);
        			$pdf->Cell(29,6,$this->rupiah($value['nominal']), 1,0, 'C', $fill);
        			$pdf->Cell(29,6,$this->rupiah($value['total_angsuran']),1,1, 'C', $fill);
        			$fill = !$fill;
        		}
        	}else{
        		$pdf->Cell(0, 6, "No data", 1, 0, 'C');
        	}
        }else{
        	$querySQL = "SELECT a.nomor_pengajuan, b.nama, a.tanggal_pengajuan, a.tanggal_jatuh_tempo, a.nominal, a.total_angsuran FROM pengajuan a, nasabah b WHERE a.id_nasabah = b.id_nasabah AND a.status = 'belum'";
        	$sql = $this->db->query($querySQL);
        	if($sql->num_rows() > 0){
        		$data = $sql->result_array();
        		foreach ($data as $value) {
        			$pdf->Cell(28,6,$value['nomor_pengajuan'] ,1,0, 'L', $fill);
        			$pdf->Cell(46,6,$value['nama'],1,0, 'C', $fill);
        			$pdf->Cell(27,6,$value['tanggal_pengajuan'],1,0, 'C', $fill);
        			$pdf->Cell(32,6,$value['tanggal_jatuh_tempo'],1,0, 'C', $fill);
        			$pdf->Cell(29,6, $this->rupiah($value['nominal']), 1,0, 'C', $fill);
        			$pdf->Cell(29,6, $this->rupiah($value['total_angsuran']),1,1, 'C', $fill);
        			$fill = !$fill;
        		}
        	}else{
        		$pdf->Cell(0, 6, "No data", 1, 0, 'C');
        	}
        }
        $pdf->Output();
	}
}
?>
