<div style="width: 100%"><h1>Data Pelatihan</h1>
	<table class="table">
		<tr>
			<th>No</th>			
			<th>NIP</th>
			<th>Tanggal Pelatihan</th>
			<th>Topik Pelatihan</th>
			<th>Penyelenggara</th>
			<th>Hasil Pelatihan</th>
		</tr>
<?php
$tgl1 = @$_GET['tgl1'];
$tgl2 = @$_GET['tgl2'];
$print = @$_GET['action'];

$i=0;
if ($print == 'print'){
	if ($tgl1 == "" and $tgl2 == ""){
		$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login'") or die(mysql_error());
		$Text='';
	}else{
		if ($tgl1==""){
			$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' and tanggal = '$tgl2' ") or die(mysql_error());
			$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
		}else if ($tgl2==""){
			$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' and tanggal = '$tgl1' ") or die(mysql_error());
			$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
		}else{
			$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' and tanggal between '$tgl1' and '$tgl2' ") or die(mysql_error());
			$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
		}
	}
}else{
	$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' ") or die(mysql_error());
	$Text='';
}

while ($datapel = mysql_fetch_array($sqlpel)){
	$i++;
?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $datapel['nip']; ?></td>
			<td><?php echo $datapel['tanggal'] ?></td>
			<td><?php echo $datapel['topik'] ?></td>
			<td><?php echo $datapel['penyelenggara'] ?></td>
			<td><?php echo $datapel['hasil'] ?></td>
		</tr>
	<?php } ?>
		<tr>
			<td colspan="6">
				<small><?php echo $Text; ?></small>
			</td>
		</tr>
	</table>
</div>

<script type="text/javascript">window.print();</script>