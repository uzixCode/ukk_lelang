<div class="row">
	<div class="offset-sm-3 col-sm-6">
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-sign-in-alt fa-fw"></i> Masuk</h4>
			<form method="post">
				<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
				<div class="form-group">
					<label>Username *</label>
					<input type="text" class="form-control" name="username" value="<?= set_value('username') ?>">
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