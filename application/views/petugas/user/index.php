<div class="row">
	<div class="col-sm-12">
		<div class="card"><div class="card-body">
			<div class="float-right">
				<a href="<?= base_url('petugas/'.$this->uri->segment(2).'/form') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
				<?php if (petugas('level') == 'administrator') { ?>
					<a href="<?= base_url('petugas/'.$this->uri->segment(2).'/export') ?>" target="_blank" class="btn btn-warning btn-sm"><i class="fa fa-file fa-fw"></i> Export</a>
				<?php } ?>
			</div>
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-table fa-fw"></i> Data</h4>
<form style="margin: 20px 0;">
	<div class="form-row">
		<div class="form-group col-sm-2">
			<label>Kolom Sortir</label>
			<select class="form-control" name="sort_field">
				<option value="">Kolom...</option>
<?php
foreach ($field as $key => $value) {
?>
<option value="<?= $key ?>" <?= ($key == $this->input->get('sort_field')) ? 'selected' : '' ?>><?= $value ?></option>
<?php
}
?>
			</select>
		</div>
		<div class="form-group col-sm-2">
			<label>Tipe Sortir</label>
			<select class="form-control" name="sort_type">
				<option value="">Tipe...</option>
				<option value="asc" <?= ($this->input->get('sort_type') == 'asc') ? 'selected' : '' ?>>ASC</option>
				<option value="desc" <?= ($this->input->get('sort_type') == 'desc') ? 'selected' : '' ?>>DESC</option>
			</select>
		</div>
		<div class="form-group col-sm-2">
			<label>Kolom Cari</label>
			<select class="form-control" name="field">
				<option value="">Kolom...</option>
<?php
foreach ($field as $key => $value) {
?>
<option value="<?= $key ?>" <?= ($key == $this->input->get('field')) ? 'selected' : '' ?>><?= $value ?></option>
<?php
}
?>
			</select>
		</div>
		<div class="form-group col-sm-2">
			<label>Operator Cari</label>
			<select class="form-control" name="operator">
				<option value="">Operator...</option>
<?php
foreach ($operator as $key => $value) {
?>
<option value="<?= $key ?>" <?= ($key == $this->input->get('operator')) ? 'selected' : '' ?>><?= $value ?></option>
<?php
}
?>
			</select>
		</div>
		<div class="form-group col-sm-2">
			<label>Kata Kunci Cari</label>
			<input type="text" class="form-control" name="value" placeholder="Value" value="<?= $this->input->get('value') ?>">
		</div>
		<div class="form-group col-sm-2">
			<label>Submit</label>
			<button type="submit" class="btn btn-block btn-primary">Filter</button>
		</div>
	</div>
</form>
<div class="table-responsive">
<table class="table table-bordered">
	<thead>
		<tr>
			<th>ID</th>
			<th>NAMA LENGKAP</th>
			<th>USERNAME</th>
			<th>NOMOR TELEPON</th>
			<th>STATUS</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($table as $key => $value) {
?>
			<tr>
				<td><?= htmlentities($value['id_user']) ?></td>
				<td><?= htmlentities($value['nama_lengkap']) ?></td>
				<td><?= htmlentities($value['username']) ?></td>
				<td><?= htmlentities($value['telp']) ?></td>
				<td align="center">
<?php
foreach ($status as $skey => $svalue) {
?>
<a href="<?= base_url('petugas/'.$this->uri->segment(2).'/status/'.$value['id_user'].'/'.$skey) ?>" class="btn btn-<?= ($value['status'] == $skey) ? $svalue['color'] : 'secondary' ?> btn-sm"><?= $svalue['name'] ?></a> 
<?php
}
?>
				</td>
				
				<td align="center">
					<a href="javascript: void(0);" onclick="detail('<?= base_url('petugas/'.$this->uri->segment(2).'/detail/'.$value['id_user']) ?>')" class="btn btn-info btn-sm"><i class="fa fa-search fa-fw"></i></a> 
					<a href="<?= base_url('petugas/'.$this->uri->segment(2).'/form/'.$value['id_user']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i></a> 
					<a href="javascript: void(0);" onclick="confirm_delete('<?= base_url('petugas/'.$this->uri->segment(2).'/delete/'.$value['id_user']) ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw"></i></a>
				</td>
			</tr>
<?php
}
?>
	</tbody>
</table>
<div>
	<?= $this->pagination->create_links() ?>
	<span>Total data: <?= $total_data ?></span>
</div>
</div>
		</div></div>
	</div>
</div>