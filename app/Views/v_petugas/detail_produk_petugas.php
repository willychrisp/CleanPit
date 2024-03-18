<div class="container" style="padding-top: 10px;">

    <div class="row gutters-sm">

        <div class="col-lg-12 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h2><?= $produk['nama_produk'] ?> </h2>
                </div>
                <div class="card-body" id="lapor">

                    <small>Foto terlampir</small>
                    <div>

                        <img id="produkimg<?php echo $produk['id_produk']; ?>" style="object-fit:cover" max-width="680" width="100%" height="200" src="<?= base_url() ?>/img/data_produk/foto_produk/<?= $produk['foto_produk']; ?>" data-toggle="modal" data-target="#myModal<?php echo $produk['id_produk']; ?>">

                        <div class="modal fade" height="500" id="myModal<?php echo $produk['id_produk']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="col-lg-12 modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Foto lampiran</h5>

                                    </div>
                                    <div class="modal-body">
                                        <img class="modal-content" src="<?= base_url() ?>/img/data_produk/foto_produk/<?= $produk['foto_produk']; ?>">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <small>Nama produk</small>
                    <div>
                        <?= $produk['nama_produk'] ?>
                    </div>
                    <hr>
                    <small>Detail produk</small>
                    <div>
                        <h class="d-flex"><?= $produk['detail_produk']; ?></h>
                    </div>
                    <hr>
                    <small>Bahan produk</small>
                    <div>
                        <h class="d-flex"><?= $produk['bahan_produk']; ?></h>
                    </div>


                    <hr>
                    <small>Kontak Pemilik</small>
                    <div>
                        <h class="d-flex"><?= $produk['kontak_pemilik']; ?></h>
                    </div>


                    <hr>


                </div>
            </div>
        </div>

    </div>


</div>

</div>
</div>
<br>