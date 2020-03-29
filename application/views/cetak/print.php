<?php
	function rupiah($angka){
		$result = "".number_format($angka, 2, ',', '.');
		return $result;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Data Barang</title>
	<style type="text/css">
		body{
			font-family:arial, 'Times-serif';
		}
		#container{
			display: block;
		}
		.tabel{
			border-collapse: collapse;
			font-family: arial;
			width:100%;
			margin-top:12px;
		}
		.tabel thead tr th{
			border:1px solid gray;
			height: 30px;
			background-color:rgb(233, 234, 252);
		}
		.tabel tbody tr td{
			border:1px solid gray;
		}
		.center{
			text-align: center;
		}
		.header{
			text-align: center;
			margin-top:5px;
			margin-bottom:9px;
		}
		.store{
			text-align:center;
			display:block;
			font-size:20px;
			font-family:arial;
			color:rgb(60, 141, 188);
		}
		.tag{
			text-align:right;
			display:block;
			font-family:arial;
			font-size:10px;
		}
		.deskripsi{
			width:100%;
		}.deskripsi tr td{
			height:12px;
		}
		.alamat {
			width:100%;
			text-align:center;
		}.alamat span{
			font-size:12px;
		}
		.user{
			font-weight:bold;
			font-size:12px;
			margin-bottom:9px;
		}
	</style>
</head>
<body>
	<span class="store"><strong>CV PROPERTY</strong></span>
	<h3 class='header'>Laporan Data Barang</h3>
	<hr style="margin:3px;"></hr>
	<div class="alamat">
		<span>Alamat perusahaan</span>
	</div>
	<div id='container'>
		<table class='tabel'>
			<thead>
				<tr>
                  <th style="font-size:14px;">Nama</th>
                  <th style="font-size:14px;">NIP</th>
                  <th style="font-size:14px;">Nama Barang</th>
				  <th style="font-size:14px;">Kode Barang</th>
				  <th style="font-size:14px;">Ukuran</th>
				  <th style="font-size:14px;">Jumlah</th>
                  <th style="font-size:14px;">Warna</th>
                  <th style="font-size:14px;">Buyer</th>
				</tr>
			</thead>
			<tbody>
				<?php
                foreach ($data as $key) {
                  ?>
                  <tr>
                    <td>
						<?php echo $key['nama'];?>
					</td>
					<td>
						<center><?php echo $key['nip'];?></center>
					</td>
					<td>
						<center><?php echo $key['nama_barang'];?></center>
					</td>
					<td>
						<center><?php echo $key['kode_barang'];?></center>
					</td>
					<td>
						<center><?php echo $key['ukuran'];?></center>
					</td>
					<td>
						<center><?php echo $key['jumlah'];?></center>
					</td>
					<td>
						<center><?php echo $key['warna'];?></center>
					</td>
					<td>
						<center><?php echo $key['buyer'];?></center>
					</td>
                  </tr>
                  <?php } ?>
			</tbody>
		</table>
	</div>
</body>
</html>