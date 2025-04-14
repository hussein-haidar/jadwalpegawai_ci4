<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?> | <?= $title2 ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url() ?>/template/plugins/iCheck/square/blue.css">
    <!-- Custom icon styles for this template-->
    <link href="<?= base_url() ?>/icon/bpjs.ico" rel="shortcut icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<!-- Custom CSS to change background to batik image -->
<style>
    .login-page {
        background: url('<?= base_url() ?>/bgimage/BPJS.ico') no-repeat center center fixed;
        background-size: cover;
    }

    .login-logo {
        text-align: center;
        font-size: 24px;
        /* Ubah ukuran font di sini */
    }
</style>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-box-body">
            <div class="login-logo">
                <b>Reset Password</b>
            </div>

            <?php
            // Tampilkan pesan jika ada flashdata dari session
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success" role="alert">' . session()->getFlashdata('pesan') . '</div>';
            }

            if (session()->getFlashdata('pesan_warning')) {
                echo '<div class="alert alert-warning" role="alert">' . session()->getFlashdata('pesan_warning') . '</div>';
            }
            ?>

            <!-- Formulir Reset Password -->
            <form action="<?= base_url('auth/proses_lupa_password') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Nama Pengguna</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan Nama Pengguna" value="<?= old('username') ?>">
                    <small class="text-danger"><?= session()->getFlashdata('error_username') ?></small>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <a href="<?= base_url('auth/login') ?>" class="btn btn-link">Login</a>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary">Kirim Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="<?= base_url() ?>/template/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/template/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
</body>

</html>