<div class="row">
	<div class="offset-lg-3 col-lg-6">
		<div class="card">
			<div class="card-header">                                
		        <h5 class="card-title mb-0"><i class="mdi mdi-cogs"></i> Pengaturan Akun</h5>
		    </div>
			<div class="card-body">
<form method="post">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>Username</label>
		<input type="text" class="form-control" value="<?= user('username') ?>" readonly>
	</div>
	<div class="form-group">
		<label>Nama Lengkap *</label>
		<input type="text" class="form-control" name="nama_lengkap" value="<?= user('nama_lengkap') ?>">
	</div>
	<div class="form-group">
		<label>Password Baru</label>
		<input type="password" class="form-control" name="new_password">
		<small>Kosongkan jika tidak ingin membuat Password baru.</small>
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