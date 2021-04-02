<div class="row">
	<div class="offset-sm-3 col-sm-6">
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-cogs fa-fw"></i> Pengaturan Akun</h4>
<form method="post">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" value="<?= admin('username') ?>" readonly>
	</div>
	<div class="form-group">
		<label>Nama Lengkap *</label>
		<input type="text" class="form-control" name="full_name" value="<?= admin('full_name') ?>">
	</div>
	<div class="form-group">
		<label>Password Baru</label>
		<input type="password" class="form-control" name="new_password">
		<small>Kosongkan jika tidak ingin membuat password baru.</small>
	</div>
	<div class="form-group">
		<label>Konfirmasi Password Baru</label>
		<input type="password" class="form-control" name="confirm_new_password">
		<small>Kosongkan jika tidak ingin membuat password baru.</small>
	</div>
	<div class="form-group">
		<label>Password *</label>
		<input type="password" class="form-control" name="password">
	</div>
	<button type="reset" class="btn btn-danger">Reset</button>
	<button type="submit" class="btn btn-success">Submit</button>
</form>
		</div></div>
	</div>
</div>