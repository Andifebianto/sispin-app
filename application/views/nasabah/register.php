  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Register
        <small>Input data nasabah</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Register</a></li>
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
      <?php endif; ?>
      <?php if(isset($_SESSION['val_user']) AND $_SESSION['val_user']['flag'] === true) : ?>
          <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Sukses !</h4>
                <?php echo $_SESSION['val_user']['value']; ?>
        </div>
      <?php endif; ?>
      <?php unset($_SESSION['val_user']); ?>
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambahkan Data Nasabah</h3>
            </div>
            <form role="form" method="post" action="<?php echo base_url()?>index.php/permalink/insertdata">
              <div class="box-body">
                <div class="form-group">
                  <label>Nama*</label>
                  <input type="text" class="form-control" name="nama" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>NIK*</label>
                  <input type="text" class="form-control" name="nik" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>No.Telp*</label>
                  <input type="text" class="form-control" name="no_telp" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Tempat Lahir*</label>
                  <input type="text" class="form-control" name="tempat_lahir" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Tanggal Lahir*</label>
                  <div class="row">
                    <div class="col-xs-2">
                      <select class="form-control" name="tgl">
                        <option>Tanggal</option>
                        <option value="01">1</option>
                        <option value="02">2</option>
                        <option value="03">3</option>
                        <option value="04">4</option>
                        <option value="05">5</option>
                        <option value="06">6</option>
                        <option value="07">7</option>
                        <option value="08">8</option>
                        <option value="09">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <select class="form-control" name="bln">
                        <option>Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">Septermber</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                    <div class="col-xs-2">
                      <select class="form-control" name="thn">
                        <option>Tahun</option>
                        <option value="1980">1980</option>
                        <option value="1981">1981</option>
                        <option value="1982">1982</option>
                        <option value="1983">1983</option>
                        <option value="1984">1984</option>
                        <option value="1985">1985</option>
                        <option value="1986">1986</option>
                        <option value="1987">1987</option>
                        <option value="1988">1988</option>
                        <option value="1989">1989</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                      </select>
                    </div>
                </div>
                </div>
                <div class="form-group">
                  <label>Jenis Kelamin</label>
                  <select class="form-control" name="jenis_kelamin">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Alamat*</label>
                  <input type="text" class="form-control" name="alamat" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Kota*</label>
                  <input type="text" class="form-control" name="kota" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Status Perkawinan</label>
                  <input type="text" class="form-control" name="status_perkawinan" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Kewarganegaraan*</label>
                  <input type="text" class="form-control" name="kewarganegaraan" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Pekerjaan*</label>
                  <input type="text" class="form-control" name="pekerjaan" value="" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Penghasilan*</label>
                  <input type="text" class="form-control" name="penghasilan" placeholder="" autocomplete="off" required>
                </div>
                <div class="form-group">
                  <label>Tunjangan</label>
                  <input type="text" class="form-control" name="tunjangan" placeholder="" autocomplete="off" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
