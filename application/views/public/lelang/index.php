                <div class="row">
                    <!-- Start col -->
                    	<div class="col-md-12">
<form style="margin: 20px 0;">
	<div class="form-row">
		<div class="form-group col-lg-3">
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
		<div class="form-group col-lg-3">
			<label>Tipe Sortir</label>
			<select class="form-control" name="sort_type">
				<option value="">Tipe...</option>
				<option value="asc" <?= ($this->input->get('sort_type') == 'asc') ? 'selected' : '' ?>>ASC</option>
				<option value="desc" <?= ($this->input->get('sort_type') == 'desc') ? 'selected' : '' ?>>DESC</option>
			</select>
		</div>
		<div class="form-group col-lg-3">
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
		<div class="form-group col-lg-3">
			<label>Kata Kunci Cari</label>
			<input type="text" class="form-control" name="value" placeholder="Value" value="<?= protect_html($this->input->get('value')) ?>">
		</div>
		<div class="form-group col-lg-12">
			<label>Submit</label>
			<button type="submit" class="btn btn-block btn-primary">Filter</button>
		</div>
	</div>
</form>                    		
                    	</div>
	                    <?php foreach ($barang as $key => $value) { ?>
	                    <div class="col-lg-6 col-xl-4">
	                        <div class="card m-b-30 shadow">
	                        	<div class="card-body">
	                        		<div class="product-bar m-b-30">
	                            <div class="product-head">
	                                <a href="<?= base_url('lelang/barang/' . $value['slug_barang']) ?>"><img src="<?= file_location($value['gambar_barang']) ?>" style="height: 200px; width: 150%" class="img-fluid" alt="product"></a>
	                            </div>                                            
	                            <div class="product-body py-3">
	                                <div class="row align-items-center">
	                                    <div class="col-12">
	                                    </div>
	                                </div>
	                                <div class="row align-items-center mt-1">
	                                    <div class="col-12">
	                                        <h6 class="mt-1 mb-3"><?= $value['nama_barang'] ?></h6>
	                                    </div>
	                                </div>
	                                <div class="row align-items-center">
	                                    <div class="col-6">
	                                        <div class="text-left">
	                                            <h5 class="f-w-7 mb-0"><?= rupiah($value['harga_barang']) ?></h5>
	                                        </div>
	                                    </div>
	                                    <div class="col-6">
	                                        <div class="text-right">
	                                            <a href="<?= base_url('lelang/barang/' . $value['slug_barang']) ?>" class="btn btn-primary rounded-circle font-18"><i class="ri-shopping-cart-line"></i></a>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                       </div>
	                        	</div>
	                        </div>
	                	</div>
	               		<?php } ?>
                   <!-- End col -->
               </div>