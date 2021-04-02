<div class="table-responsive">
<table class="table table-bordered">
	<tr>
		<th width="50%">ID</th>
		<td><?= $target['id_barang'] ?></td>
	</tr>
	<tr>
		<th>NAMA BARANG</th>
		<td><?= $target['nama_barang'] ?></td>
	</tr>
	<tr>
		<th>HARGA AWAL</th>
		<td><?= rupiah($target['harga_barang']) ?></td>
	</tr>
	<tr>
		<th>DESKRIPSI BARANG</th>
		<td><?= $target['deskripsi_barang'] ?></td>
	</tr>
	<tr>
		<th>GAMBAR BARANG</th>
		<td><img src="<?= file_location($target['gambar_barang']) ?>" class="img-thumbnail" style="width: 100%; height: 250px;"><</td>
	</tr>
	<tr>
		<th>TANGGAL DI BUAT</th>
		<td><?= $this->lib->format_date($target['tgl']) ?></td>
	</tr>
	<tr>
		<th>TERAKHIR DI PERBARUI</th>
		<td><?= ($target['updated_at']) ? $this->lib->format_date($target['updated_at']) : '-' ; ?></td>
	</tr>
</table>
</div>