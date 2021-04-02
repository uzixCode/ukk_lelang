<div class="table-responsive">
<table class="table table-bordered">
	<tr>
		<th width="50%">ID</th>
		<td><?= $target['id_user'] ?></td>
	</tr>
	<tr>
		<th>NAMA LENGKAP</th>
		<td><?= $target['nama_lengkap'] ?></td>
	</tr>
	<tr>
		<th>USERNAME</th>
		<td><?= $target['username'] ?></td>
	</tr>
	<tr>
		<th>NOMOR TELEPON</th>
		<td><?= $target['telp'] ?></td>
	</tr>
	<tr>
		<th>STATUS</th>
		<td><?= ($target['status'] == 1) ? 'AKTIF' : 'TIDAK AKTIF' ; ?></td>
	</tr>
	<tr>
		<th>TANGGAL DAFTAR</th>
		<td><?= ($target['updated_at']) ? $this->lib->format_date($target['updated_at']) : '-' ; ?></td>
	</tr>
</table>
</div>