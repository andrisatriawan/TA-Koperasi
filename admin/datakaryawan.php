<section>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="keliling"><h1>Data Karyawan</h1>
				<table class="table">
					<tr>
						<th style="width: 10%">No</th>
						<th style="width: 25%">NIP</th>
						<th style="width: 50%">Nama</th>
						<th>Action</th>
					</tr>
					<?php
					$no=1;
					$batas =5;
					$hal = @$_GET['page'];
					if (empty($hal)){
						$posisi=0;
						$hal=1;
					}else{
						$posisi = ($hal-1) * $batas;
					}
					$sql = mysql_query("select * from tb_karyawan limit $posisi, $batas") or die(mysql_error());
					$no = $posisi + 1;
					while ($data = mysql_fetch_array($sql)){
					?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $data["nip"]; ?></td>
						<td><?php echo $data["nama"]; ?></td>
						<td>
							<a class="glyphicon glyphicon-pencil" href="?content=karyawan&action=edit&kode=<?php echo $data['nip'] ?>" style="padding-right: 10px"></a>
							<a onclick="return confirm('Apakah anda ingin menghapus data <?php echo $data['nip'] ?>?')" class="glyphicon glyphicon-trash" href="?content=karyawan&action=hapus&kode=<?php echo $data['nip'] ?>"></a>
						</td>
					</tr>
					<?php
				}
					?>
					<tr>
						<td colspan="2"><a href="?content=karyawan&action=tambah"><span class="glyphicon glyphicon-plus"> Tambah</span></a></td>
						<td colspan="2">
							<div style="float: right;">
								<?php
								$jmlh = mysql_num_rows(mysql_query("select * from tb_karyawan"));
								$jmlh_hal = ceil($jmlh / $batas);
								echo "Halaman : ";
								for ($i=1; $i <= $jmlh_hal ; $i++) { 
									if ($i != $hal) {
										echo "<a href='?content=karyawan&page=$i'> $i </a>";
									}else{
										echo " $i ";
									}
								}
								echo "dari " .$jmlh_hal;
								?>
							</div>
						</td>
					</tr>
				</table>
				
			</div>
		</div>
	</div>
</section>



