<div class="table-responsive">
<table class="table table-bordered">
	<tr>
		<td align="center" colspan="2"><b>DATA LELANG</b></td>
	</tr>
	<tr>
		<th width="50%">ID LELANG</th>
		<td><?= $target['id_barang'] ?></td>
	</tr>
	<tr>
		<th>HARGA AWAL</th>
		<td><?= rupiah($barang['harga_barang']) ?></td>
	</tr>
	<tr>
		<th>HARGA AKHIR</th>
		<td><?= ($target['harga_akhir']) ? rupiah($target['harga_akhir']) : '-'; ?></td>
	</tr>
	<tr>
		<th>STATUS LELANG</th>
		<td><?= strtoupper($target['status']) ?></td>
	</tr>
	<tr>
		<th>TANGGAL LELANG</th>
		<td><?= $this->lib->format_date($target['tgl_lelang']) ?></td>
	</tr>
	<tr>
		<th>TERAKHIR DI PERBARUI</th>
		<td><?= ($target['updated_at']) ? $this->lib->format_date($target['updated_at']) : '-' ; ?></td>
	</tr>
	<?php if ($user) { ?>
	<tr>
		<td align="center" colspan="2"><b>DATA PEMBELI LELANG</b></td>
	</tr>
	<tr>
		<th>NAMA PENGGUNA</th>
		<td><?= $user['username'] ?></td>
	</tr>
	<tr>
		<th>NAMA LENGKAP</th>
		<td><?= $user['nama_lengkap'] ?></td>
	</tr>
	<tr>
		<th>NOMOR TELEPON</th>
		<td><?= $user['telp'] ?></td>
	</tr>
	<?php } ?>
	<tr>
		<td align="center" colspan="2"><b>DATA BARANG</b></td>
	</tr>
	<tr>
		<th>NAMA BARANG</th>
		<td><?= $barang['nama_barang'] ?></td>
	</tr>
	<tr>
		<th>HARGA BARANG</th>
		<td><?= rupiah($barang['harga_barang']) ?></td>
	</tr>
	<tr>
		<th>DESKRIPSI BARANG</th>
		<td><?= $barang['deskripsi_barang'] ?></td>
	</tr>
	<tr>
		<th>GAMBAR BARANG</th>
		<td><img src="<?= file_location($barang['gambar_barang']) ?>" class="img-thumbnail" style="width: 100%; height: 250px;"><</td>
	</tr>
	<tr>
		<th>TANGGAL DI BUAT</th>
		<td><?= $this->lib->format_date($barang['tgl']) ?></td>
	</tr>
	<tr>
		<th>TERAKHIR DI PERBARUI</th>
		<td><?= ($barang['updated_at']) ? $this->lib->format_date($barang['updated_at']) : '-' ; ?></td>
	</tr>
</table>
</div>