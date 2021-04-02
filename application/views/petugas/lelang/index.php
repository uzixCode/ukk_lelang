
<div class="row">
	<div class="col-lg-12">
<form style="margin: 20px 0;" method="post" action="<?= base_url('petugas/'.$this->uri->segment(2).'/filter') ?>">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-row">
		<div class="form-group col-lg-3">
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
		<div class="form-group col-lg-3">
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
		<div class="form-group col-lg-3">
			<label>Status</label>
			<select class="form-control select2" name="status_lelang">
				<option value="">Semua</option>
				<option value="dibuka" <?= ($this->session->userdata('filter_lelang_status') == 'dibuka') ? 'selected' : '' ?>>DI BUKA</option>
				<option value="ditutup" <?= ($this->session->userdata('filter_lelang_status') == 'ditutup') ? 'selected' : '' ?>>DI TUTUP</option>
			</select>
		</div>
		<div class="form-group col-lg-3">
			<label class="">Submit</label>
			<button type="submit" class="btn btn-block btn-dark">Filter</button>
		</div>
	</div>
</form>
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
			<th>PETUGAS</th>
			<th>PEMBELI LELANG</th>
			<th width="200px">NAMA BARANG</th>
			<th width="150px">HARGA AWAL</th>
			<th width="150px">HARGA AKHIR</th>
			<th>GAMBAR BARANG</th>
			<th>STATUS LELANG</th>
			<th>AKSI</th>
		</tr>
	</thead>
	<tbody>
<?php
foreach ($table as $key => $value) {
?>
			<tr>
				<td width="20px"><?= $value['id_lelang'] ?></td>
				<td><?= $value['nama_petugas'] ?></td>
				<td><?= ($value['nama_lengkap']) ? $value['nama_lengkap'] : '<center>-</center>'; ?></td>
				<td><?= $value['nama_barang'] ?></td>
				<td><?= rupiah($value['harga_barang']) ?></td>
				<td><?= ($value['harga_akhir']) ? rupiah($value['harga_akhir']) : '<center>-</center>'; ?></td>
				<td width="250px">
					<a href="#" id="pop">
                        <img id="imgResource" src="<?= file_location($value['gambar_barang']) ?>" class="img-thumbnail" style="width: 100%; height: 200px;"></td>
                    </a>
                </td>
                <td align="center">
<?php
foreach ($status as $skey => $svalue) {
?>
<a href="<?= base_url('petugas/'.$this->uri->segment(2).'/status/'.$value['id_lelang'].'/'.$svalue['status']) ?>" class="btn btn-<?= ($value['status'] == $svalue['status']) ? $svalue['color'] : 'secondary' ?> btn-sm"><?= $svalue['name'] ?></a> 
<?php
}
?>
				</td>
				<td align="center">
					<a href="javascript: void(0);" onclick="detail('<?= base_url('petugas/'.$this->uri->segment(2).'/detail/'.$value['id_lelang']) ?>')" class="btn btn-info btn-sm"><i class="fa fa-search fa-fw"></i></a>
					<a href="javascript: void(0);" onclick="confirm_delete('<?= base_url('petugas/'.$this->uri->segment(2).'/delete/'.$value['id_lelang']) ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash fa-fw"></i></a>
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

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
       
        <h4 class="modal-title" id="myModalLabel">Gambar</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <img src="" id="imagepreview" style="width: 100%; height: 500px;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
    $("#pop").on("click", function() {
        $('#imagepreview').attr('src', $('#imgResource').attr('src')); // Di sini masukkan gambar ke modal ketika pengguna mengklik gambar untuk di perbesar
        $('#imagemodal').modal('show'); // imagemodal adalah atribut id yang ditetapkan ke modal bootstrap, disini menggunakan fungsi show modal
    });
});
</script>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-center"><i class="fa fa-edit fa-fw"></i> Ubah Data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body" id="modal-accept-body">
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function edit(url) {
	$.ajax({
		type: "GET",
		url: url,
		beforeSend: function() {
			$('#modal-edit-body').html('Sedang memuat...');
		},
		success: function(result) {
			$('#modal-edit-body').html(result);
		},
		error: function() {
			$('#modal-edit-body').html('Terjadi kesalahan.');
		}
	});
	$('#modal-edit').modal();
}
</script>