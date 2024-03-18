<div class="container" style="padding-top: 10px;">

  <div class="row gutters-sm">
    <div class="col-md-4 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center text-center">

            <img src="<?= base_url() ?>/img/data_anggota/foto_profil/<?= $anggota['foto_profil_anggota']; ?>" alt="Admin" class="rounded-circle" width="150">
            <div class="mt-3">
              <h4><?= $anggota['nama_anggota'] ?></h4>
              <p class="text-secondary mb-1">@<?= session()->get('username') ?></p>


              <p class="text-muted font-size-sm"></p>
              <a href="/anggota-ubah-password" class="btn btn-outline-primary">Perbarui password</a>


              <p class="text-muted font-size-sm"></p>


            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-8">
      <div class="card mb-3">

        <div class="card-body">
          <p class="login-card-description">Data diri anggota</p>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Full Name</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?= $anggota['nama_anggota'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Tanggal lahir</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?= $anggota['tanggal_bergabung'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Phone</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?= $anggota['kontak_anggota'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Alamat</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?= $anggota['alamat_anggota'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h6 class="mb-0">Keterangan</h6>
            </div>
            <div class="col-sm-9 text-secondary">
              <?= $anggota['bio_anggota'] ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  // Get the <span> element that closes the modal


  // When the user clicks on <span> (x), close the modal
</script>