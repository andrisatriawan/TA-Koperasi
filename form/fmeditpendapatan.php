<?php
$tgl = @$_GET['tgl'];

$sqlpend=mysql_query("select * from tb_pendapatan where tanggal = '$tgl' and nip = '$id_login'") or die(mysql_error());
$datapend = mysql_fetch_array($sqlpend);
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
        <input type="text" class="form-control" id="nama" placeholder="Nama Karyawan" name="nama" value="<?php echo $datapend['nama']; ?>" disabled='disabled'>
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" value="<?php echo $tgl ?>" disabled='disabled'>
      </div>
      <div class="form-group">
        <label for="laporan">Pendapatan Harian</label>
        <input type="text" class="form-control" id="laporan" placeholder="Pendapatan Harian" name="pend_harian" value="<?php echo $datapend['pendapatanharian'] ?>">
      </div>
      <input class="btn btn-default" type="submit" name="simpan" value="Simpan">
    </form>
  </div>
</div>
<?php
$nama = $nama_karyawan;
$pend_harian = @$_POST['pend_harian'];
$simpan = @$_POST['simpan'];

if ($simpan){
  if ($pend_harian==""){
    ?>
      <script type="text/javascript">
        alert("Inputan tidak boleh kosong");
      </script>
    <?php
  }else{
    mysql_query("update tb_pendapatan set nama = '$nama', pendapatanharian ='$pend_harian' where tanggal = '$tgl' and nip = '$id_login' ") or die(mysql_error());
    ?>
    <script type="text/javascript">
      alert("Berhasil diubah!");
      window.location.href="?content=pendapatan";
    </script>
    <?php
  }
}
?>