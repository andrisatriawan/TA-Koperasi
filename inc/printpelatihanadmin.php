<div style="width: 100%">
	<div class="col-xs-6 col-md-4"><h1>Data Pelatihan</h1></div>
	<table class="table">
		<tr>
			<th style="width: 50px">No</th>
			<th>NIP</th>
			<th>Tanggal Pelatihan</th>
			<th>Topik Pelatihan</th>
			<th>Penyelenggara</th>
			<th>Hasil Pelatihan</th>
		</tr>
		<?php
		$nip = @$_GET['nip'];
		$tgl1 = @$_GET['tgl1'];
		$tgl2 = @$_GET['tgl2'];
		$print = @$_GET['action'];
		$i=0;
		if ($print=='print'){
			if ($tgl1 == "" and $tgl2 == "" and $nip ==""){
				$sql = mysql_query("select * from tb_pelatihan") or die(mysql_error());
				$Text='';
			}else{
				if ($nip != ""){
					if ($tgl1 == "" and $tgl2 == ""){
						$sql = mysql_query("select * from tb_pelatihan where nip = '$nip' ") or die(mysql_error());
						$Text="* Data diambil dari pegawai <strong>" .$nip ."</strong>";
					}else if ($tgl2 == ""){
						$sql = mysql_query("select * from tb_pelatihan where nip = '$nip' and tanggal = '$tgl1' ") or die(mysql_error());
						$Text="* Data <strong>" .$nip ."</strong> diambil pada tanggal <strong>" .$tgl1 ."</strong>";
					}else if ($tgl1 == ""){
						$sql = mysql_query("select * from tb_pelatihan where nip = '$nip' and tanggal = '$tgl2' ") or die(mysql_error());
						$Text="* Data <strong>" .$nip ."</strong> diambil pada tanggal <strong>" .$tgl2 ."</strong>";
					}else{
						$sql = mysql_query("select * from tb_pelatihan where nip = '$nip' and tanggal between '$tgl1' and '$tgl2' ") or die(mysql_error());
						$Text="* Data <strong>" .$nip ."</strong> diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
					}
				}else if ($nip == "") {
					if ($tgl2 == ""){
						$sql = mysql_query("select * from tb_pelatihan where tanggal = '$tgl1' ") or die(mysql_error());
						$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
					}else if ($tgl1 == ""){
						$sql = mysql_query("select * from tb_pelatihan where tanggal = '$tgl2' ") or die(mysql_error());
						$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
					}else{
						$sql = mysql_query("select * from tb_pelatihan where tanggal between '$tgl1' and '$tgl2' ") or die(mysql_error());
						$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
					}
				}
			}
		}else{
			$sql = mysql_query("select * from tb_pelatihan") or die(mysql_error());
			$Text='';
		}

		while ($data = mysql_fetch_array($sql)) {
			$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $data['nip'] ?></td>
			<td><?php echo $data['tanggal'] ?></td>
			<td><?php echo $data['topik'] ?></td>
			<td><?php echo $data['penyelenggara'] ?></td>
			<td><?php echo $data['hasil'] ?></td>
		</tr>
		<?php
	}
		?>

		<tr>
			<td colspan="6"><small><?php echo $Text; ?></small></td>
		</tr>
	</table>
</div>
<script type="text/javascript">window.print();</script>