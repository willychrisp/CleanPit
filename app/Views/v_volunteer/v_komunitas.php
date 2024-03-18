<div class="container" style="padding-top: 130px;">

    <p class="login-card-description">Telusuri Komunitas Yang Tersedia</p>
    <div class="row gutters-sm">

        <?php foreach ($komunitas as $komunitas) { ?>
            <div class="col-lg-12 mb-3">
                <div class="card h-100">
                    <div class="card-body" id="lapor">
                        <span style="float:right;" class="badge badge-pill badge-success">Sudah verifikasi</span>

                        <small>Nama Komunitas</small>
                        <div>
                            <a class="d-flex"><?= $komunitas['nama_komunitas']; ?></a>
                        </div>
                        <hr>
                        <small>Foto terlampir</small>
                        <div>

                            <img id="laporimg<?php echo $komunitas['id_komunitas']; ?>" style="object-fit:cover" max-width="680" width="100%" height="350" src="assets/images/bg_com.jpg" data-bs-toggle="modal" data-bs-target="#myModal<?php echo $komunitas['id_komunitas']; ?>">

                            <div class="modal fade" height="500" id="myModal<?php echo $komunitas['id_komunitas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="col-lg-12 modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Foto lampiran</h5>

                                        </div>
                                        <div class="modal-body">
                                            <img class="modal-content" src="assets/images/bg_com.jpg">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <hr>
                        <small>Tanggal berdiri</small>
                        <div>
                            <a class="d-flex"><?= $komunitas['tanggal_berdiri']; ?></a>
                        </div>
                        <hr>
                        <small>Nomor kontak</small>
                        <div>
                            <a class="d-flex"><?= $komunitas['nomor_kontak']; ?></a>
                        </div>
                        <hr>
                        <small>Bio komunitas</small>
                        <div>
                            <a class="d-flex"><?= $komunitas['bio_komunitas']; ?></a>
                        </div>

                        <hr>
                        <div>
                            <a type="submit" style="float: right;" class="btn btn-outline-primary" href="detail-komunitas/<?= $komunitas['id_komunitas'] ?>">Buka detail komunitas</a>
                        </div>


                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
</div>
</div>
<script>

</script>