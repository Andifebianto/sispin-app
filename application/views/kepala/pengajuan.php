  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
<?php
  function set_button($status, $id_pengajuan){
    if(trim($status) == 'belum'){
      $str = "<button type='button' alt='$id_pengajuan' class='btn btn-warning btn-xs' id='get_acc' ><i class='fa fa-spinner'></i> Beri Acc</button>";
    }else{
      $str = "<button type='button' alt='$id_pengajuan' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Sudah Acc</button>";
    }
    return $str;
  }
  function set_button_info($id_pengajuan){
    return "<button data-no='{$id_pengajuan}' class='btn btn-info btn-xs' data-toggle='modal' data-target='#modal-default' onClick = 'get_info(event)'><i class='fa fa-eye' data-no='{$id_pengajuan}'></i> Lihat Data</button>";
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
                  <th>Jangka Waktu</th>
                  <th>Nominal</th>
                  <th>Total Angsuran</th>
                  <th class="opsi">Opsi</th>
                  <th class="Info">Info</th>
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
                          <td><?=$value['jangka_waktu'];?></td>
                          <td><?=$value['nominal'];?></td>
                          <td><?=$value['total_angsuran'];?></td>
                          <td>
                            <?php echo set_button($value['status'], $value['id_pengajuan']);?>
                          </td>
                          <td>
                            <?=set_button_info($value['nomor_pengajuan']); ?>
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
  <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Info Nasabah</h4>
              </div>
              <div class="modal-body">
                <p class="modal-loader" style="display: none;">Loading...</p>
                <table class="table table-bordered table-striped Tmodal">
                <tbody>
                  
              </tbody>
            </table>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
</div>
  <!-- /.content-wrapper -->
  <script type="text/javascript">
    function ajax_ubah_status(btn, id, callback){
      var url = "<?php echo base_url();?>index.php/c_action/ubah_status";
      $.ajax({
        type: "get",
          url: url,
          data:"id_pengajuan="+id,
          beforeSend:function(){
            btn[0].disabled = true;
            btn.html('Loading...');
          },
          success:function( result ){
            btn[0].disabled = false;
            callback( result );
          }
        });
    }
    function get_info(e){
      var id = e.target.dataset.no,
      url = "<?=base_url();?>index.php/c_action/get_join_data_nasabah/"+id;
      $.ajax({
        type:'get',
        url:url,
        data:'',
        beforeSend:function(){
          $('table.Tmodal').hide();
          $('.modal-loader').show();
        },
        success:function(result){
          $('table.Tmodal').show().
          find('tbody').html( result );
          $('.modal-loader').hide();
        }
      }).fail(function(){
        alert('Server sedang bermasalah');
      });
    }
  </script>
