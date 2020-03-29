<?php
  function get_nama_nasabah($id, $value){
    return "<option value='$id'>".$value."<option>";
  }
?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Edit Pengajuan
        <small>Form pembaharuan pengajuan nasabah</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pengajuan</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php if(isset($_SESSION['val_pengajuan']) AND $_SESSION['val_pengajuan']['flag'] === false) : ?>
        <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Peringatan !</h4>
                <?php echo $_SESSION['val_pengajuan']['value']; ?>
        </div>
        <?php unset($_SESSION['val_pengajuan']); ?>
      <?php endif; ?>
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pembaharuan pengajuan</h3>
            </div>
            <form method="POST" action="<?php echo base_url();?>index.php/c_action/ubah_pengajuan">
            <div class="box-body">
               <div class="form-group">
                  <label>ID Pengajuan</label>
                  <input type="text" class="form-control" name="id_pengajuan" autocomplete="off" value="<?=$result[0]['id_pengajuan']; ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Nama Nasabah</label>
                  <select id="data_barang" class="form-control select2" name="id_nasabah" style="width:100%;">
                    <?php echo get_nama_nasabah($result[0]['id_nasabah'], $result[0]['nama']); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tanggal Pengajuan</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right tgl-1" id="datepicker" name="tanggal_pengajuan" value="<?=$result[0]['tanggal_pengajuan']; ?>" required autocomplete="off">
                  </div>
                </div>
                <div class="form-group">
                  <label>Tanggal Jatuh Tempo</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right tgl-2" id="datepicker2" name="tanggal_jatuh_tempo" value="<?=$result[0]['tanggal_jatuh_tempo']; ?>" required autocomplete="off">
                  </div>
                </div>
                <div class="form-group">
                  <label>Nominal</label>
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" name="nominal" autocomplete="off" value="<?=$result[0]['nominal']; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label>Jangka Waktu</label>
                  <input type="text" class="form-control" name="jangka_waktu" autocomplete="off" id="jangka_waktu" value="<?=$result[0]['jangka_waktu']; ?>" required>
                </div>
                <div class="form-group">
                  <label>Total Angsuran</label>
                  <div class="input-group">
                    <span class="input-group-addon">Rp.</span>
                    <input type="text" class="form-control" autocomplete="off" name="total_angsuran" value="<?=$result[0]['total_angsuran']; ?>" required>
                  </div>
                </div> 
            </div>
            <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              </div>
            </form>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <script>
    function ajaxRequest( callback ){
      var today = $('.tgl-1').val(),
      booking = $('.tgl-2').val();
      var url = "<?php echo base_url();?>index.php/c_action/get_jangka_waktu";
      $.ajax({
        type: "get",
          url: url,
          data:"today="+today+"&booking="+booking,
          beforeSend:function(){
            $('#jangka_waktu').val('Loading...');
          },
          success:function( result ){
            callback( result );
          }
        });
      }
  </script>
  <!-- /.content-wrapper -->
