<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap/bootstrap.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/law-icons/font/flaticon.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/slick-theme.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">

    <script src="<?= base_url() ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="assets/images/login.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">

                            <div class="brand-wrapper">
                                <a class="navbar-brand" href="/">Clean<span style="color:aquamarine">Pit</span></a>
                            </div>
                            <p class="login-card-description">Sign into your account as</p>


                            <div class="tab-content">
                                <?php if (session()->getFlashdata('pesan')) { ?>
                                    <div class="alert alert-warning">
                                        <?php echo session()->getFlashdata('pesan'); ?>
                                    </div>
                                <?php } ?>
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-anggota" role="tab" aria-controls="nav-home" aria-selected="true">Login</a>
                                        <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-volunteer" role="tab" aria-controls="nav-contact" aria-selected="false">Register</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-anggota" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <br>

                                        <br>
                                        <form action="/AuthController/Login" method="post">
                                            <?= csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="username" class="sr-only">Username</label>
                                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="password" class="sr-only">Password</label>
                                                <input type="password" name="password" id="password" class="form-control" placeholder="***********">
                                                <input type="hidden" name="role" id="role" value="2">
                                            </div>
                                            <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
                                        </form>
                                        <a href="#!" class="forgot-password-link">Forgot password?</a>
                                    </div>

                                    <div class="tab-pane fade" id="nav-volunteer" role="tabpanel" aria-labelledby="nav-contact-tab">

                                        <br>
                                        <p class="login-card-footer-text">Buka halaman pendaftaran <a href="/register">disini</a></p>
                                    </div>

                                </div>

                            </div>

                            <nav class="login-card-footer-nav">
                                <a href="#!">Terms of use.</a>
                                <a href="#!">Privacy policy</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

</body>

</html>