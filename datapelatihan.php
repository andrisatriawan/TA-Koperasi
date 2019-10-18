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
							    <input type="date" class="form-control" id="tgl1" name="tgl1" style="width: 90%;"><br>
							    <input type="date" class="form-control" id="tgl2" name="tgl2" style="width: 90%;">
							</div>
							<div class="form-group"><br>
								<input class="btn btn-default" type="submit" name="cari" value="Filter">
								<input class="btn btn-default" type="submit" name="reset" value="Reset">
								<a href="?content=pelatihan&action=print"><input class="btn btn-default" type="submit" name="print" value="Print"></a>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-9 keliling">
				<div style="width: 100%"><h1>Data Pelatihan</h1>
					<table class="table">
						<tr>
							<th style="width: 50px">No</th>			
							<th style="width: 300px">NIP</th>
							<th style="width: 300px">Tanggal Pelatihan</th>
							<th style="width: 300px">Topik Pelatihan</th>
							<th style="width: 300px">Penyelenggara</th>
							<th style="width: 300px">Hasil Pelatihan</th>
							<th>Action</th>
						</tr>
						<?php
						$tgl1 = @$_POST['tgl1'];
						$tgl2 = @$_POST['tgl2'];
						$cari = @$_POST['cari'];
						$cetak = @$_POST['print'];
						$no=1;
						$batas =5;
						$hal = @$_GET['page'];
						if (empty($hal)){
							$posisi=0;
							$hal=1;
						}else{
							$posisi = ($hal-1) * $batas;
						}
						if ($cari){
							if ($tgl1 == "" and $tgl2 == ""){
								$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' limit $posisi, $batas") or die(mysql_error());
								$no = $posisi + 1;
								$Text='';
							}else{
								if ($tgl1==""){
									$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' and tanggal = '$tgl2' limit $posisi, $batas") or die(mysql_error());
									$no = $posisi + 1;
									$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
								}else if ($tgl2==""){
									$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' and tanggal = '$tgl1' limit $posisi, $batas") or die(mysql_error());
									$no = $posisi + 1;
									$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
								}else{
									$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' and tanggal between '$tgl1' and '$tgl2' limit $posisi, $batas") or die(mysql_error());
									$no = $posisi + 1;
									$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
								}
							}
						}else if ($cetak){
							header("location: ?content=pelatihan&action=print&tgl1=$tgl1&tgl2=$tgl2");
						}else{
							$sqlpel = mysql_query("select * from tb_pelatihan where nip = '$id_login' limit $posisi, $batas") or die(mysql_error());
							$no = $posisi + 1;
							$Text='';
						}
						while ($datapel = mysql_fetch_array($sqlpel)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $datapel['nip']; ?></td>
							<td><?php echo $datapel['tanggal'] ?></td>
							<td><?php echo $datapel['topik'] ?></td>
							<td><?php echo $datapel['penyelenggara'] ?></td>
							<td><?php echo $datapel['hasil'] ?></td>
							<td>
								<a class="glyphicon glyphicon-pencil" href="?content=pelatihan&action=edit&kode=<?php echo $datapel['idpelatihan'] ?>" style="padding-right: 10px"></a>
								<a onclick="return confirm('Apakah anda ingin menghapus data <?php echo $datapel['idpelatihan'] ?>?')" class="glyphicon glyphicon-trash" href="?content=pelatihan&action=hapus&kode=<?php echo $datapel['idpelatihan'] ?>"></a>
							</td>
						</tr>
					<?php } ?>
						<tr>
							<td colspan="7">
								<a href="?content=pelatihan&action=tambah"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
								<?php echo "</br>".$Text; ?>
							</td>
						</tr>
					</table>
					<div style="float: right;">
						<?php
						$jmlh = mysql_num_rows(mysql_query("select * from tb_pelatihan"));
						$jmlh_hal = ceil($jmlh / $batas);
						echo "Halaman : ";
						for ($i=1; $i <= $jmlh_hal ; $i++) { 
							if ($i != $hal) {
								echo "<a href='?content=pelatihan&page=$i'> $i </a>";
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
