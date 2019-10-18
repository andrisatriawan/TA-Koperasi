<section>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">Filter</div>
					<div class="panel-body">
						<form class="form-inline" method="post">
					  		<div class="form-group">
								<label style="padding-right: 10px">NIP</label><br>
							    <input type="text" class="form-control" id="nip" name="nip" style="width: 90%">
							</div>
					  		<div class="form-group"><br>
								<label style="padding-right: 10px;">Tanggal</label><br>
							    <input type="date" class="form-control" id="tgl1" name="tgl1" style="width: 90%">
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
						</tr>
						<?php
						$nip = @$_POST['nip'];
						$tgl1 = @$_POST['tgl1'];
						$tgl2 = @$_POST['tgl2'];
						$print=@$_POST['print'];
						$cari = @$_POST['cari'];
						$no=1;
						$batas = 5;
						$hal = @$_GET['page'];
						if (empty($hal)){
							$posisi=0;
							$hal=1;
						}else{
							$posisi = ($hal-1) * $batas;
						}
						if ($cari){
							if ($tgl1 == "" and $tgl2 == "" and $nip ==""){
								$sql = mysql_query("select * from tb_pendapatan limit $posisi, $batas") or die(mysql_error());
								$no = $posisi + 1;
								$Text='';
							}else{
								if ($nip != ""){
									if ($tgl1 == "" and $tgl2 == ""){
										$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data diambil dari pegawai <strong>" .$nip ."</strong>";
									}else if ($tgl2 == ""){
										$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' and tanggal = '$tgl1' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data <strong>" .$nip ."</strong> diambil pada tanggal <strong>" .$tgl1 ."</strong>";
									}else if ($tgl1 == ""){
										$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' and tanggal = '$tgl2' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data <strong>" .$nip ."</strong> diambil pada tanggal <strong>" .$tgl2 ."</strong>";
									}else{
										$sql = mysql_query("select * from tb_pendapatan where nip = '$nip' and tanggal between '$tgl1' and '$tgl2' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data <strong>" .$nip ."</strong> diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
									}
								}else if ($nip == "") {
									if ($tgl2 == ""){
										$sql = mysql_query("select * from tb_pendapatan where tanggal = '$tgl1' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data diambil pada tanggal <strong>" .$tgl1 ."</strong>";
									}else if ($tgl1 == ""){
										$sql = mysql_query("select * from tb_pendapatan where tanggal = '$tgl2' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data diambil pada tanggal <strong>" .$tgl2 ."</strong>";
									}else{
										$sql = mysql_query("select * from tb_pendapatan where tanggal between '$tgl1' and '$tgl2' limit $posisi, $batas") or die(mysql_error());
										$no = $posisi + 1;
										$Text="* Data diambil dari tanggal <strong>" .$tgl1 ."</strong> sampai tanggal <strong>" .$tgl2 ."</strong>";
									}
								}
							}
						}elseif($print){
							header("location: ?content=pendapatan&action=print&nip=$nip&tgl1=$tgl1&tgl2=$tgl2");
						}else{
							$sql = mysql_query("select * from tb_pendapatan limit $posisi, $batas") or die(mysql_error());
							$no = $posisi + 1;
							$Text='';
						}
						while ($data = mysql_fetch_array($sql)){
						?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $data['nip'] ?></td>
							<td><?php echo $data['nama'] ?></td>
							<td><?php echo $data['tanggal'] ?></td>
							<td><?php echo $data['pendapatanharian'] ?></td>
						</tr>
					<?php } ?>
						<tr>
							<td colspan="6"><?php echo $Text; ?></td>
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

