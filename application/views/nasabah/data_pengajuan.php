  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
<?php
  function set_label($status){
    if(trim($status) == 'belum'){
      $str = '<span class="label bg-red">'.$status.'</span>';
    }else{
      $str = '<span class="label bg-green">'.$status.'</span>';
    }
    return $str;
  }
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Pengajuan
        <small>Kelola data pengajuan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Data pengajuan</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.Pengajuan</th>
                  <th>Nama</th>
				  <th>Pekerjaan</th>
                  <th>Tgl.Pengajuan</th>
                  <th>Tgl.Jatuh Tempo</th>
                  <th>Nominal</th>
                  <th>Total Angsuran</th>
                  <th>Status</th>
                  <th class="opsi">Opsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if($data){
                      foreach ($data as $value) {
                        ?>
                        <tr>
                          <td><?=$value['nomor_pengajuan'];?></td>
                          <td><?=$value['nama'];?></td>
						  <td><?=$value['pekerjaan'];?></td>
                          <td><?=$value['tanggal_pengajuan'];?></td>
                          <td><?=$value['tanggal_jatuh_tempo'];?></td>
                          <td><?=$value['nominal'];?></td>
                          <td><?=$value['total_angsuran'];?></td>
                          <td><?=set_label($value['status']);?></td>
                          <td>
                            <a href="<?php echo base_url();?>index.php/permalink/edit_pengajuan/<?=$value['id_pengajuan']; ?>" >
                            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button></a>

                            <a href="<?php echo base_url()?>index.php/c_action/hapus_pengajuan/<?=$value['id_pengajuan']; ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?');">
                              <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                            </a>
                          </td>
                        </tr>
                  <?php
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
