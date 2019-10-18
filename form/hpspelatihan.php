<?php
$idpel = @$_GET['kode'];

mysql_query("delete from tb_pelatihan where idpelatihan = '$idpel'") or die(mysql_error());
?>
<script type="text/javascript">
	window.location.href="?content=pelatihan";
</script>