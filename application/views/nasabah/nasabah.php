  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data Nasabah
        <small>Kelola data nasabah</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Data nasabah</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Nik</th>
                  <th>Alamat</th>
                  <th>Tanggal Lahir</th>
                  <th>Tempat Lahir</th>
                  <th>Kota</th>
                  <th>Status</th>
                  <th>Penghasilan</th>
                  <th>Tunjangan</th>
                  <th class="opsi">Opsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if($data){
                      foreach ($data as $value) {
                        ?>
                        <tr>
                          <td><?=$value['nama'];?></td>
                          <td><?=$value['nik'];?></td>
                          <td><?=$value['alamat'];?></td>
                          <td><?=$value['tanggal_lahir'];?></td>
                          <td><?=$value['tempat_lahir'];?></td>
                          <td><?=$value['kota'];?></td>
                          <td><?=$value['status_perkawinan'];?></td>
                          <td><?=$value['penghasilan'];?></td>
                          <td><?=$value['tunjangan'];?></td>
                          <td>
                            <a href="<?php echo base_url();?>index.php/permalink/edit_nasabah/<?=$value['id_nasabah']; ?>" >
                            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button></a>

                            <a href="<?php echo base_url()?>index.php/c_action/hapus_nasabah/<?php echo $value['id_nasabah'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?');">
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
