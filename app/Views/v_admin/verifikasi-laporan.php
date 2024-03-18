<div class="container mt-3">
    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pengirim</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Lampiran foto</th>
                    <th scope="col">Tanggal dikirim</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $num = 1; ?>
                <?php foreach ($laporan as $lapor) { ?>
                    <tr>
                        <th scope="row"><?php echo $num; ?></th>
                        <td><?= $lapor['nama_volunteer'] ?> (@<?= $lapor['username'] ?>)</td>
                        <td><?= $lapor['nama_laporan'] ?></td>
                        <td><?= $lapor['lokasi'] ?></td>
                        <td><button class="btn btn-dark" id="laporimg<?php echo $lapor['id']; ?>" data-toggle="modal" data-target="#myModal<?php echo $lapor['id']; ?>">Buka gambar terlampir </button>

                            <div class="modal fade" id="myModal<?php echo $lapor['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
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
                        </td>
                        <td>
                            <?php
                            $i = $lapor['created_at'];
                            $a = date("d-m-Y", strtotime($i));
                            echo $a;
                            ?>
                        </td>
                        <td>
                            <a type="button" class="btn btn-success" href="verifikasi/1/<?= $lapor['id']; ?>"><i class="fas fa-check-circle"></i></a>
                            <a type="button" class="btn btn-danger" href="verifikasi/2/<?= $lapor['id']; ?>"><i class="fas fa-times"></i></a>


                        </td>
                    </tr>
                <?php $num++;
                } ?>
            </tbody>
        </table>
    </div>


</div>
<script>
</script>