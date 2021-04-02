<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?= (config('meta_description')) ? config('meta_description') : $config['meta']['description'] ?>" />
    <meta name="keywords" content="<?= (config('meta_keywords')) ? config('meta_keywords') : $config['meta']['keywords'] ?>" />
    <meta name="author" content="<?= (config('meta_author')) ? config('meta_author') : $config['meta']['author'] ?>" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= (config('bartitle')) ? config('bartitle') : $config['bartitle'] ?>" />
    <meta property="og:description" content="<?= (config('meta_description')) ? config('meta_description') : $config['meta']['description'] ?>" />
    <meta property="og:site_name" content="<?= (config('title')) ? config('title') : $config['title'] ?>" />
    <link rel="canonical" href="<?= base_url() ?>" />
    <title><?= (config('bartitle')) ? config('bartitle') : $config['bartitle'] ?></title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/public') ?>assets/images/favicon.ico">
    <!-- Start css -->
    <!-- Switchery css -->
    <link href="<?= base_url('assets/public') ?>/plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/public') ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/public') ?>/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/public') ?>/css/flag-icon.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/public') ?>/css/style.css" rel="stylesheet" type="text/css">
    <!-- End css -->
    <!-- Start js -->        
    <script src="<?= base_url('assets/public') ?>/js/jquery.min.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/popper.min.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/modernizr.min.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/detect.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/jquery.slimscroll.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/horizontal-menu.js"></script>
    <!-- Switchery js -->
    <script src="<?= base_url('assets/public') ?>/plugins/switchery/switchery.min.js"></script>
     <!-- Form Step js -->
    <script src="<?= base_url('assets/public') ?>/plugins/jquery-step/jquery.steps.min.js"></script>
    <script src="<?= base_url('assets/public') ?>/js/custom/custom-form-wizard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.5/clipboard.min.js"></script>
    <style>
        .hide {display:none !important;}
    </style>
