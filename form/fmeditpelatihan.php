<?php
$idpel = @$_GET['kode'];

$sqlpel=mysql_query("select * from tb_pelatihan where idpelatihan = '$idpel'") or die(mysql_error());
$datapel = mysql_fetch_array($sqlpel);
?>

<div class="row">
  <div class="col-md-6 col-md-offset-3 keliling">
    <h1 style="padding:10px 0;">Data Pelatihan</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="NIP">NIP</label>
        <input type="text" class="form-control" id="NIP" placeholder="NIP" name='nip' value="<?php echo $id_login; ?>" disabled="disabled">
      </div>
      <div class="form-group">
        <label for="tanggal">Tanggal Pelatihan</label>
        <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pelatihan" name="tgl_pel" value="<?php echo $datapel['tanggal'] ?>">
      </div>
      <div class="form-group">
        <label for="topik">Topik Pelatihan</label>
        <input type="text" class="form-control" id="topik" placeholder="Topik Pelatihan" name="topik" value="<?php echo $datapel['topik'] ?>">
      </div>
      <div class="form-group">
        <label for="penyelenggara">Penyelenggara</label>
        <input type="text" class="form-control" id="penyelenggara" placeholder="Penyelenggara" name="penyelenggara" value="<?php echo $datapel['penyelenggara'] ?>">
      </div>
      <div class="form-group">
        <label for="hasil">Hasil Pelatihan</label>
        <input type="text" class="form-control" id="hasil" placeholder="Hasil Pelatihan" name="hasil" value="<?php echo $datapel['hasil'] ?>">
      </div>
      <input class="btn btn-default" type="submit" name="simpan" value="Simpan">
    </form>
    <?php
    $tgl_pel = @$_POST['tgl_pel'];
    $topik = @$_POST['topik'];
    $penyelenggara = @$_POST['penyelenggara'];
    $hasil = @$_POST['hasil'];
    $simpan = @$_POST['simpan'];

    if ($simpan){
      if ($tgl_pel==""||$topik==""||$penyelenggara==""|| $hasil==""){
        ?>
          <script type="text/javascript">
            alert("Inputan tidak boleh kosong");
          </script>
        <?php
      }else{
        mysql_query("update tb_pelatihan set nip = '$id_login', tanggal = '$tgl_pel', topik = '$topik', penyelenggara ='$penyelenggara', hasil='$hasil' where idpelatihan = '$idpel' ") or die(mysql_error());
        ?>
        <script type="text/javascript">
           alert("Berhasil disimpan");
          window.location.href="?content=pelatihan";
        </script>
        <?php
      }
    }
    ?>
  </div>
</div>