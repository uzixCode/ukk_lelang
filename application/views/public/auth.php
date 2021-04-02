<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title><?= (config('bartitle')) ? config('bartitle') : $config['bartitle'] ?></title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/public/') ?>images/favicon.ico">
    <!-- Start css -->
    <link href="<?= base_url('assets/public/') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/public/') ?>css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('assets/public/') ?>css/style.css" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>
<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">                    
                    <?= $content ?>
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->        
    <script src="<?= base_url('assets/public/') ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/public/') ?>js/popper.min.js"></script>
    <script src="<?= base_url('assets/public/') ?>js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets/public/') ?>js/modernizr.min.js"></script>
    <script src="<?= base_url('assets/public/') ?>js/detect.js"></script>
    <script src="<?= base_url('assets/public/') ?>js/jquery.slimscroll.js"></script>
    <!-- End js -->
</body>

</html>