</head>
<body class="horizontal-layout">    
    <!-- Start Infobar Setting Sidebar -->
    <div class="infobar-settings-sidebar-overlay"></div>
    <!-- End Infobar Setting Sidebar -->
    <!-- Start Containerbar -->
    <div id="containerbar" class="container-fluid">
        <!-- Start Leftbar -->        
        <!-- End Leftbar -->
        <!-- Start Rightbar -->
        <div class="rightbar">
            <!-- Start Topbar Mobile -->
            <div class="topbar-mobile">
                <div class="row align-items-center">
                    <div class="col-md-12">

                        <div class="mobile-logobar">
                            <a href="<?= base_url() ?>" class="mobile-logo"><h4 class="logo logo-large text-primary text-uppercase">
                                <?= (config('title')) ? config('title') : $config['title'] ?>                    
                            </h4></a>
                        </div>
                        <div class="mobile-togglebar">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <div class="menubar">
                                        <a class="menu-hamburger navbar-toggle bg-transparent" href="javascript:void();" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="true">
                                            <i class="ri-menu-2-line menu-hamburger-collapse"></i>
                                            <i class="ri-close-line menu-hamburger-close"></i>
                                        </a>
                                     </div>
                                </li>                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Start Topbar -->
            <div class="topbar">
                <div class="container-fluid">
                    <!-- Start row -->
                    <div class="row align-items-center">
                        <!-- Start col -->
                        <div class="col-md-12 align-self-center">
                            <div class="togglebar">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="logobar">
                                            <a href="<?= base_url() ?>" class="logo logo-large"><h4 class="text-primary text-uppercase"><?= (config('short_title')) ? config('title') : $config['title'] ?> </h4></a>                
                                            </h4>
                                        </div>                                    
                                    </li>
                                </ul>
                            </div>
                            <div class="infobar">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <div class="profilebar">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle" href="#" role="button" id="profilelink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= base_url('assets/public') ?>/images/users/profile.svg" class="img-fluid" alt="profile"><span class="live-icon"><?= (user()) ? user('nama_lengkap') : 'Haii' ; ?></span></a>
                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilelink">
                                                    <?php if(user()) { ?>
                                                        <a class="dropdown-item" href="<?= base_url('user/setting') ?>"><i class="mdi mdi-cogs"></i>Pengaturan Akun</a>
                                                        <a class="dropdown-item text-danger" href="<?= base_url('auth/logout') ?>"><i class="ri-shut-down-line"></i>Logout</a>
                                                    <?php } else { ?>
                                                        <a class="dropdown-item" href="<?= base_url('auth/login') ?>"><i class="ri-user-6-line"></i>Masuk</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>                                   
                                    </li>
                                    <li class="list-inline-item menubar-toggle">
                                        <div class="menubar">
                                            <a class="menu-hamburger navbar-toggle bg-transparent" href="javascript:void();" data-toggle="collapse" data-target="#navbar-menu" aria-expanded="true">
                                                <i class="ri-menu-2-line menu-hamburger-collapse"></i>
                                                <i class="ri-close-line menu-hamburger-close"></i>
                                            </a>
                                         </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End col -->
                    </div> 
                    <!-- End row -->
                </div>
            </div>
            <!-- End Topbar -->
            <!-- Start Navigationbar -->
            <div class="navigationbar">
                <!-- Start container-fluid -->
                <div class="container-fluid">
                    <!-- Start Horizontal Nav -->
                    <nav class="horizontal-nav mobile-navbar fixed-navbar">
                        <div class="collapse navbar-collapse" id="navbar-menu">
                            <?php if (user()) { ?>
                                <ul class="horizontal-menu">
                                    <li class="scroll"><a href="<?= base_url() ?>"><i class="ri-dashboard-line"></i><span>Dashboard</span></a></li>
                                </ul>
                                <ul class="horizontal-menu">
                                    <li class="scroll"><a href="<?= base_url('lelang') ?>"><i class="mdi mdi-folder-multiple-outline"></i><span>Barang Lelang</span></a></li>
                                </ul>  
                                <ul class="horizontal-menu"> 
                                    <li class="dropdown">
                                        <a href="javaScript:void();" class="dropdown-toggle" data-toggle="dropdown"><i class="mdi mdi-cogs"></i><span>Pengaturan Akun</span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?= base_url('user/setting') ?>">Pengaturan</a></li>
                                            <li><a href="<?= base_url('auth/logout') ?>">Logout</a></li>
                                        </ul>
                                    </li>    
                                </ul>   
                            <?php } else { ?>
                                <ul class="horizontal-menu">
                                    <li class="scroll"><a href="<?= base_url() ?>"><i class="ri-dashboard-line"></i><span>Halaman Utama</span></a></li>
                                </ul>
                                <ul class="horizontal-menu">
                                    <li class="scroll"><a href="<?= base_url('auth/login') ?>"><i class="mdi mdi-login-variant"></i><span>Masuk</span></a></li>
                                </ul>
                                <ul class="horizontal-menu">
                                    <li class="scroll"><a href="<?= base_url('auth/register') ?>"><i class="mdi mdi-account-plus-outline"></i><span>Daftar</span></a></li>
                                </ul> 
                                <ul class="horizontal-menu">
                                    <li class="scroll"><a href="<?= base_url('lelang') ?>"><i class="mdi mdi-folder-multiple-outline"></i><span>Barang Lelang</span></a></li>
                                </ul> 
                            <?php } ?>
                        </ul>
                        </div>
                    </nav>
                    <!-- End Horizontal Nav -->
                </div>
                <!-- End container-fluid -->
            </div>
            <!-- End Navigationbar -->
            <!-- Start Breadcrumbbar -->                    
            <div class="breadcrumbbar">
                <div class="row align-items-center">
                    <div class="col-md-8 col-lg-8">
                        <h4 class="page-title"> <?= (config('title')) ? config('title') : $config['title'] ?></h4>
                        <div class="breadcrumb-list">
                            <ol class="breadcrumb">
                                <?php if($this->uri->segment(1) == null) : ?>
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <?= 'Halaman Utama' ?> 
                                    </a>
                                </li>
                                <?php endif; ?>
                                <?php if($this->uri->segment(1)) : ?>
                                    <li class="breadcrumb-item">
                                        <?= ucfirst($this->uri->segment(1)) ?> 
                                    </li>
                                <?php endif; ?>
                                <?php if($this->uri->segment(2)) : ?>
                                    <?php if($this->uri->segment(2) == 'barang'): ?>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <?php  
                                                $uri = str_replace('-', ' ', $this->uri->segment(3));
                                                echo ucwords($uri); 
                                            ?> 
                                        </li>
                                    <?php else: ?>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            <?php  
                                                $uri = str_replace('-', ' ', $this->uri->segment(2));
                                                echo ucwords($uri); 
                                            ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </ol>       
                        </div>
                    </div>
                </div>          
            </div>
            <!-- End Breadcrumbbar -->
            <!-- Start Contentbar -->    
            <div class="contentbar">   
                <?php
                    $this->load->view('result');
                    echo $content;
                ?>
            </div>
            <!-- End Contentbar -->
            <!-- Start Footerbar -->
            <div class="footerbar">
                <footer class="footer">
                    <p class="mb-0">© <?= date('Y') ?> <?= (config('bartitle')) ? config('bartitle') : $config['bartitle'] ?>.</p>
                </footer>
            </div>
            <!-- End Footerbar -->
        </div>
        <!-- End Rightbar -->
    </div>
    <!-- End Containerbar -->
    <?php if (user()) { ?>
        <div class="modal fade" id="modal-post" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-post-title"> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body" id="modal-post-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>        
    <!-- Core js -->
    <script src="<?= base_url('assets/public') ?>/js/core.js"></script>
    <!-- End js -->
</body>
</html>