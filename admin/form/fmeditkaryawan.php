<div class="row">
  <div class="col-md-8 col-md-offset-2 keliling">
    <h1 style="padding:10px 0;">Ubah Data Karyawan</h1>
    <?php
    $nip = @$_GET['kode'];

    $sql = mysql_query("select * from tb_karyawan where nip = '$nip'") or die(mysql_error());
    $data = mysql_fetch_array($sql);

    $sql1 = mysql_query("select * from tb_user where nip = '$nip'") or die(mysql_error());
    $data1 = mysql_fetch_array($sql1);
    ?>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="NIP">NIP</label>
        <input type="text" class="form-control" id="NIP" placeholder="NIP" name="nip" value="<?php echo $nip ?>" disabled="disabled">
      </div>
      <div class="form-group">
        <label for="Nama">Nama Karyawan</label>
        <input type="text" class="form-control" id="Nama" placeholder="Nama Karyawan" name="nama" value="<?php echo $data['nama'] ?>">
      </div>

      <div class="form-group">
        <label for="lk">Jenis Kelamin</label>
        <select class="form-control" name="jk" value="<?php echo $data['jk'] ?>">
          <option id="">Pilih</option>
          <option id="lk">Laki-Laki</option>
          <option id="pr">Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="tempatlahir">Tempat Lahir</label>
        <input type="text" class="form-control" id="tempatlahir" placeholder="Tempat Lahir" name="tpt_lahir" value="<?php echo $data['tempatlahir'] ?>">
      </div>
      <div class="form-group">
        <label for="tanggallahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggallahir" placeholder="Tanggal Lahir" name="tgl_lahir" value="<?php echo $data['tgllahir'] ?>">
      </div>      
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="<?php echo $data['alamat'] ?>">
      </div>
      <div class="form-group">
        <label for="pendidikanterakhir">Pendidikan Terakhir</label>
        <select class="form-control" name="pend_terakhir" value="<?php echo $data['pendterakhir'] ?>" >
          <option id="">Pilih</option>
          <option id="sma">SMA</option>
          <option id="d1">D3</option>
          <option id="s1">S1</option>
          <option id="s2">S2</option>
        </select>
      </div>
      <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <input type="text" class="form-control" id="jurusan" placeholder="Jurusan" name="jurusan" value="<?php echo $data['jurusan'] ?>">
      </div>
      <div class="form-group">
        <label for="level">Level</label>
        <select class="form-control" name="level" value="<?php echo $data1['level'] ?>">
          <option id="">Pilih</option>
          <option id="admin">Admin</option>
          <option id="karyawan">Karyawan</option>
        </select>
      </div>
      <input class="btn btn-default" type="submit" name="simpan" value="Simpan">
    </form>
    <?php
    $nama = @$_POST['nama'];
    $jk = @$_POST['jk'];
    $tpt_lahir = @$_POST['tpt_lahir'];
    $tgl_lahir = @$_POST['tgl_lahir'];
    $alamat = @$_POST['alamat'];
    $pend_terakhir = @$_POST['pend_terakhir'];
    $jurusan = @$_POST['jurusan'];
    $level = @$_POST['level'];
    $simpan = @$_POST['simpan'];

    if ($simpan){
      if ($nip==""||$nama==""||$jk=="Pilih"||$tpt_lahir==""||$tgl_lahir==""||$alamat==""||$pend_terakhir=="Pilih"||$jurusan==""||$level=="Pilih"){
        ?>
          <script type="text/javascript">
            alert("Inputan tidak boleh kosong");
          </script>
        <?php
      }else{
        mysql_query("update tb_karyawan set nama ='$nama', jk = '$jk', tempatlahir = '$tpt_lahir', tgllahir = '$tgl_lahir', alamat = '$alamat', pendterakhir = '$pend_terakhir', jurusan = '$jurusan' where nip = '$nip' ") or die(mysql_error());
        mysql_query("update tb_user set password = password, level = '$level' where nip = '$nip' ") or die(mysql_error());
        ?>
        <script type="text/javascript">
          alert("Berhasil diubah!");
          window.location.href="?content=karyawan";
        </script>
        <?php
      }
    }
    ?>
  </div>
</div>