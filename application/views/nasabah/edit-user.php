  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Edit User
        <small>Perbaruan data user</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Data User</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php if(isset($_SESSION['val_user']) AND $_SESSION['val_user']['flag'] === false) : ?>
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Peringatan !</h4>
                <?php echo $_SESSION['val_user']['value']; ?>
        </div>
        <?php unset($_SESSION['val_user']); ?>
      <?php endif; ?>
      <div class="box box-primary">
        <div class="box-header with-border">
           <h3 class="box-title"><i class="fa fa-pencil-square-o"></i> Input data user</h3>
        </div>
        <div class="box-body">
          <form action="<?php echo base_url();?>index.php/c_action/edit_user" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                  <label>ID</label>
                  <input type="text" class="form-control" value="<?=$data[0]['id_login'];?>" name="id" readonly>
            </div>
            <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" value="<?=$data[0]['nama'];?>" name="nama" autocomplete="off" >
            </div>
            <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" value="<?=$data[0]['username'];?>" name="username" autocomplete="off" >
            </div>
            <div class="form-group">
                  <label>Input Password Baru*</label>
                  <input type="password" class="form-control" name="password" autocomplete="off" required>
            </div>
            <div class="form-group">
                  <label>Input Foto Baru</label>
                  <input type="file" class="form-control" name="file">
            </div>
            <div class="form-group">
                  <label>Tipe User</label>
                  <select class="form-control" name="tipe">
                    <?php if($data[0]['tipe'] == 'admin'):?>
                      <option value="admin">Admin</option>
                      <option value="kepala">Kepala</option>
                    <?php else :?>
                      <option value="kepala">Kepala</option>
                      <option value="admin">Admin</option>
                    <?php endif;?>
                  </select>
            </div>
            <div class="form-group">
                  <input type="submit" value="Simpan Perubahan" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

