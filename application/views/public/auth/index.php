								<div class="row">
									<div class="col-md-5">
										<div class="row">
											<div class="col-md-12">
		                                        <div class="card m-b-20">
		                                            <div class="card-body">
		                                                <div class="ecom-dashboard-widget">
		                                                    <div class="media">
		                                                        <i class="ri-dropbox-line"></i>
		                                                        <div class="media-body">
		                                                            <h5>Total penawaran anda</h5>
		                                                            <p><?= currency($widget_history_lelang[0]['total']) ?></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-md-12">
		                                        <div class="card m-b-20">
		                                            <div class="card-body">
		                                                <div class="ecom-dashboard-widget">
		                                                    <div class="media">
		                                                        <i class="mdi mdi-folder-multiple-outline"></i>
		                                                        <div class="media-body">
		                                                            <h5>Total lelang</h5>
		                                                            <p><?= currency($widget_lelang[0]['total']) ?></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                    <div class="col-md-12">
		                                        <div class="card m-b-20">
		                                            <div class="card-body">
		                                                <div class="ecom-dashboard-widget">
		                                                    <div class="media">
		                                                        <i class="mdi mdi-folder-outline"></i>
		                                                        <div class="media-body">
		                                                            <h5>Total barang</h5>
		                                                            <p><?= currency($widget_barang[0]['total']) ?></p>
		                                                        </div>
		                                                    </div>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>			
										</div>																
									</div>
									<div class="col-md-7">
										<div class="card m-b-30">
		                                    <div class="card-header">                                
		                                        <h5 class="card-title mb-0"><i class="ri-dashboard-line"></i> Dashboard</h5>
		                                    </div>
		                                    <div class="card-body">
		                                        <div class="profilebox py-4 text-center">
		                                            <img src="<?= base_url('assets/') ?>public/images/users/profile.svg" class="img-fluid mb-3" alt="profile">
		                                            <div class="profilename">
		                                                <h5><?= user('nama_lengkap') ?></h5>
		                                                <p class="text-muted my-3"><a href="<?= base_url('user/setting') ?>"><i class="mdi mdi-cogs mr-2"></i>Pengaturan akun</a></p>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>	
									</div>
								</div>
			                	<div class="row">
			                    <!-- Start col -->
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