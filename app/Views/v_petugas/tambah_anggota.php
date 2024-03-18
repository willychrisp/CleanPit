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

                    <div class="col-md-10">
                        <div class="card-body">

                            <p class="login-card-description">Tambahkan Data Anggota Baru</p>
                            <form action="/ProsesBankController/kirimDataAnggota" id="formDaftar" method="POST" enctype="multipart/form-data" style="padding-left: 50px;" onsubmit="validateForm(event)">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="nama">Nama lengkap</label>
                                    <h6 style="font-size: 14px; font-style: italic;" class="text-secondary">*Wajib diisi</h6>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Tulis nama lengkap" autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal">Tanggal bergabung</label>
                                    <h6 style="font-size: 14px; font-style: italic;" class="text-secondary">*Wajib diisi</h6>
                                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal lahir" name="tanggal">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat sesuai KTP</label>
                                    <h6 style="font-size: 14px; font-style: italic;" class="text-secondary">*Wajib diisi</h6>
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Tulis alamat sesuai dengan KTP">
                                </div>
                                <div class="form-group">
                                    <label for="hp">Kontak</label>
                                    <h6 style="font-size: 14px; font-style: italic;" class="text-secondary">*Wajib diisi dengan nomor whatsapp untuk mengirimkan username dan password</h6>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <input readonly type="tex" class="form-control" value="+62">
                                        </div>
                                        <div class="col-sm-10 text-secondary">
                                            <input type="text" class="form-control" id="hp" name="hp" placeholder="Masukkan nomor HP...">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input class="btn btn-block login-btn mb-4" type="submit">
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <script type="text/javascript">
        function validateForm(e) {
            e.preventDefault();

            var nama = document.getElementById("nama").value;
            var tanggal = document.getElementById("tanggal").value;
            var alamat = document.getElementById("alamat").value;
            var hp = document.getElementById("hp").value;
            if (nama == "" || tanggal == "" || alamat == "") {
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
            } else if (alamat.length < 5) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'alamat laporan setidaknya berisi 10 karakter',
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
                        Swal.fire('Data berhasil terkirim!', 'success')
                        document.getElementById('formDaftar').submit();
                    } else if (result.isDenied) {
                        return false
                    }
                })

            }

        }
    </script>


    <script src="<?= base_url() ?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/slick.min.js"></script>



    <script src="<?= base_url() ?>/assets/js/main.js"></script>
    <script src="<?= base_url() ?>/assets/js/sweetalert2.all.min.js"></script>