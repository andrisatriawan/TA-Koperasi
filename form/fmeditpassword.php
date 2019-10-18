<div class="row">
	<div class="col-sm-6 col-sm-offset-3 keliling">
		<h1>Ubah Password</h1>
		<form action="" method="post">
			<div class="form-group">
		        <label for="NIP">NIP</label>
		        <input type="text" class="form-control" id="NIP" placeholder="NIP" value="<?php echo $id_login ?>" disabled="disabled">
		    </div>
		    <div class="form-group">
		        <label for="newpass">Password Baru</label>
		        <input type="password" class="form-control" id="newpass" placeholder="Password Baru" name="newpass">
		    </div>
		    <div class="form-group">
		        <label for="oldpass">Password Lama</label>
		        <input type="password" class="form-control" id="oldpass" placeholder="Password Lama" name="oldpass">
		    </div>
		    <input class="btn btn-default" type="submit" name="ubah" value="Ubah">
		</form>
	</div>
	<div class="clearfix visible-xs-block"></div>
</div>
<?php
$newpass = @$_POST['newpass'];
$oldpass = @$_POST['oldpass'];
$ubah = @$_POST['ubah'];

if ($ubah == 'Ubah') {
	$sql = mysql_query("select * from tb_user where nip = '$id_login' and password = md5('$oldpass')") or die(mysql_error());
	$cek = mysql_num_rows($sql);
	if ($cek >= 1){
		mysql_query("update tb_user set password = md5('$newpass'), level = level where nip = '$id_login' ");
		if (@$_SESSION['karyawan']){
			header("location: ?content=profil");
		}elseif (@$_SESSION['admin']) {
			header("location: ../admin/index.php");
		}
	}else{
		?><script type="text/javascript">alert("Username dan Password salah")</script><?php
	}
}
?>