<div class="container" style="padding-top: 130px;">

    <div class="row gutters-sm">

        <div class="col-md-8">
            <p class="login-card-description">Detail Pelaporan Lingkungan Kotor</p>
            <div class="row gutters-sm">


                <div class="col-lg-12 mb-3">
                    <div class="card h-100">

                        <div class="card-body" id="lapor">
                            <span style="float:right;" class="badge badge-pill badge-success">Sudah verifikasi</span>
                            <a class="d-flex" style="font-size: 25px; "> </a>
                            <hr>
                            <large>Judul Laporan</large>
                            <div>
                                <a style="font-size: 13px;" class="d-flex"><?= $laporan['nama_laporan']; ?></a>
                            </div>
                            <hr>
                            <large>Isi Laporan</large>
                            <div>
                                <a style="font-size: 13px;" class="d-flex"><?= $laporan['isi_laporan']; ?></a>
                            </div>
                            <hr>
                            <small>Foto Terlampir</small>
                            <div>

                                <img id="laporimg<?php echo $laporan['id']; ?>" style="object-fit:cover" max-width="680" width="100%" height="200" src="<?= base_url() ?>/img/<?= $laporan['foto']; ?>" data-toggle="modal" data-target="#myModal<?php echo $laporan['id']; ?>">

                                <div class="modal fade" height="500" id="myModal<?php echo $laporan['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="col-lg-12 modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Foto Lampiran</h5>

                                            </div>
                                            <div class="modal-body">
                                                <img class="modal-content" src="<?= base_url() ?>/img/<?= $laporan['foto']; ?>">

                                            </div>
                                            <small>Foto diambil pada tanggal</small>
                                            <div>
                                                <h class="d-flex">
                                                    <?php
                                                    $i = $laporan['tanggal'];
                                                    $a = date("d-m-Y", strtotime($i));
                                                    echo $a;
                                                    ?>
                                                </h>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <small>Tanggal Laporan</small>
                            <div>
                                <a class="d-flex">
                                    <?php
                                    $i = $laporan['created_at'];
                                    $a = date("d-m-Y", strtotime($i));
                                    echo $a;
                                    ?>
                                </a>
                            </div>
                            <hr>
                            <small>Lokasi Laporan</small>
                            <div>
                                <a class="d-flex"><?= $laporan['lokasi']; ?></a>
                            </div>
                            <hr>
                            <small>Wilayah Laporan</small>
                            <div>
                                <a class="d-flex"><?= $laporan['wilayah']; ?></a>
                            </div>
                            <hr>
                            <small>Objek Sekitar</small>
                            <div>
                                <a class="d-flex"><?= $laporan['objek']; ?></a>
                            </div>
                            <hr>

                            <?php if ($role == 1) {
                                if ($laporan['tanggal_kegiatan'] == NULL) { ?>
                                    <span class="badge badge-pill badge-warning">Belum diadakan kegiatan oleh Petugas</span>
                                <?php } else if ($laporan['tanggal_kegiatan'] > date("Y-m-d")) { ?>

                                    <span class="badge badge-pill badge-success">Diadakan kegiatan oleh Petugas</span>
                                <?php } else { ?>
                                    <span class="badge badge-pill badge-danger">Kegiatan telah dilaksanakan</span>
                                <?php } ?>
                                <hr>
                                <small>Tanggal kegiatan akan dilaksanakan pada</small>
                                <div>
                                    <a class="d-flex"><?= $laporan['tanggal_kegiatan']; ?></a>
                                </div>
                                <hr>
                                <small>Lokasi kegiatan</small>
                                <div>
                                    <a class="d-flex"><?= $laporan['lokasi_pertemuan']; ?></a>
                                </div>
                                <hr>
                                <?php if ($laporan['tanggal_kegiatan'] < date("Y-m-d")) { ?>

                                <?php } else { ?>
                                    <button type="submit" onclick="confirmation(<?= $laporan['id'] ?>)" class=" btn btn-outline-primary" href="">Daftar sebagai partisipan</button>
                                    <hr>
                                <?php } ?>


                                <?php } else if ($role == 3) {

                                if ($laporan['tanggal_kegiatan'] == NULL) { ?>
                                    <span class="badge badge-pill badge-warning">Belum diadakan kegiatan oleh Petugas</span>
                                    <button type="submit" style="float: right;" id="kegiatan" class=" btn btn-outline-primary" href="">Adakan Kegiatan</button>
                                <?php } else if ($laporan['tanggal_kegiatan'] > date("Y-m-d")) { ?>
                                    <span class="badge badge-pill badge-success">Diadakan kegiatan oleh Petugas</span>

                                <?php } else { ?>
                                    <span class="badge badge-pill badge-danger">Kegiatan telah dilaksanakan</span>
                                    <?php if ($laporan['laporan_kegiatan'] == NULL) { ?>
                                        <button type="submit" style="float: right;" id="laporan" class=" btn btn-outline-primary" href="">Buat Laporan Kegiatan</button>
                                    <?php } ?>


                                <?php } ?>
                                <hr>
                                <small>Tanggal kegiatan akan dilaksanakan pada</small>
                                <div>
                                    <a class="d-flex"><?= $laporan['tanggal_kegiatan']; ?></a>
                                </div>
                                <hr>
                                <small>Lokasi kegiatan</small>
                                <div>
                                    <a class="d-flex"><?= $laporan['lokasi_pertemuan']; ?></a>
                                </div>
                                <hr>

                                <!--- Form untuk mengisi kegiatan    -->
                                <div class="container" id="form-kegiatan">
                                    <form action="/LaporanController/kirimKegiatan/<?= $laporan['id'] ?>" id="formKegiatan" method="POST" enctype="multipart/form-data" onsubmit="validateForm(event)">
                                        <br>
                                        <hr>
                                        <h6>Form Pelaksanaan Kegiatan</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <small>Tanggal Kegiatan</small>
                                            </div>
                                            <div class="col-sm-9 text-secondary">

                                                <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Kegiatan" name="tanggal">
                                            </div>
                                            <hr>
                                        </div>
                                        <hr>
                                        <div class="row">

                                            <div class="col-sm-3">
                                                <small>Lokasi Kegiatan</small>
                                            </div>
                                            <div class="col-sm-6 text-secondary">

                                                <input type="text" class="form-control" id="lokasi" placeholder="Lokasi Kegiatan" name="lokasi">
                                            </div>
                                            <div class="col-sm-3 text-secondary">
                                                <input type="submit" class="btn btn-info mb-3" value="Kirim">
                                            </div>
                                            <hr>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                                <!--- Batas form untuk mengisi kegiatan    -->

                                <!--- Form untuk mengisi laporan kegiatan   -->
                                <div class="container" id="form-laporan">
                                    <form action="/LaporanController/kirimLaporanKegiatan/<?= $laporan['id'] ?>" id="formKegiatanKegiatan" method="POST" enctype="multipart/form-data" onsubmit="validateForm2(event)">
                                        <br>
                                        <hr>
                                        <h6>Form Laporan Kegiatan</h6>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <small>Isi Laporan</small>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" id="isi" placeholder="Isi laporan" name="isi">
                                            </div>
                                            <hr>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <small>Perkiraan jumlah peserta</small>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" id="peserta" placeholder="Jumlah peserta" name="peserta">
                                            </div>
                                            <hr>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3 text-secondary">
                                                <input type="submit" class="btn btn-info mb-3" value="Kirim">
                                            </div>
                                            <hr>
                                        </div>
                                        <hr>
                                    </form>
                                </div>
                                <!--- Batas form untuk mengisi laporan kegiatan    -->
                            <?php } ?>

                            <?php if ($laporan['laporan_kegiatan'] != NULL) { ?>
                                <div class="card">
                                    <div class="card-header">
                                        Laporan Kegiatan
                                    </div>
                                    <div class="card-body">
                                        <small>Isi laporan kegiatan</small>
                                        <div>
                                            <h6><?= $laporan['laporan_kegiatan']; ?></h6>
                                        </div>
                                        <hr>
                                        <small>Perkiraan jumlah peserta</small>
                                        <div>
                                            <a class="d-flex"><?= $laporan['jumlah_peserta']; ?></a>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="card">
                                    <div class="card-header">
                                        Laporan Kegiatan
                                    </div>
                                    <div class="card-body">
                                        <small>Belum ada laporan dari petugas</small>


                                        <hr>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

            </div>

            <?php if (!empty($partisipan)) { ?>
                <p class="login-card-description">Partisipan</p>
                <div class="row">

                    <?php $i = 1;
                    foreach ($partisipan as $part) {  ?>
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-left text-left">
                                        <div class="inline-block">
                                            <p class="d-flex" style="font-size: 12px; float: right;"><?= $i ?></p>
                                            <img src="<?= base_url() ?>/img/data_volunteer/<?= $part['foto']; ?>" alt="Admin" class="rounded-circle pull-left" width="50">
                                            <p class="d-flex" style="font-size: 20px;"><?= $part['nama_volunteer'] ?></p>


                                        </div>

                                        <div class="mt-3">

                                            <p class="mb-0">Nama Volunteer</p>
                                            <p class="text-secondary mb-1"><?= $part['nama_volunteer'] ?></p>
                                            <hr>
                                            <p class="mb-0">Alamat</p>
                                            <p class="text-muted font-size-sm"><?= $part['alamat'] ?></p>
                                            <hr>
                                            <p class="mb-0">Kontak</p>
                                            <p class="text-muted font-size-sm"><?= $part['hp'] ?></p>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php $i++;
                    }; ?>

                </div>
            <?php } else { ?>
                <p class="login-card-description">Tidak ada partisipan</p>
            <?php } ?>
        </div>
        <div class="col-md-4 mb-3">
            <p class="login-card-description">Pengirim</p>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <div class="mt-3">
                            <?php if ($laporan['jenis'] == "1") { ?>
                                <img src="<?= base_url() ?>/img/data_volunteer/<?= $pemilik['foto']; ?>" alt="Admin" class="rounded-circle" width="150">

                                <h4><?= $pemilik['nama_volunteer'] ?> </h4>

                                <p class="text-secondary mb-1"><?= $pemilik['alamat'] ?> </p>

                                <p class="text-muted font-size-sm"><?= $pemilik['hp'] ?> </p>

                                <?php if ($role == 1) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="/profilPendiri/<?= $pemilik['id_volunteer'] ?>"> Buka profil <?= $pemilik['nama_volunteer'] ?> </a>
                                <?php } ?>
                            <?php } else if ($laporan['jenis'] == "3" || $laporan['jenis'] == "2") { ?>
                                <img src="<?= base_url() ?>/img/data_volunteer/user.png" alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">
                                    <h4><?= $laporan['identitas_pengirim'] ?> </h4>
                                    <p class="text-secondary mb-1"><?= $laporan['nomor'] ?> </p>
                                    <p class="text-muted font-size-sm"><?= $laporan['nomor'] ?> </p>
                                <?php } ?>

                                </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <br>
    <script>
        $("#form-kegiatan").hide();
        $(document).ready(function() {
            $("#kegiatan").click(function() {
                $("#form-kegiatan").slideToggle();
            });
        });

        $("#form-laporan").hide();
        $(document).ready(function() {
            $("#laporan").click(function() {
                $("#form-laporan").slideToggle();
            });
        });

        function confirmation(id) {

            Swal.fire({
                title: 'Apakah anda yakin mendaftaran diri sebagai partisipan?',
                showDenyButton: true,
                confirmButtonText: `Iya`,
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Data berhasil terkirim!', 'Menunggu verifikasi oleh admin', 'success')
                    setTimeout(function() {
                        //nama method / id_pengguna / id_laporan
                        window.location.href = "/partisipasi/" + id + "/<?= session()->get('id') ?>/";
                    }, 2000);
                } else if (result.isDenied) {
                    return false
                }
            })
        }

        function validateForm(e) {
            e.preventDefault();
            var tanggal = document.getElementById("tanggal").value;
            var lokasi = document.getElementById("lokasi").value;
            if (tanggal == "" || lokasi == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Tidak boleh ada field yang kosong',
                });

                return false;
            } else {
                Swal.fire({
                    title: 'Kegiatan yang dikirimkan sudah benar?',
                    showDenyButton: true,
                    confirmButtonText: `Save`,
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Kegiatan terjadwal!', '', 'success')
                        document.getElementById('formKegiatan').submit();
                    } else if (result.isDenied) {
                        return false
                    }
                })

            }

        }
    </script>