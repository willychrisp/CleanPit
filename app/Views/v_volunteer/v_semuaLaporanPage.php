<div class="container" style="padding-top: 100px;">

    <p class="login-card-description">Telusuri Pelaporan Lingkungan Kotor</p>
    <h6>Tampilkan laporan yang dikirimkan oleh ...</h6>
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Volunteer</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Petugas</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Umum</a>
        </li>
    </ul>
    <?php if ($role == 1) { ?>
        <a href="/lapor" class="float">
            <i class="fa fa-plus my-float"></i>
        </a>
    <?php } else if ($role == 2) { ?>
        <a href="/laporan-anggota" class="float">
            <i class="fa fa-plus my-float"></i>
        </a>
    <?php } else if ($role == null) { ?>
        <a href="/laporan-user" class="float">
            <i class="fa fa-plus my-float"></i>
        </a>
    <?php } else if ($role == 3) { ?>
        <a href="/laporan-petugas" class="float">
            <i class="fa fa-plus my-float"></i>
        </a>
    <?php } ?>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row gutters-sm">

                <?php foreach ($laporan as $lapor) { ?>
                    <div class="col-lg-12 mb-3">
                        <div class="card h-100">

                            <div class="card-body" id="lapor">
                                <span style="float:right;" class="badge badge-pill badge-success">Sudah verifikasi</span>
                                <?php if ($lapor['tanggal_kegiatan'] == NULL) { ?>
                                    <span style="float:right;" class="badge badge-pill badge-warning">Belum ada kegiatan</span>
                                <?php } else if ($lapor['tanggal_kegiatan'] > date("Y-m-d")) { ?>
                                    <span style="float:right;" class="badge badge-pill badge-success">Kegiatan dijadwalkan</span>
                                <?php } else { ?>
                                    <span style="float:right;" class="badge badge-pill badge-danger">Kegiatan sudah dilaksanakan</span>
                                <?php } ?>
                                <div class="inline-block">
                                    <img src="<?= base_url() ?>/img/data_volunteer/<?= $lapor['fotow']; ?>" alt="Admin" class="rounded-circle pull-left" width="100">
                                    <p class="d-flex" style="font-size: 25px; "><?= $lapor['nama_volunteer']; ?> </p>
                                    <p class="d-flex" style="font-size: 15px; ">@<?= $lapor['username']; ?> </p>

                                </div>
                                <hr>
                                <small>Judul Laporan</small>
                                <div>
                                    <a class="d-flex"><?= $lapor['nama_laporan']; ?></a>
                                </div>
                                <hr>
                                <small>Foto terlampir</small>
                                <div>

                                    <img id="laporimg<?php echo $lapor['id']; ?>" style="object-fit:cover" max-width="680" width="100%" height="350" src="<?= base_url() ?>/img/<?= $lapor['foto']; ?>" data-toggle="modal" data-target="#myModal<?php echo $lapor['id']; ?>">

                                    <div class="modal fade" height="500" id="myModal<?php echo $lapor['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="col-lg-12 modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Foto lampiran</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <img class="modal-content" src="<?= base_url() ?>/img/<?= $lapor['foto']; ?>">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <hr>
                                <small>Tanggal laporan</small>
                                <div>
                                    <a class="d-flex"><?php
                                                        $i = $lapor['tanggal'];
                                                        $a = date("d-m-Y", strtotime($i));
                                                        echo $a;
                                                        ?></a>
                                </div>
                                <hr>
                                <small>Lokasi laporan</small>
                                <div>
                                    <p class="d-flex"><?= $lapor['lokasi']; ?></p>
                                </div>
                                <hr>
                                <small>Jumlah volunteer yang dibutuhkan</small>
                                <div>
                                    <a class="d-flex"><?= $lapor['jumlah']; ?></a>
                                </div>
                                <hr>
                                <?php if ($role == 1) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="partisipan/<?= $lapor['id'] ?>">Buka Detail Laporan</a>
                                <?php } else if ($role == 2 || null) { ?>

                                <?php } else if ($role == 3) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="partisipan-petugas/<?= $lapor['id'] ?>">Buka Detail Laporan</a>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row gutters-sm">

                <?php foreach ($laporanPetugas as $lapor) { ?>
                    <div class="col-lg-12 mb-3">
                        <div class="card h-100">

                            <div class="card-body" id="lapor">
                                <span style="float:right;" class="badge badge-pill badge-success">Sudah verifikasi</span>
                                <?php if ($lapor['tanggal_kegiatan'] == NULL) { ?>
                                    <span style="float:right;" class="badge badge-pill badge-warning">Belum ada kegiatan</span>
                                <?php } else if ($lapor['tanggal_kegiatan'] > date("Y-m-d")) { ?>
                                    <span style="float:right;" class="badge badge-pill badge-success">Kegiatan dijadwalkan</span>
                                <?php } else { ?>
                                    <span style="float:right;" class="badge badge-pill badge-danger">Kegiatan sudah dilaksanakan</span>
                                <?php } ?>
                                <div class="inline-block">
                                    <img src="<?= base_url() ?>/img/data_volunteer/user.png" alt="Admin" class="rounded-circle pull-left" width="100">
                                    <p class="d-flex" style="font-size: 25px; "><?= $lapor['identitas_pengirim']; ?> </p>
                                    <p class="d-flex" style="font-size: 15px; ">@<?= $lapor['nomor']; ?> </p>

                                </div>
                                <hr>
                                <small>Judul Laporan</small>
                                <div>
                                    <a class="d-flex"><?= $lapor['nama_laporan']; ?></a>
                                </div>
                                <hr>
                                <small>Foto terlampir</small>
                                <div>

                                    <img id="laporimg<?php echo $lapor['id']; ?>" style="object-fit:cover" max-width="680" width="100%" height="350" src="<?= base_url() ?>/img/<?= $lapor['foto']; ?>" data-toggle="modal" data-target="#myModal<?php echo $lapor['id']; ?>">

                                    <div class="modal fade" height="500" id="myModal<?php echo $lapor['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="col-lg-12 modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Foto lampiran</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <img class="modal-content" src="<?= base_url() ?>/img/<?= $lapor['foto']; ?>">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <hr>
                                <small>Tanggal laporan</small>
                                <div>
                                    <a class="d-flex"><?php
                                                        $i = $lapor['tanggal'];
                                                        $a = date("d-m-Y", strtotime($i));
                                                        echo $a;
                                                        ?></a>
                                </div>
                                <hr>
                                <small>Lokasi laporan</small>
                                <div>
                                    <p class="d-flex"><?= $lapor['lokasi']; ?></p>
                                </div>
                                <hr>
                                <small>Jumlah volunteer yang dibutuhkan</small>
                                <div>
                                    <a class="d-flex"><?= $lapor['jumlah']; ?></a>
                                </div>
                                <hr>
                                <?php if ($role == 1) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="partisipan/<?= $lapor['id'] ?>">Buka Detail Laporan</a>
                                <?php } else if ($role == 2 || null) { ?>

                                <?php } else if ($role == 3) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="partisipan-petugas/<?= $lapor['id'] ?>">Buka Detail Laporan</a>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>



        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row gutters-sm">

                <?php foreach ($laporanUmum as $lapor) { ?>
                    <div class="col-lg-12 mb-3">
                        <div class="card h-100">

                            <div class="card-body" id="lapor">
                                <span style="float:right;" class="badge badge-pill badge-success">Sudah verifikasi</span>
                                <?php if ($lapor['tanggal_kegiatan'] == NULL) { ?>
                                    <span style="float:right;" class="badge badge-pill badge-warning">Belum ada kegiatan</span>
                                <?php } else if ($lapor['tanggal_kegiatan'] > date("Y-m-d")) { ?>
                                    <span style="float:right;" class="badge badge-pill badge-success">Kegiatan dijadwalkan</span>
                                <?php } else { ?>
                                    <span style="float:right;" class="badge badge-pill badge-danger">Kegiatan sudah dilaksanakan</span>
                                <?php } ?>
                                <div class="inline-block">
                                    <img src="<?= base_url() ?>/img/data_volunteer/user.png" alt="Admin" class="rounded-circle pull-left" width="100">
                                    <p class="d-flex" style="font-size: 25px; "><?= $lapor['identitas_pengirim']; ?> </p>
                                    <p class="d-flex" style="font-size: 15px; ">@<?= $lapor['nomor']; ?> </p>

                                </div>
                                <hr>
                                <small>Judul Laporan</small>
                                <div>
                                    <a class="d-flex"><?= $lapor['nama_laporan']; ?></a>
                                </div>
                                <hr>
                                <small>Foto terlampir</small>
                                <div>

                                    <img id="laporimg<?php echo $lapor['id']; ?>" style="object-fit:cover" max-width="680" width="100%" height="350" src="<?= base_url() ?>/img/<?= $lapor['foto']; ?>" data-toggle="modal" data-target="#myModal<?php echo $lapor['id']; ?>">

                                    <div class="modal fade" height="500" id="myModal<?php echo $lapor['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="col-lg-12 modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Foto lampiran</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <img class="modal-content" src="<?= base_url() ?>/img/<?= $lapor['foto']; ?>">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <hr>
                                <small>Tanggal laporan</small>
                                <div>
                                    <a class="d-flex"><?php
                                                        $i = $lapor['tanggal'];
                                                        $a = date("d-m-Y", strtotime($i));
                                                        echo $a;
                                                        ?></a>
                                </div>
                                <hr>
                                <small>Lokasi laporan</small>
                                <div>
                                    <p class="d-flex"><?= $lapor['lokasi']; ?></p>
                                </div>
                                <hr>
                                <small>Jumlah volunteer yang dibutuhkan</small>
                                <div>
                                    <a class="d-flex"><?= $lapor['jumlah']; ?></a>
                                </div>
                                <hr>
                                <?php if ($role == 1) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="partisipan/<?= $lapor['id'] ?>">Buka Detail Laporan</a>

                                <?php } else if ($role == 2 || null) { ?>

                                <?php } else if ($role == 3) { ?>
                                    <a type="submit" class="btn btn-outline-primary" href="partisipan-petugas/<?= $lapor['id'] ?>">Buka Detail Laporan</a>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>

</div>
</div>
</div>
<script>
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
</script>