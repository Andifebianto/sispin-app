  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Laporan
        <small>Kelola laporan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Laporan</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-header with-border">
            <i class="fa fa-print"></i> <h3 class="box-title">Form Cetak Laporan</h3>
        </div>
        <div class="box-body">
          <form role="form" action="<?=base_url().'index.php/c_action/print_laporan'?>" method="POST">
              <div class="form-group">
                <label>Kategori Laporan</label>
                <select class="form-control" name="kategori" id="kategori">
                  <option value="nasabah">Nasabah</option>
                  <option value="pengajuan">Pengajuan</option>
                </select>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group status" style="display:none;">
                    <label>Kategori Status</label>
                    <select class="form-control" name="status">
                      <option value="sudah">Sudah Acc</option>
                      <option value="belum">Belum Acc</option>
                    </select>
              </div>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
              </div>
          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
  function load_function(){
    var kategori = document.getElementById('kategori');
    kategori.onchange = function(e){
    var status = e.target.parentNode.nextElementSibling.children[0].children[0];
    if(this.value == 'pengajuan'){
      if(status.style.display == 'none'){
        status.style.display = 'block';
      } 
    }else{
      status.style.display = 'none';
    }
   }
  }
  window.onload = function(){
    load_function();
  }
  </script>
