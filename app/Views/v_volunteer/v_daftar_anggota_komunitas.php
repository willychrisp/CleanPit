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
                            <?php if ($komunitas['pendiri'] == session()->get('id')) { ?>
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
                            </svg>Jumlah Anggota</h6>
                        <span class="text-secondary"><?= count($anggota) ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">

            <div class="card mb-3">

                <div class="card-body">
                    <p class="login-card-description">Anggota</p>
                    <?php if (!empty($anggota)) { ?>
                        <div class="row">

                            <?php $i = 1;
                            foreach ($anggota as $anggota) {  ?>
                                <div class="col-md-4">

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-left text-left">
                                                <div class="inline-block">
                                                    <p class="d-flex" style="font-size: 12px; float: right;"><?= $i ?></p>
                                                    <img src="<?= base_url() ?>/img/data_volunteer/<?= $anggota['foto']; ?>" alt="Admin" class="rounded-circle pull-left" width="50">
                                                    <p class="d-flex" style="font-size: 20px;"><?= $anggota['nama_volunteer'] ?></p>


                                                </div>

                                                <div class="mt-3">

                                                    <p class="mb-0">Nama Volunteer</p>
                                                    <p class="text-secondary mb-1"><?= $anggota['nama_volunteer'] ?></p>
                                                    <hr>
                                                    <p class="mb-0">Alamat</p>
                                                    <p class="text-muted font-size-sm"><?= $anggota['alamat'] ?></p>
                                                    <hr>
                                                    <p class="mb-0">Kontak</p>
                                                    <p class="text-muted font-size-sm"><?= $anggota['hp'] ?></p>


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

            </div>
        </div>
    </div>
</div>


<script>
    // Get the <span> element that closes the modal


    // When the user clicks on <span> (x), close the modal
</script>