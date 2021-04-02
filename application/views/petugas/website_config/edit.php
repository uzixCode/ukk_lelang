<div class="row">
	<div class="col-sm-12">
		<a href="<?= base_url('admin/'.$this->uri->segment(2)) ?>" class="btn btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-edit fa-fw"></i> Ubah Data</h4>
<form method="post">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>Nama</label>
		<input type="text" class="form-control" value="<?= $target->name ?>" readonly>
	</div>
	<div class="form-group">
		<label>Isi *</label>
		<textarea class="form-control" name="value" rows="15"><?= $target->value ?></textarea>
	</div>
	<button type="reset" class="btn btn-danger">Reset</button>
	<button type="submit" class="btn btn-success">Submit</button>
</form>
		</div></div>
	</div>
</div>