<?php
$tanggal = @$_GET['tgl'];

mysql_query("delete from tb_pendapatan where tanggal = '$tanggal' and nip = '$id_login'") or die(mysql_error());
?>
<script type="text/javascript">
	window.location.href="?content=pendapatan";
</script>