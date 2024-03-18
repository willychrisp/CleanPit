<div class="container mt-3">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Lampiran foto</th>
                    <th scope="col">Tanggal lahir</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($volunteer as $volunteer) { ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><?= $volunteer['nama_volunteer'] ?> </td>
                        <td><?= $volunteer['alamat'] ?> </td>
                        <td><?= $volunteer['hp'] ?> </td>
                        <td><button class="btn btn-dark" id="volunteerktp<?php echo $volunteer['id_volunteer']; ?>" data-toggle="modal" data-target="#myModal<?php echo $volunteer['id_volunteer']; ?>">Buka gambar terlampir </button>

                            <div class="modal fade" id="myModal<?php echo $volunteer['id_volunteer']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Foto lampiran</h5>

                                        </div>
                                        <div class="modal-body">
                                            <img class="modal-content" src="<?= base_url() ?>/img/data_volunteer/foto_ktp/<?= $volunteer['foto_ktp']; ?>">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?= $volunteer['tanggal'] ?> </td>




                        <td>
                            <a type="button" class="btn btn-success" href="verifPengguna/1/<?= $volunteer['id_volunteer']; ?>"><i class="fas fa-check-circle"></i></a>
                            <a type="button" class="btn btn-danger" href="verifPengguna/2/<?= $volunteer['id_pengguna']; ?>"><i class="fas fa-times"></i></a>



                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</div>
<script>
</script>