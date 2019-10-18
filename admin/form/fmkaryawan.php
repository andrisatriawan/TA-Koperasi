<div class="row">
  <div class="col-md-8 col-md-offset-2 keliling">
    <h1 style="padding:10px 0;">Data Karyawan</h1>
    <form action="" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="NIP">NIP</label>
        <input type="text" class="form-control" id="NIP" placeholder="NIP" name="nip">
      </div>
      <div class="form-group">
        <label for="Nama">Nama Karyawan</label>
        <input type="text" class="form-control" id="Nama" placeholder="Nama Karyawan" name="nama">
      </div>

      <div class="form-group">
        <label for="lk">Jenis Kelamin</label>
        <select class="form-control" name="jk">
          <option id="">Pilih</option>
          <option id="lk">Laki-Laki</option>
          <option id="pr">Perempuan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="tempatlahir">Tempat Lahir</label>
        <input type="text" class="form-control" id="tempatlahir" placeholder="Tempat Lahir" name="tpt_lahir">
      </div>
      <div class="form-group">
        <label for="tanggallahir">Tanggal Lahir</label>
        <input type="date" class="form-control" id="tanggallahir" placeholder="Tanggal Lahir" name="tgl_lahir">
      </div>      
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat">
      </div>
      <div class="form-group">
        <label for="pendidikanterakhir">Pendidikan Terakhir</label>
        <select class="form-control" name="pend_terakhir">
          <option id="">Pilih</option>
          <option id="sma">SMA</option>
          <option id="d1">D3</option>
          <option id="s1">S1</option>
          <option id="s2">S2</option>
        </select>
      </div>
      <div class="form-group">
        <label for="jurusan">Jurusan</label>
        <input type="text" class="form-control" id="jurusan" placeholder="Jurusan" name="jurusan">
      </div>
      <div class="form-group">
        <label for="level">Level</label>
        <select class="form-control" name="level">
          <option id="">Pilih</option>
          <option id="admin">Admin</option>
          <option id="karyawan">Karyawan</option>
        </select>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
      </div>
      <input class="btn btn-default" type="submit" name="tambah" value="Tambah">
    </form>
    <?php
    $nip = @$_POST['nip'];
    $nama = @$_POST['nama'];
    $jk = @$_POST['jk'];
    $tpt_lahir = @$_POST['tpt_lahir'];
    $tgl_lahir = @$_POST['tgl_lahir'];
    $alamat = @$_POST['alamat'];
    $pend_terakhir = @$_POST['pend_terakhir'];
    $jurusan = @$_POST['jurusan'];
    $level = @$_POST['level'];
    $password = @$_POST['password'];
    $tambah = @$_POST['tambah'];

    if ($tambah){
      if ($nip==""||$nama==""||$jk=="Pilih"||$tpt_lahir==""||$tgl_lahir==""||$alamat==""||$pend_terakhir=="Pilih"||$jurusan==""||$level=="Pilih"||$password==""){
        ?>
          <script type="text/javascript">
            alert("inputan tidak boleh kosong");
          </script>
        <?php
      }else{
        $sql = mysql_query("select * from tb_karyawan where nip = '$nip'") or die(mysql_error());
        $data = mysql_fetch_array($sql);
        $cek = mysql_num_rows($sql);

        if ($cek){
          ?>
          <script type="text/javascript">
            alert("Data sudah ada");
          </script>
          <?php
        }else{
        mysql_query("insert into tb_karyawan values ('$nip', '$nama', '$jk', '$tpt_lahir', '$tgl_lahir', '$alamat', '$pend_terakhir', '$jurusan')") or die(mysql_error());
        mysql_query("insert into tb_user values ('$nip', md5('$password'), '$level')") or die(mysql_error());
        ?>
        <script type="text/javascript">
          alert("Berhasil disimpan");
          window.location.href="?content=karyawan&action=tambah";
        </script>
        <?php
        }
      }
    }
    ?>
  </div>
</div>