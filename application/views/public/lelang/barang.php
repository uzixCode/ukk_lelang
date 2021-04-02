                <div class="row">
                    <!-- Start col -->
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="card m-b-30">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-5 mb-2">
                                        <div class="product-slider-box product-box-for">
                                            <div class="product-preview">
                                                <img src="<?= file_location($barang['gambar_barang']) ?>"  style="height: 300px; width: 150%" class="img-fluid" alt="product">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-7">
                                        <h3 class="font-22"><?= $barang['nama_barang'] ?></h3>
                                        <p class="text-primary font-26 f-w-7 my-3"><sup class="font-16">Rp </sup><?= currency($barang['harga_barang']) ?></p>
                                        <p class="mb-4"><?= $barang['deskripsi_barang'] ?></p>
                                        <div class="button-list mt-5 mb-5">
                                        	<?php if (user()) { ?>
                                        		<?php if ($penawaran) { ?>
                                                    <h4 class="font-22">Anda sudah memberikan penawaran sebesar <?= rupiah($penawaran['penawaran_harga']) ?></h4>
                                                <?php } else { ?>
                                                    <button class="btn btn-success btn-di font-17" onclick="modal_post('<?= base_url('lelang/penawaran/' . $barang['id_barang']) ?>', 'Penawaran')" <?= (user()) ? '' : 'disabled' ; ?>>
                                                    <i class="typcn typcn-arrow-right-outline"></i> 
                                                    Kirim Penawaran
                                                </button>
                                                <?php } ?>
                                        	<?php } else { ?>
                                        		<a href="<?= base_url('auth/login') ?>" class="btn btn-success font-17"><i class="typcn typcn-arrow-right-outline"></i> Kirim Penawaran</a>
                                        	<?php } ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h5 class="card-title mb-0"><i class="fa fa-history"></i> Riwayat Lelang</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mt-2">
                                                <thead>
                                                    <tr>
                                                        <th>NO</th>
                                                        <th>NAMA</th>
                                                        <th>PENAWARAN HARGA</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    foreach ($history_lelang as $key => $value) {
                                                    ?>
                                                            <tr class="<?= ($no == 1) ? 'table-warning' : '' ?>">
                                                                <td><?= $no ?></td>
                                                                <td><?= ($no == 1) ? '<span class="badge badge-warning" style="margin-right: 5px;"><i class="mdi mdi-crown"></i></span>' : '' ?><?= $value['nama_lengkap'] ?></td>
                                                                <td><?= rupiah($value['penawaran_harga']) ?></td>
                                                            </tr>
                                                    <?php
                                                        $no++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php if (user()) { ?>
<script type="text/javascript">
	function modal_post(url, title) {
		$.ajax({
			type: "GET",
			url: url,
			beforeSend: function() {
				$('#modal-post-body').html('Sedang memuat...');
				$('#modal-post-title').html('<i class="typcn typcn-arrow-right-outline"></i> ' + title);
			},
			success: function(result) {
				$('#modal-post-body').html(result);
				$('#modal-post-title').html('<i class="typcn typcn-arrow-right-outline"></i> ' + title);
			},
			error: function() {
				$('#modal-post-body').html('Terjadi kesalahan.');
				$('#modal-post-title').html('<i class="typcn typcn-arrow-right-outline"></i> ' + title);
			}
		});
		$('#modal-post').modal();
	}
</script>
<?php } ?>
