<?php
$nip = @$_GET['kode'];

mysql_query("delete from tb_karyawan where nip = '$nip'") or die(mysql_error());
mysql_query("delete from tb_user where nip = '$nip'") or die(mysql_error());
?>
<script type="text/javascript">
	window.location.href="?content=karyawan";
</script>