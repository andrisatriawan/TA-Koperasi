<div style="padding: 0 3%;"><h1>Data Pendapatan</h1>
	<table class="table">
		<tr>
			<th style="width: 50px">No</th>
			<th style="width: 200px">NIP</th>
			<th style="width: 300px">Nama Karyawan</th>
			<th style="width: 300px">Tanggal</th>
			<th style="width: 300px">Pendapatan Harian</th>
		</tr>
		<?php
		$nip = @$_GET['nip'];
		$tgl1 = @$_GET['tgl1'];
		$tgl2 = @$_GET['tgl2'];
		$print = @$_GET['action'];
		$i=0;
		if ($print == 'print'){
			if ($tgl1 == "" and $tgl2 == "" and $nip ==""){
				$sql = mysql_query("select * from tb_pendapatan") or die(mysql_error());
				$Text='';
			}else{
				if ($nip != ""){
					if ($tgl1 == "" and $tgl2 == ""){
						$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' ") or die(mysql_error());
						$Text="* Data diambil dari pegawai <strong>" .$nip ."</strong>";
					}else if ($tgl2 == ""){
						$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' and tanggal = '$tgl1' ") or die(mysql_error());
						$Text="* Data <strong>" .$nip ."</strong> diambil pada tanggal <strong>" .$tgl1 ."</strong>";
					}else if ($tgl1 == ""){
						$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' and tanggal = '$tgl2' ") or die(mysql_error());
						$Text="* Data <strong>" .$nip ."</strong> diambil pada tanggal <strong>" .$tgl2 ."</strong>";
					}else{
						$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' and tanggal between '$tgl1' and '$tgl2' ") or die(mysql_error());
						$Text="* Data <strong>" .$nip ."</strong> diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
					}
				}else if ($nip == "") {
					if ($tgl2 == ""){
						$sql = mysql_query("select * from tb_pendapatan where tanggal = '$tgl1' ") or die(mysql_error());
						$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
					}else if ($tgl1 == ""){
						$sql = mysql_query("select * from tb_pendapatan where tanggal = '$tgl2' ") or die(mysql_error());
						$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
					}else{
						$sql = mysql_query("select * from tb_pendapatan where tanggal between '$tgl1' and '$tgl2' ") or die(mysql_error());
						$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
					}
				}
			}
		}else{
			$sql = mysql_query("select * from tb_pendapatan") or die(mysql_error());
			$Text='';
		}
		$totalpend=0;
		while ($data = mysql_fetch_array($sql)){
			$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $data['nip'] ?></td>
			<td><?php echo $data['nama'] ?></td>
			<td><?php echo $data['tanggal'] ?></td>
			<td><?php echo $data['pendapatanharian'] ?></td>
		</tr>
		<?php
		$pend=$data['pendapatanharian'];
		$totalpend=$totalpend + $pend;
		}
		?>
		<tr>
			<td colspan="3"><small><?php echo $Text; ?></small></td>
			<td><strong>Jumlah Pendapatan</strong></td>
			<td><?php echo $totalpend; ?></td>
		</tr>
	</table>
</div>

<script type="text/javascript">window.print();</script>