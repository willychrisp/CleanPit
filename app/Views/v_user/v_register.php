<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/law-icons/font/flaticon.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/fonts/fontawesome/css/font-awesome.min.css">


    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/slick-theme.css">

    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<body>
    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
        <div class="container">
            <div class="card login-card">
                <div class="row no-gutters">
                    <div class="col-md-5">
                        <img src="assets/images/regis.jpg" alt="login" class="login-card-img">
                    </div>
                    <div class="col-md-7">
                        <div class="card-body">
                            <div class="brand-wrapper">
                                <a class="navbar-brand" href="/">Clean<span style="color:aquamarine">Pit</span></a>
                            </div>
                            <p class="login-card-description">Sign up for free</p>
                            <form action="/AuthController/DaftarVolunteer" id="formDaftar" method="POST" enctype="multipart/form-data" style="padding-left: 50px;" onsubmit="validateForm(event)">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="nama">Nama lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama lengkap" autofocus>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Tulis username">
                                    <span id="email_result"></span>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal lahir</label>
                                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal lahir" name="tanggal">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat sesuai KTP</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Tulis alamat sesuai dengan KTP">
                                </div>
                                <label>Foto lampiran KTP</label>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <img src="/img/default.png" class="img-thumbnail img-preview" alt="">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="foto-ktp">Foto</label>
                                        <input type="file" class="" id="foto-ktp" name="foto-ktp" onchange="showPreview();">
                                    </div>
                                </div>
                                <label>Foto Profil</label>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <img src="/img/data_volunteer/user.png" class="img-thumbnail img-preview-profil" alt="">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="foto-profil">Foto Profil</label>
                                        <input type="file" class="" id="foto-profil" name="foto-profil" onchange="showPreviewprofil();">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="hp">No HP</label>
                                    <input type="number" class="form-control" id="hp" name="hp" placeholder="Masukkan nomor HP...">

                                </div>
                                <div class="form-group">
                                    <label for="nama">Pasword</label>
                                    <input type="text" class="form-control" id="password" name="password" placeholder="***********">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Confirm password</label>
                                    <input type="text" class="form-control" id="cpassword" name="cpassword" placeholder="***********">
                                </div>
                                <div class="form-group">
                                    <label for="biodata">Biodata</label>
                                    <input type="text" class="form-control" id="biodata" name="biodata" placeholder="Tulis biodata">

                                </div>
                                <div class="form-group">
                                    <input class="btn btn-block login-btn mb-4" type="submit">
                                </div>

                            </form>
                            <p class="login-card-footer-text">Have an account? <a href="/login">Login</a></p>
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


    <script type="text/javascript">
        $(document).ready(function() {
            $('#username').change(function() {
                var username = $('#username').val();
                console.log(username);
                if (username != '') {
                    $.ajax({
                        url: "AuthController/usernameAvailability",
                        method: "POST",
                        data: {
                            username: username
                        },

                        success: function(data) {
                            $('#email_result').html(data);
                        }
                    });
                }
            });
        });

        function validateForm(e) {
            e.preventDefault();

            var nama = document.getElementById("nama").value;
            var username = document.getElementById("username").value;
            var tanggal = document.getElementById("tanggal").value;
            var alamat = document.getElementById("alamat").value;
            var foto = document.getElementById("foto-ktp").value;
            var foto_profil = document.getElementById("foto-profil").value;
            var hp = document.getElementById("hp").value;
            var password = document.getElementById("password").value;
            var cpassword = document.getElementById("cpassword").value;
            var biodata = document.getElementById("biodata").value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

            if (nama == "" || username == "" || tanggal == "" || alamat == "" || foto == "" || hp == "" || biodata == "" || password == "" || cpassword == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tidak boleh ada field yang kosong',
                });

                return false;
            } else if (nama.length < 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama laporan setidaknya berisi 5 karakter',
                });
                return false;
            } else if (alamat.length < 10) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'alamat laporan setidaknya berisi 10 karakter',
                });
                return false;
            } else if (!allowedExtensions.exec(foto)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'File yang diupload harus memiliki ektensi .JPG, .JPEG, atau .PNG',
                });
                return false;
            } else if (!allowedExtensions.exec(foto_profil)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Foto profil yang diupload harus memiliki ektensi .JPG, .JPEG, atau .PNG',
                });
                return false;
            } else if (cpassword != password) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Konfirmasi password tidak sesuai',
                });
                return false;

            } else {
                Swal.fire({
                    title: 'Data registrasi yang dikirimkan sudah benar?',
                    showDenyButton: true,
                    confirmButtonText: `Save`,
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Data berhasil terkirim!', 'Menunggu verifikasi oleh admin', 'success')
                        document.getElementById('formDaftar').submit();
                    } else if (result.isDenied) {
                        return false
                    }
                })

            }

        }

        function showPreview() {
            const foto = document.querySelector('#foto-ktp');
            const fotoLabel = document.querySelector('.form-control');
            const imgPreview = document.querySelector('.img-preview');

            fotoLabel.textContent = foto.files[0].name;
            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);
            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        function showPreviewprofil() {
            const foto = document.querySelector('#foto-profil');
            const fotoLabel = document.querySelector('.form-control');
            const imgPreview = document.querySelector('.img-preview-profil');

            fotoLabel.textContent = foto.files[0].name;
            const fileFoto = new FileReader();
            fileFoto.readAsDataURL(foto.files[0]);
            fileFoto.onload = function(e) {
                imgPreview.src = e.target.result;
            }

        }
    </script>


    <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/slick.min.js"></script>



    <script src="<?= base_url() ?>/assets/js/main.js"></script>
    <script src="<?= base_url() ?>/assets/js/sweetalert2.all.min.js"></script>