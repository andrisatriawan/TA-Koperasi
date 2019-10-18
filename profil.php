<div class="col-md-6 col-md-offset-3 keliling"><h1 class="glyphicon glyphicon-user">  Identitas Diri</h1>
	<table class="table">
		<tr>
			<td style="width: 200px">NIP</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['nip'] ?></td>
		</tr>
		<tr>
			<td style="width: 200px">Nama</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['nama'] ?></td>
		</tr>
		<tr>
			<td style="width: 200px">Jenis Kelamin</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['jk'] ?></td>
		</tr>
		<tr>
			<td style="width: 200px">Tempat Tanggal Lahir</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['tempatlahir'] ?>, <?php echo $data['tgllahir'] ?></td>
		</tr>
		<tr>
			<td style="width: 200px">Alamat</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['alamat'] ?></td>
		</tr>
		<tr>
			<td style="width: 200px">Pendidikan Terakhir</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['pendterakhir'] ?></td>
		</tr>
		<tr>
			<td style="width: 200px">Jurusan</td>
			<td style="width: 10px">:</td>
			<td><?php echo $data['jurusan'] ?></td>
		</tr>
		<tr>
			<td>
				<a href="?content=profil&action=edit"><span class="glyphicon glyphicon-pencil"> Edit Profil</span></a>
			</td>
			<td colspan="2">
				<a href="?content=profil&action=password"><span class="glyphicon glyphicon-lock"> Ubah Password</span></a>
			</td>
		</tr>
	</table>
</div>