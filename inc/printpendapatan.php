<div><h1>Data Pendapatan</h1>
	<table class="table">
		<tr>
			<th style="width: 50px">No</th>
			<th style="width: 200px">NIP</th>
			<th style="width: 300px">Nama Karyawan</th>
			<th style="width: 300px">Tanggal</th>
			<th style="width: 300px">Pendapatan Harian</th>
		</tr>
		<?php
		$tgl1 = @$_GET['tgl1'];
		$tgl2 = @$_GET['tgl2'];
		$print = @$_GET['action'];
		$i=0;
		if ($print == 'print'){
			if ($tgl1 == "" and $tgl2 == ""){
				$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login'") or die(mysql_error());
				$Text='';
			}else{
				if ($tgl1 == "") {
					$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' and tanggal = '$tgl2' ") or die(mysql_error());
					$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
				}else if ($tgl2 == ""){
					$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' and tanggal = '$tgl1' ") or die(mysql_error());
					$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
				}else{
					$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' and tanggal between '$tgl1' and '$tgl2' ") or die(mysql_error());
					$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
				}
			}
		}else{
			$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login'") or die(mysql_error());
			$Text='';
		}
		$totalpend=0;
		while ($datapendapatan = mysql_fetch_array($sqlpendapatan)){
			$i++;
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $datapendapatan['nip'] ?></td>
			<td><?php echo $datapendapatan['nama'] ?></td>
			<td><?php echo $datapendapatan['tanggal'] ?></td>
			<td><?php echo $datapendapatan['pendapatanharian'] ?></td>
		</tr>
		<?php 
		$pend=$datapendapatan['pendapatanharian'];
		$totalpend=$totalpend + $pend;
		}
		?>
		<tr>
			<td colspan="3">
				<small><?php echo $Text; ?></small>
			</td>
			<td><strong>Jumlah Pendapatan</strong></td>
			<td><?php echo $totalpend; ?></td>
		</tr>
	</table>
</div>

<script type="text/javascript">window.print();</script>