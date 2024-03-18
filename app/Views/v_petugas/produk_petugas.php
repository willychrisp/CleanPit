<div class="container" style="padding-top: 30px; padding-left: 30px;">
    <div class="row">

        <div class="col-sm-5">
            <p class="login-card-description">Produk dari anggota Bank Sampah</p>
        </div>
        <?php if ($role == 3) { ?>
            <div class="col-sm-4 mt-3 ml-auto">
                <a href="kirim-produk" class="btn btn-primary">Tambahkan Produk</a>
            </div>
        <?php } else {
        } ?>

    </div>
    <div class="row gutters-sm">
        <<?php foreach ($barang as $produk) { ?> <div class="col-lg-4 mb-3">
            <div class="card" style="width: 18rem; margin-bottom: 15px;">
                <img style="object-fit:cover" max-width="680" width="100%" height="100" src="<?= base_url() ?>/img/data_produk/foto_produk/<?= $produk['foto_produk']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $produk['nama_produk'] ?></h5>
                    <p class="card-text"><?= $produk['detail_produk'] ?></p>
                    <a href="/detail-produk/<?= $produk['id_produk'] ?>" class="btn btn-primary">Buka Detail</a>
                </div>
            </div>
    </div>
<?php } ?>

</div>
<hr>
</div>