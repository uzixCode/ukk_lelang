<div class="row">
	<div class="col-sm-12">
		<a href="<?= base_url('petugas/'.$this->uri->segment(2)) ?>" class="btn btn-warning" style="margin-bottom: 20px;"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
		<div class="card"><div class="card-body">
			<h4 class="mt-0 mb-3 header-title"><i class="fa fa-plus fa-fw"></i> Tambah Data</h4>
<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>" />
	<div class="form-group">
		<label>Nama Barang *</label>
		<input type="text" class="form-control" name="nama_barang" value="<?= set_value('nama_barang') ?>">
	</div>
	<div class="form-group">
		<label>Harga Barang *</label>
		<input type="number" class="form-control" name="harga_barang" value="<?= set_value('harga_barang') ?>">
	</div>
	<div class="form-group">
		<label>Deskripsi Barang *</label>
		<textarea class="form-control" name="deskripsi_barang" id="summernote"><?= set_value('deskripsi_barang') ?></textarea>
	</div>
	<div class="row">
        <div class="col-lg-6">
			<div class="form-group">Gambar Barang</label>
				<input type="file" class="form-control" id="gambar_barang" name="gambar_barang" placeholder="Gambar" value="<?= set_value('gambar_barang') ?>">
			</div>
		</div>
		<div class="col-lg-6">
			<span class="shadow">
				<center><img src="#" class="img-responsive" style="height: 300px; width: 100%;" id="preview" alt="Format wajib JPG dan PNG. Ukuran file foto tidak boleh lebih dari 3MB"></center>
		     </span>
		</div>
	</div>
	<button type="reset" class="btn btn-danger">Reset</button>
	<button type="submit" class="btn btn-success">Submit</button>
</form>
		</div></div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    function readURL(input) {
		if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#preview').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#gambar_barang').change(function(){
		readURL(this);
	});
	$('#summernote').summernote({
	  height: 150,   //set editable area's height
	  codemirror: { // codemirror options
	    theme: 'monokai'
	  }
	});
});
</script>
