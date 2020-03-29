  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
<?php
  
?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data User
        <small>Kelola data user</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Kelola User</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID.User</th>
                  <th>Nama</th>
				          <th>Username</th>
                  <th>Password</th>
                  <th>Foto</th>
                  <th>Tipe</th>
                  <th class="opsi">Opsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    if($data){
                      foreach ($data as $value) {
                        ?>
                        <tr>
                          <td><?=$value['id_login'];?></td>
                          <td><?=$value['nama'];?></td>
						              <td><?=$value['username'];?></td>
                          <td><?=$value['password'];?></td>
                          <td><?=$value['foto'];?></td>
                          <td><?=$value['tipe'];?></td>
                          <td>
                            <a href="<?php echo base_url();?>index.php/permalink/edit_data_user/<?=$value['id_login'];?>">
                            <button type="button" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o"></i></button></a>

                            <a href="<?php echo base_url();?>index.php/c_action/hapus_user/<?=$value['id_login'];?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?');">
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
  <script>
    window.onload = function(){
      $('#example2').DataTable();
    }
  </script>
