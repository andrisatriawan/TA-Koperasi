<?php
@session_start();
ob_start();
include 'inc/koneksi.php';

if (@$_SESSION['karyawan']){
	header("location: index.php");
}elseif (@$_SESSION['admin']) {
	header("location: admin/index.php");
}
else{
	$cari = mysql_query("select * from tb_user") or die(mysql_error());
	$datacari = mysql_fetch_array($cari);
	$cekdata = mysql_num_rows($cari);
	if ($cekdata>=1){
		$tombol = 'Login';
		$text ="";
	}else{
		$tombol = 'Buat';
		$text = 'Data user kosong, isi NIP yang akan dibuat dan pasword yang diinginkan.';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<style type="text/css">
		body{
			font-family: arial;
			font-size: 12px;
			background-color: #222;
		}
		#form{
			width: 300px;
			margin: 0 auto;
			margin-top: 18%;
		}
		#header{
			padding: 15px;
			text-align: center;
			color: #f5f5f5;
			font-size: 16px;
			background-color: #339966;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
			border-bottom: 3px solid #336666;
		}
		#input{
			padding: 20px;
			background-color: #f5f5f5;
			border-bottom-left-radius: 10px;
			border-bottom-right-radius: 10px;
		}
		input{
			padding: 5px;
			width: 75%;
		}
	</style>
</head>
<body>
	<div id="form">
		<div id="header">
			Halaman Login
		</div>
		<div id="input">
			<form action="" method="post">
				<div align="center">
					<input type="text" name="nip" placeholder="NIP">
				</div>
				<div style="margin-top: 5px;" align="center">
					<input type="password" name="password" placeholder="Password">
				</div>
				<div style="margin-top: 5px;" align="center">
					<input type="submit" name="login" value="<?php echo $tombol ?>">
				</div>
				<div style="margin-top: 5px;" align="left">
					<?php echo $text; ?>
				</div>
			</form>
			<?php
			$nip = @$_POST['nip'];
			$pass = @$_POST['password'];
			$login = @$_POST['login'];
			if ($login) {
				if($nip == "" || $pass == "")	{
					?><script type="text/javascript">alert("Username dan Password tidak boleh kosong");</script><?php
				}else{
					if ($tombol=='Login'){
						$sql = mysql_query("select * from tb_user where nip = '$nip' and password = md5('$pass')") or die(mysql_error());
						$data = mysql_fetch_array($sql);
						$cek = mysql_num_rows($sql);
						if ($cek >= 1){
							if ($data['level']=='Admin'){
								@$_SESSION['admin']=$data['nip'];
								header("location: admin/index.php");
							}else if ($data['level']=='Karyawan'){
								@$_SESSION['karyawan']=$data['nip'];
								header("location: index.php");
							}
						}else{
							?><script type="text/javascript">alert("Username dan Password salah")</script><?php
						}
					}else{
						mysql_query("insert into tb_user values ('$nip', md5('$pass'), 'Admin')")or die(mysql_error());
						mysql_query("insert into tb_karyawan values ('$nip','','','','','','','')") or die(mysql_error());
						@$_SESSION['admin']=$nip;
						header("location: admin/index.php");
					}
				}
			}
			?>
		</div>
	</div>
</body>
</html>
<?php } 
ob_flush();
?>