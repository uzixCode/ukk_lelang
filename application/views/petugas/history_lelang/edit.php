<form method="post" action="<?= base_url('petugas/'.$this->uri->segment(2).'/form/'.$target['id_history']) ?>">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>ID Pengguna</label>
		<input type="text" class="form-control" name="pengguna" value="<?= $target['id_user'] ?>" readonly>
	</div>
	<div class="form-group">
		<label>Nama Pengguna</label>
		<input type="text" class="form-control" value="<?= $user['nama_lengkap'] ?>" readonly>
	</div>
	<div class="form-group">
		<label>Harga Awal</label>
		<input type="text" class="form-control" value="<?= $barang['harga_barang'] ?>" readonly>
	</div>
	<div class="form-group">
		<label>Harga Penawaran *</label>
		<input type="number" class="form-control" name="penawaran_harga" value="<?= $target['penawaran_harga'] ?>" readonly>
	</div>
	<button type="reset" class="btn btn-danger">Reset</button>
	<button type="submit" class="btn btn-success">Submit</button>
</form>