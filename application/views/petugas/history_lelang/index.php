<div class="row">
	<div class="col-lg-12">
<form style="margin: 20px 0;" method="post" action="<?= base_url('petugas/'.$this->uri->segment(2).'/filter') ?>">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-row">
		<div class="form-group col-lg-4">
			<label>Pembeli Lelang</label>
			<select class="form-control select2" name="user">
				<option value="">Semua</option>
<?php
foreach ($user as $key => $value) {
?>
<option value="<?= $value['id_user'] ?>" <?= ($this->session->userdata('filter_lelang_user') == $value['id_user']) ? 'selected' : '' ?>><?= $value['nama_lengkap'] ?></option>
<?php
}
?>
			</select>
		</div>
		<div class="form-group col-lg-4">
			<label>Barang</label>
			<select class="form-control select2" name="barang">
				<option value="">Semua</option>
<?php
foreach ($barang as $key => $value) {
?>
<option value="<?= $value['id_barang'] ?>" <?= ($this->session->userdata('filter_lelang_barang') == $value['id_barang']) ? 'selected' : '' ?>><?= $value['nama_barang'] ?></option>
<?php
}
?>
			</select>
		</div>
		<div class="form-group col-lg-4">
			<label class="">Submit</label>
			<button type="submit" class="btn btn-block btn-dark">Filter</button>
		</div>
	</div>
</form>
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-table fa-fw"></i> Data</h4>
<form style="margin: 20px 0;">
	<div class="form-row">
		<div class="form-group col-lg-2">
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
		<div class="form-group col-lg-2">
			<label>Tipe Sortir</label>
			<select class="form-control" name="sort_type">
				<option value="">Tipe...</option>
				<option value="asc" <?= ($this->input->get('sort_type') == 'asc') ? 'selected' : '' ?>>ASC</option>
				<option value="desc" <?= ($this->input->get('sort_type') == 'desc') ? 'selected' : '' ?>>DESC</option>
			</select>
		</div>
		<div class="form-group col-lg-2">
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
		<div class="form-group col-lg-2">
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
		<div class="form-group col-lg-2">
			<label>Kata Kunci Cari</label>
			<input type="text" class="form-control" name="value" placeholder="Value" value="<?= $this->input->get('value') ?>">
		</div>
		<div class="form-group col-lg-2">
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
			<th>PENAWAR LELANG</th>
			<th width="200px">NAMA BARANG</th>
			<th width="150px">HARGA DI TAWARKAN</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($table as $key => $value) {
?>
			<tr>
				<td width="20px"><?= $value['id_history'] ?></td>
				<td><?= $value['nama_lengkap'] ?></td>
				<td><?= $value['nama_barang'] ?></td>
				<td><?= rupiah($value['penawaran_harga']) ?></td>
				<td align="center">
					<a href="javascript: void(0);" onclick="accept('<?= base_url('petugas/'.$this->uri->segment(2).'/form/'.$value['id_history']) ?>')" class="btn btn-success <?= ($value['status'] <> 'dibuka') ? 'disabled' : '' ?> btn-sm" ><i class="fa fa-check fa-fw"></i></a> 
					<a href="javascript: void(0);" onclick="detail('<?= base_url('petugas/'.$this->uri->segment(2).'/detail/'.$value['id_history']) ?>')" class="btn btn-info btn-sm"><i class="fa fa-search fa-fw"></i></a> 
					<a href="javascript: void(0);" onclick="confirm_delete('<?= base_url('petugas/'.$this->uri->segment(2).'/delete/'.$value['id_history']) ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw"></i></a>
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

<div class="modal fade" id="modal-accept" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center"><i class="fa fa-check fa-fw"></i> Pemenang Lelang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="modal-accept-body">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function accept(url) {
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function() {
			$('#modal-accept-body').html('Sedang memuat...');
		},
		success: function(result) {
			$('#modal-accept-body').html(result);
		},
		error: function() {
			$('#modal-accept-body').html('Terjadi kesalahan.');
		}
	});
	$('#modal-accept').modal();
}
</script>