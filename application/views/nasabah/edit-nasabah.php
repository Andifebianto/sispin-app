<?php
  function load_tanggal($tgl){
    $range = range(1, 31);
    $tag = "";
    $d = (int) $tgl;
    $tag .= '<option value="'.$tgl.'">'.$d.'</option>';
    foreach ($range as $value) {
      if($value != $d){
        $tglsprint = sprintf("%02s", $value);
        $tag.= '<option value="'.$tglsprint.'">'.$value.'</option>';
      }
    }
    return $tag;
  }
  function load_bulan($bln){
    $range = range(1, 12);
    $tag = "";
    $d = (int) $bln;
    $tag .= '<option value="'.$bln.'">'.$d.'</option>';
    foreach ($range as $value) {
      if($value != $d){
        $blnsprint = sprintf("%02s", $value);
        $tag.= '<option value="'.$blnsprint.'">'.$value.'</option>';
      }
    }
    return $tag;
  }
  function load_tahun($thn){
    $range = range(1980, 2005);
    $tag = '<option value="'.$thn.'">'.$thn.'</option>';
    foreach ($range as $value) {
      if($value != $thn){
        $tag.= '<option value="'.$value.'">'.$value.'</option>';
      }
    }
    return $tag;
  }
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Edit Nasabah
        <small>Ubah data nasabah</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Register</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php if(isset($_SESSION['val_nasabah']) AND $_SESSION['val_nasabah']['flag'] === false) : ?>
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Peringatan !</h4>
                <?php echo $_SESSION['val_nasabah']['value']; ?>
        </div>
        <?php unset($_SESSION['val_nasabah']); ?>
      <?php endif; ?>
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pembaharuan Data Nasabah</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="<?php echo base_url()?>index.php/c_action/ubahdata">
              <div class="box-body">
                <div class="form-group">
                  <label>ID Nasabah</label>
                  <input type="text" class="form-control" name="id_nasabah" value="<?=$data[0]['id_nasabah'];?>" autocomplete="off" readonly>
                </div>
                <div class="form-group">
                  <label>Nama*</label>
                  <input type="text" class="form-control" name="nama" value="<?=$data[0]['nama'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>NIK*</label>
                  <input type="text" class="form-control" name="nik" value="<?=$data[0]['nik'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>No.Telp*</label>
                  <input type="text" class="form-control" name="no_telp" value="<?=$data[0]['no_telp'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Tempat Lahir*</label>
                  <input type="text" class="form-control" name="tempat_lahir" value="<?=$data[0]['tempat_lahir'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir*</label>
                  <div class="row">
                    <div class="col-xs-2">
                      <select class="form-control" name="tgl">
                        <?php echo load_tanggal($data[0]['tanggal']); ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <select class="form-control" name="bln">
                        <?php echo load_bulan($data[0]['bulan']); ?>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <select class="form-control" name="thn">
                        <?php echo load_tahun($data[0]['tahun']); ?>
                      </select>
                    </div>
                </div>
                </div>
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin">
                    <?php 
                      if($data[0]['jenis_kelamin'] == 'perempuan'){
                        echo "<option value='perempuan'>Perempuan</option>";
                        echo "<option value='laki-laki'>Laki-laki</option>";
                      } else {
                        echo '<option value="laki-laki">Laki-laki</option>';
                        echo '<option value="perempuan">Perempuan</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Alamat*</label>
                  <input type="text" class="form-control" name="alamat" value="<?=$data[0]['alamat'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Kota*</label>
                  <input type="text" class="form-control" name="kota" value="<?=$data[0]['kota'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Status Perkawinan</label>
                  <input type="text" class="form-control" name="status_perkawinan" value="<?=$data[0]['status_perkawinan'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Kewarganegaraan*</label>
                  <input type="text" class="form-control" name="kewarganegaraan" value="<?=$data[0]['kewarganegaraan'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Pekerjaan*</label>
                  <input type="text" class="form-control" name="pekerjaan" value="<?=$data[0]['pekerjaan'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Penghasilan*</label>
                  <input type="text" class="form-control" name="penghasilan" value="<?=$data[0]['penghasilan'];?>" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Tunjangan</label>
                  <input type="text" class="form-control" name="tunjangan" value="<?=$data[0]['tunjangan'];?>" autocomplete="off" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
