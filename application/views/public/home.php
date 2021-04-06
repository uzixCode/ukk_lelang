				<!-- Start row -->
    
                <div class="row "> 
                    <!-- Start col -->
                    <div class="col-lg-12 col-xl-4 ">
                        
                        <div class="card m-b-30 shadow border-primary mb-3" style="background-image: url('<?= base_url('assets/public') ?>/images/bg5.svg');">
                            <div class="card-header ">                                
                                <h5 class="card-title mb-0 text-success">Total Penawaran</h5>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row align-items-center">
                                    <div class="col-6 text-left">
                                    	<h1 class="text-success"><i class="mdi mdi-animation-outline"></i></h1>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h4 class="text-success"><?= currency($widget_history_lelang[0]['total']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start col -->
                    <!-- End col -->
                    <div class="col-lg-12 col-xl-4">
                        <div class="card m-b-30 shadow border-danger mb-3" style="background-image: url('<?= base_url('assets/public') ?>/images/bg6.svg'); ">
                            <div class="card-header">                                
                                <h5 class="card-title mb-0 text-success">Total lelang</h5>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row align-items-center">
                                    <div class="col-6 text-left">
                                    	<h1 class="text-success"><i class="mdi mdi-folder-multiple-outline"></i></h1>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h4 class="text-success"><?= currency($widget_lelang[0]['total']) ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End col -->
                    <!-- End col -->
                    <div class="col-lg-12 col-xl-4">
                        <div class="card m-b-30 shadow border-success mb-3"style="background-image: url('<?= base_url('assets/public') ?>/images/bg9.svg'); ">
                            <div class="card-header">                                
                                <h5 class="card-title mb-0 text-success">Total barang</h5>
                            </div>
                            <div class="card-body pb-0">
                                <div class="row align-items-center">
                                    <div class="col-6 text-left">
                                        <h1 class="text-success"><i class="mdi mdi-folder-outline"></i></h1>
                                    </div>
                                    <div class="col-6 text-right">
                                        <h4 class="text-success"><?= currency($widget_barang[0]['total']) ?></h4>
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