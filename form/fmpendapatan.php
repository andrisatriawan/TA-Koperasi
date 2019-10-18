<?php
$today = date('Y-m-d');

$sqlpendapatan = mysql_query("select * from tb_pendapatan where tanggal = '$today' and nip = '$id_login'") or die(mysql_error());
$datapendapatan = mysql_fetch_array($sqlpendapatan);
$cek = mysql_num_rows($sqlpendapatan);
if ($cek>=1){
  ?>
  <script type="text/javascript">
    alert("Anda sudah mengisi laporan harian hari ini");
    window.location.href="?content=pendapatan";
  </script>
<?php
}else{
?>
<div class="row">
  <div class="col-md-6 col-md-offset-3 keliling">
    <h1 style="padding:10px 0;">Data Pendapatan</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="NIP">NIP</label>
        <input type="text" class="form-control" id="NIP" placeholder="NIP" name="nip" value="<?php echo $id_login; ?>" disabled='disabled'>
      </div>
      <div class="form-group">
        <label for="nama">Nama Karyawan</label>
        <input type="text" class="form-control" id="nama" placeholder="Nama Karyawan" name="nama" value="<?php echo $nama_karyawan; ?>" disabled='disabled'>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $today ?>" disabled='disabled'>
      </div>
      <div class="form-group">
        <label for="laporan">Pendapatan Harian</label>
        <input type="text" class="form-control" id="laporan" placeholder="Pendapatan Harian" name="pendapatan_harian">
      </div>
      <input class="btn btn-default" type="submit" name="tambah" value="Tambah">
    </form>
    <?php
    $pendapatan_harian = @$_POST['pendapatan_harian'];
    $tambah = @$_POST['tambah'];

    if ($tambah){
      if ($pendapatan_harian==""){
        ?>
          <script type="text/javascript">
            alert("Inputan tidak boleh kosong");
          </script>
        <?php
      }else{
        mysql_query("insert into tb_pendapatan values ('$id_login','$nama_karyawan', '$today', '$pendapatan_harian')") or die(mysql_error());
        ?>
        <script type="text/javascript">
           alert("Berhasil disimpan");
          window.location.href="?content=pendapatan";
        </script>
        <?php
      }
    }
    ?>
  </div>
</div>
<?php } ?>