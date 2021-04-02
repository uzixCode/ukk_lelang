<div class="row">
	<div class="col-sm-12">
		<a href="<?= base_url('petugas/'.$this->uri->segment(2)) ?>" class="btn btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-edit fa-fw"></i> Ubah Data</h4>
<form method="post">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>Nama Lengkap *</label>
		<input type="text" class="form-control" name="nama_lengkap" value="<?= $target['nama_lengkap'] ?>">
	</div>
	<div class="form-group">
		<label>Username *</label>
		<input type="text" class="form-control" name="username" value="<?= $target['username'] ?>">
	</div>
	<div class="form-group">
		<label>Nomor Telepon *</label>
		<input type="text" class="form-control" name="telp" value="<?= $target['telp'] ?>">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="password" class="form-control" name="password">
		<small>Kosongkan jika tidak diubah.</small>
	</div>
	<button type="reset" class="btn btn-danger">Reset</button>
	<button type="submit" class="btn btn-success">Submit</button>
</form>
		</div></div>
	</div>
</div>