<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BorneoFT - Rekap Data">
    <meta name="author" content="BorneoFT">
    <title>Login Page | BorneoFT - Rekap Data</title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/img/icon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>assets/login/main.css" rel="stylesheet">
    <link href="<?= base_url() ?>assets/login/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
</head>

<body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern" style="margin-top:50px">
        <div class="auth-box-w">
            <div class="logo-w">
                <a href="index.html"><img alt="" src="<?= base_url() ?>assets/img/logo.png" style="width: 200px;"></a>
            </div>
            <h4 class="auth-header">
                Login Form
            </h4>
            <form action="<?= base_url('auth') ?>" method="POST">
                <?= $this->session->flashdata('message'); ?>
                <div class="form-group">
                    <label for="">E-mail</label>
                    <input class="form-control" placeholder="Enter your username" type="email" name="email" required>
                    <div class="pre-icon os-icon os-icon-email-2-at"></div>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input class="form-control" placeholder="Enter your password" type="password" name="password" required>
                    <div class="pre-icon icon-lock"></div>
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="<?= base_url() ?>assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        window.setTimeout(function() {
            $('.alert').fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 2500);
    });
</script>

</html>