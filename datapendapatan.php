<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Filter</div>
					<div class="panel-body">
						<form class="form-inline" method="post">
					  		<div class="form-group">
								<label style="padding-right: 10px; padding-left: 10px">Tanggal</label><br>
							    <input type="date" class="form-control" id="tgl1" name="tgl1" style="width: 90%"><br>
							    <input type="date" class="form-control" id="tgl2" name="tgl2" style="width: 90%">
							</div>
							<div class="form-group"><br>
								<input class="btn btn-default" type="submit" name="cari" value="Filter">
								<input class="btn btn-default" type="submit" name="reset" value="Reset">
								<input class="btn btn-default" type="submit" name="print" value="Print">
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-9 keliling">
				<div><h1>Data Pendapatan</h1>
					<table class="table">
						<tr>
							<th style="width: 50px">No</th>
							<th style="width: 200px">NIP</th>
							<th style="width: 300px">Nama Karyawan</th>
							<th style="width: 300px">Tanggal</th>
							<th style="width: 300px">Pendapatan Harian</th>
							<th>Action</th>
						</tr>
						<?php
						$tgl1 = @$_POST['tgl1'];
						$tgl2 = @$_POST['tgl2'];
						$nip = $id_login;
						$no=1;
						$batas =5;
						$hal = @$_GET['page'];
						if (empty($hal)){
							$posisi=0;
							$hal=1;
						}else{
							$posisi = ($hal-1) * $batas;
						}
						if (@$_POST['cari']){
							if ($tgl1 == "" and $tgl2 == ""){
								$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' limit $posisi, $batas") or die(mysql_error());
								$no = $posisi + 1;
								$Text='';
							}else{
								if ($tgl1 == "") {
									$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' and tanggal = '$tgl2' limit $posisi, $batas") or die(mysql_error());
									$no = $posisi + 1;
									$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
								}else if ($tgl2 == ""){
									$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' and tanggal = '$tgl1' limit $posisi, $batas") or die(mysql_error());
									$no = $posisi + 1;
									$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
								}else{
									$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' and tanggal between '$tgl1' and '$tgl2' limit $posisi, $batas") or die(mysql_error());
									$no = $posisi + 1;
									$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
								}
							}
						}else if (@$_POST['print']){
							header("location: ?content=pendapatan&action=print&tgl1=$tgl1&tgl2=$tgl2");
						}else{
							$sqlpendapatan = mysql_query("select * from tb_pendapatan where nip = '$id_login' limit $posisi, $batas") or die(mysql_error());
							$no = $posisi + 1;
							$Text='';
						}
						while ($datapendapatan = mysql_fetch_array($sqlpendapatan)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $datapendapatan['nip'] ?></td>
							<td><?php echo $datapendapatan['nama'] ?></td>
							<td><?php echo $datapendapatan['tanggal'] ?></td>
							<td><?php echo $datapendapatan['pendapatanharian'] ?></td>
							<td>
								<a class="glyphicon glyphicon-pencil" href="?content=pendapatan&action=edit&tgl=<?php echo $datapendapatan['tanggal'] ?>" style="padding-right: 10px"></a>
								<a onclick="return confirm('Apakah anda ingin menghapus pendapatan tanggal <?php echo $datapendapatan['tanggal'] ?>?')" class="glyphicon glyphicon-trash" href="?content=pendapatan&action=hapus&tgl=<?php echo $datapendapatan['tanggal'] ?>"></a>
							</td>
						</tr>
					<?php } ?>
						<tr>
							<td colspan="7">
								<a href="?content=pendapatan&action=tambah"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
								<?php echo "</br>".$Text; ?>
							</td>
						</tr>
					</table>
					<div style="float: right;">
						<?php
						$jmlh = mysql_num_rows(mysql_query("select * from tb_pendapatan"));
						$jmlh_hal = ceil($jmlh / $batas);
						echo "Halaman : ";
						for ($i=1; $i <= $jmlh_hal ; $i++) { 
							if ($i != $hal) {
								echo "<a href='?content=pendapatan&page=$i'> $i </a>";
							}else{
								echo " $i ";
							}
						}
						echo "dari " .$jmlh_hal;
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

