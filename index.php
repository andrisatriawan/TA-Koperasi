<?php
@session_start();
ob_start();
include 'inc/koneksi.php';

if (@$_SESSION['karyawan']) {
	$id_login = @$_SESSION['karyawan'];

	$sql = mysql_query("select * from tb_karyawan where nip = '$id_login' ") or die(mysql_error());
	$data = mysql_fetch_array($sql);
	$nama_karyawan = $data['nama'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Koperasi</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="js/jquery-2.1.4.min.js"></script>
	<script src="js/bootstrap.js"></script>
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="index.php" style="padding: 5px;"><img src="img/icon.jpg" class="img-thumbnail" style="width: 45px; float: left;"><span style="float: right; padding: 10px;">KSPPS BMT AMANAH RAY</span>
	      </a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        <li><a href="index.php">Beranda</a></li>
	        <li class="dropdown">
	          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data <span class="caret"></span></a>
	          <ul class="dropdown-menu">
	            <li><a href="index.php?content=pelatihan">Data Pelatihan</a></li>
	            <li><a href="index.php?content=pendapatan">Data Pendapatan</a></li>
	          </ul>
	        </li>
	        <li><a href="index.php?content=profil">Profil</a></li>
	        <li style="float: right;"><a href="logout.php">Logout</a></li>
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>
	<div style="padding: 60px 2% 60px 2%">
	<?php
	if (@$_GET['content']=='profil'){
		if (@$_GET['action']=='edit') {
			include 'form/fmeditprofil.php';
		}else if (@$_GET['action']=='password') {
			include 'form/fmeditpassword.php';
		}else{
			include 'profil.php';
		}
	}elseif(@$_GET['content']=='pelatihan'){
		if (@$_GET['action']=='tambah'){
			include 'form/fmpelatihan.php';
		}elseif (@$_GET['action']=='edit'){
			include 'form/fmeditpelatihan.php';
		}elseif (@$_GET['action']=='hapus'){
			include 'form/hpspelatihan.php';
		}elseif (@$_GET['action']=='print'){
			include 'inc/printpelatihan.php';
		}else{
			include 'datapelatihan.php';
		}
	}elseif(@$_GET['content']=='pendapatan'){
		if (@$_GET['action']=='tambah'){
			include 'form/fmpendapatan.php';
		}elseif (@$_GET['action']=='edit'){
			include 'form/fmeditpendapatan.php';
		}elseif (@$_GET['action']=='hapus'){
			include 'form/hpspendapatan.php';
		}elseif (@$_GET['action']=='print'){
			include 'inc/printpendapatan.php';
		}else{
			include 'datapendapatan.php';	
		}
	}else{
		include 'depan.php';
	}
	?>
	</div>
	<footer class="container text-center">
		<div class="row">
			<div class="col-sm-12">
				<p>Copyright <i class="glyphicon glyphicon-copyright-mark"></i> 2019 | Design by Nursaidah</p>
			</div>
		</div>
	</footer>
</body>
</html>
<?php
}else{
	header("location: login.php");
}
ob_flush();
?>