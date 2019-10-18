<?php
  $cariid = mysql_query("select * from tb_pelatihan order by idpelatihan desc") or die (mysql_error());
  $dataid = mysql_fetch_array($cariid);
  if ($dataid){
    $nilaiid = substr($dataid[0], -4);
    $id = (int) $nilaiid;
    $id = $id + 1;
    $hasilid = $id_login ."_" .str_pad($id, 4, "0", STR_PAD_LEFT);
  }else{
    $hasilid = $id_login ."_0001";
  }
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
        <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Pelatihan" name="tgl_pel">
      </div>
      <div class="form-group">
        <label for="topik">Topik Pelatihan</label>
        <input type="text" class="form-control" id="topik" placeholder="Topik Pelatihan" name="topik">
      </div>
      <div class="form-group">
        <label for="penyelenggara">Penyelenggara</label>
        <input type="text" class="form-control" id="penyelenggara" placeholder="Penyelenggara" name="penyelenggara">
      </div>
      <div class="form-group">
        <label for="hasil">Hasil Pelatihan</label>
        <input type="text" class="form-control" id="hasil" placeholder="Hasil Pelatihan" name="hasil">
      </div>
      <input class="btn btn-default" type="submit" name="tambah" value="Tambah">
    </form>

    <?php
    $tgl_pel = @$_POST['tgl_pel'];
    $topik = @$_POST['topik'];
    $penyelenggara = @$_POST['penyelenggara'];
    $hasil = @$_POST['hasil'];
    $tambah = @$_POST['tambah'];

    if ($tambah){
      if ($tgl_pel==""||$topik==""||$penyelenggara==""|| $hasil==""){
        ?>
          <script type="text/javascript">
            alert("Inputan tidak boleh kosong");
          </script>
        <?php
      }else{
        mysql_query("insert into tb_pelatihan values ('$hasilid','$id_login', '$tgl_pel', '$topik', '$penyelenggara', '$hasil')") or die(mysql_error());
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