<div class="container" style="padding-top: 140px;">

    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <?php if ($komunitas['status'] == 1) { ?>
                        <?php echo '<span class="badge badge-success">Sudah verifikasi</span>';
                        } ?>

                        <?php if ($komunitas['status'] != 1) { ?>
                        <?php echo '<span class="badge badge-danger">Belum verifikasi</span>';
                        } ?>


                        <img src="<?= base_url() ?>/img/data_komunitas/foto_profil/<?= $komunitas['foto_profil_komunitas']; ?>" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?= $komunitas['nama_komunitas'] ?></h4>
                            <?php if ($pendiri == session()->get('id')) { ?>
                                <p class="text-secondary mb-1">Anda adalah pendiri komunitas ini</p>
                                <button class="btn btn-outline-primary">Ubah detail komunitas</button>
                            <?php } else { ?>
                                <p class="text-secondary mb-1">Didirikan oleh <?= $komunitas['nama_volunteer'] ?></p>
                                <a type="submit" class="btn btn-outline-primary" href="/profilPendiri/<?= $komunitas['pendiri'] ?>"> Buka profil <?= $komunitas['nama_volunteer'] ?> </a>

                                <hr>
                                <?php if ($komunitas['id_komunitas'] != $keanggotaan['id_komunitas']) { ?>
                                    <?php if (empty($keanggotaan['id_komunitas'])) { ?>
                                        <a class="btn btn-primary" href="/gabung-komunitas/<?= $komunitas['id_komunitas'] ?>" style="color: cornsilk;">Daftar sebagai anggota</a>
                                    <?php } else { ?>
                                        <p style="color: green; font-size: 14px;">Anda sudah tergabung dengan komunitas lain</p>
                                    <?php } ?>
                                <?php } else { ?>

                                    <p style="color: green; font-size: 14px;">Anda sudah tergabung dengan komunitas ini</p>

                            <?php }
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                            </svg>Jumlah anggota</h6>
                        <span class="text-secondary"><?= $anggota ?></span>
                    </li>

                </ul>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card mb-3">

                <div class="card-body">
                    <p class="login-card-description">Detail Komunitas</p>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $komunitas['nama_komunitas'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Tanggal lahir</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                            $i = $komunitas['tanggal_berdiri'];
                            $a = date("d-m-Y", strtotime($i));
                            echo $a;

                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nomor kontak</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $komunitas['nomor_kontak'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Keterangan komunitas</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $komunitas['bio_komunitas'] ?>
                        </div>
                    </div>
                    <hr>

                </div>
            </div>
            <p class="login-card-description" href="/lapor"><a href="/listAnggota/<?= $komunitas['id_komunitas'] ?>"><span style="color: black;">Daftar anggota</span></a></p>

            <div class="row gutters-sm">

            </div>
        </div>
    </div>
</div>


<script>
    // Get the <span> element that closes the modal


    // When the user clicks on <span> (x), close the modal
</script>