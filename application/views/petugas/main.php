<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="<?= (config('meta_description')) ? config('meta_description') : $config['meta']['description'] ?>" />
	<meta name="keywords" content="<?= (config('meta_keywords')) ? config('meta_keywords') : $config['meta']['keywords'] ?>" />
	<meta name="author" content="<?= (config('meta_author')) ? config('meta_author') : $config['meta']['author'] ?>" />
	<title><?= (config('title')) ? config('title') : $config['title'] ?></title>
	<link rel="shortcut icon" href="<?= (config('favicon')) ? config('favicon') : $config['favicon'] ?>">

	<!--Morris Chart CSS -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<!--Select2 CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
	<!--Summernote CSS -->
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
	<!-- App css -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('template/material-design/') ?>assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('template/material-design/') ?>assets/css/icons.css" />
	<link rel="stylesheet" type="text/css" href="<?= base_url('template/material-design/') ?>assets/css/style.css" />

	<link rel="stylesheet" href="<?= base_url('template/') ?>plugins/switchery/switchery.min.css">
	<!-- jQuery  -->
	<script src="<?= base_url('template/material-design/') ?>assets/js/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="<?= base_url('template/material-design/') ?>assets/js/modernizr.min.js"></script>

	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script> 
</head>


<body class="fixed-left">

	<!-- Loader -->
	<div id="preloader">
		<div id="status">
			<div class="spinner">
				<div class="spinner-wrapper">
					<div class="rotator">
						<div class="inner-spin"></div>
						<div class="inner-spin"></div>
					</div>
				</div>
			</div>
		</div>
	</div>    

	<!-- Begin page -->
	<div id="wrapper">

		<!-- Top Bar Start -->
		<div class="topbar">

			<!-- LOGO -->
			<div class="topbar-left">
				<a href="<?= base_url() ?>" class="logo"><span><?= (config('title')) ? config('title') : $config['title'] ?></span><i class="mdi mdi-cube"></i></a>
				<!-- Image logo -->
				<!--<a href="index.html" class="logo">-->
					<!--<span>-->
						<!--<img src="assets/images/logo.png" alt="" height="30">-->
						<!--</span>-->
						<!--<i>-->
							<!--<img src="assets/images/logo_sm.png" alt="" height="28">-->
							<!--</i>-->
							<!--</a>-->
						</div>

						<!-- Button mobile view to collapse sidebar menu -->
						<div class="navbar navbar-default" role="navigation">
							<div class="container-fluid">

								<div class="clearfix">
									<!-- Navbar-left -->
									<ul class="nav navbar-left">
										<li>
											<button class="button-menu-mobile open-left waves-effect text-danger">
												<i class="mdi mdi-menu text-white"></i>
											</button>
										</li>


									</ul>
									<?php if(petugas()) { ?>
										<!-- Right(Notification) -->
										<ul class="nav navbar-right"> 

											<li class="dropdown user-box">
												<a href="#" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
													<img src="<?= base_url() ?>template/material-design/assets/images/users/avatar-1.jpg" alt="user-img" class="rounded-circle user-img">
												</a>

												<ul class="dropdown-menu dropdown-menu-right user-list notify-list">
													<li>
														<h5>Hai, <?= petugas('nama_petugas') ?></h5>
													</li>
													<li><a href="<?= base_url('petugas/auth/logout') ?>" class="dropdown-item"><i class="ti-power-off m-r-5"></i> Logout</a></li>
												</ul>
											</li>

										</ul> <!-- end navbar-right -->
									<?php } ?>
								</div>

							</div><!-- end container -->
						</div><!-- end navbar -->
					</div>
					<!-- Top Bar End -->


					<!-- ========== Left Sidebar Start ========== -->
					<div class="left side-menu">
						<div class="sidebar-inner slimscrollleft">

							<!--- Sidemenu -->
							<div id="sidebar-menu">
								<ul class="navigation-menu">
									<li class="has_sub">
										<a href="<?= base_url('petugas') ?>"><i class="fa fa-home fa-fw"></i><span>Dashboard</span></a>
									</li>
									<?php if (petugas()) { ?>
										<?php if (petugas('level') == 'administrator') { ?>
										<li class="has_sub">
											<a href="<?= base_url('petugas/petugas') ?>"><i class="fa fa-user-secret fa-fw"></i><span>Petugas</span></a>
										</li>
										<?php } ?>
										<li class="has_sub">
											<a href="<?= base_url('petugas/user') ?>"><i class="fa fa-user-secret fa-fw"></i><span>Penggguna</span></a>
										</li>
										<li class="has_sub">
											<a href="<?= base_url('petugas/barang') ?>"><i class="fa fa-folder fa-fw"></i><span>Barang</span></a>
										</li>
										<li class="has_sub">
											<a href="#"><i class="fa fa-bullhorn fa-fw"></i><span>Lelang</span></a>
											<ul class="list-unstyled">
												<li><a href="<?= base_url('petugas/lelang') ?>">Daftar Lelang</a></li>
												<li><a href="<?= base_url('petugas/history_lelang') ?>">History Lelang</a></li>
											</ul>
										</li>
										<?php if (petugas('level') == 'administrator') { ?>
										<li class="has_sub">
											<a href="<?= base_url('petugas/website_config') ?>"><i class="fa fa-globe fa-fw"></i><span>Pengaturan Website</span></a>
										</li>
										<?php } ?>
									<?php } ?>
									</ul>
								</div>
								<!-- Sidebar -->
								<div class="clearfix"></div>

							</div>
							<!-- Sidebar -left -->

						</div>
						<!-- Left Sidebar End -->


						<!-- ============================================================== -->
						<!-- Start right Content here -->
						<!-- ============================================================== -->
						<div class="content-page">
							<!-- Start content -->
							<div class="content">
								<div class="container-fluid">
									<div class="row">
										<div class="col-12">
											<div class="page-title-box">
												<h4 class="page-title">Dashboard</h4>
												<ol class="breadcrumb p-0 m-0">
													<li class="breadcrumb-item">
														<a href="#"><?= (config('title')) ? config('title') : $config['title'] ?></a>
													</li>
													<?php if($this->uri->segment(1)) : ?>
														<li class="breadcrumb-item text-uppercase">
															<a href="#"><?= $this->uri->segment(1) ?></a>
														</li>
													<?php endif; ?>
													<?php if($this->uri->segment(2)) : ?>
														<li class="breadcrumb-item text-uppercase active">
															<?= $this->uri->segment(2) ?>
														</li>
													<?php endif; ?>
												</ol>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12"><?php $this->load->view('result') ?>
									</div>
								</div>		
								<?= $content ?>

							</div> <!-- container-fluid -->

						</div> <!-- content -->

						<footer class="footer text-primary">
							<?= date('Y') ?> © <?= (config('title')) ? config('title') : $config['title'] ?> 
						</footer>

					</div>

				</div>
				<!-- END wrapper -->

				<script>
					var resizefunc = [];
				</script>

				<script src="<?= base_url('template/material-design/') ?>assets/js/jquery.core.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/jquery.app.js"></script>

				<script src="<?= base_url('template/material-design/') ?>assets/js/bootstrap.bundle.min.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/detect.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/fastclick.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/jquery.blockUI.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/waves.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/jquery.slimscroll.js"></script>
				<script src="<?= base_url('template/material-design/') ?>assets/js/jquery.scrollTo.min.js"></script>
				<script src="<?= base_url('template') ?>/plugins/switchery/switchery.min.js"></script>

				<!-- Counter js  -->
				<script src="<?= base_url('template') ?>/plugins/waypoints/jquery.waypoints.min.js"></script>
				<script src="<?= base_url('template') ?>/plugins/counterup/jquery.counterup.min.js"></script>


				<!-- App js -->
				<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog modal-dialog-centered modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-center"><i class="fa fa-trash fa-fw"></i> Hapus Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body">
								<span>
									Apakah Anda yakin akan menghapus data dari <b id="target"></b> ??
									<br>
									Jika iya maka data yang bersangkutan akan ikut terhapus !! 
								</span> 
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
								<a href="#" class="btn btn-primary" id="btn-yes">Ya, Hapus</a>
							</div>
						</div>
					</div>
				</div>
				<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title text-center"><i class="fa fa-search fa-fw"></i> Detail Data</h5>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="modal-detail-body">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
				<script type="text/javascript">
					function confirm_delete(url, data) {
						$('#modal-delete #btn-yes').attr({'href' : url});
						$('#modal-delete #target').html(data);
						$('#modal-delete').modal();
					}
					function detail(url) {
						$.ajax({
							type: "GET",
							url: url,
							beforeSend: function() {
								$('#modal-detail-body').html('Sedang memuat...');
							},
							success: function(result) {
								$('#modal-detail-body').html(result);
							},
							error: function() {
								$('#modal-detail-body').html('Terjadi kesalahan.');
							}
						});
						$('#modal-detail').modal();
					}
				</script>
				<script type="text/javascript">
					$(document).ready(function() {
						$('.select2').select2();
					});
				</script>
			</body>
			</html>