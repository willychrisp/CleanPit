<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            <?php if ($role == 3) { ?>
                <a href="/manage-sampah" class="btn btn-info">Perbarui Data Sampah</a>
            <?php } else {
            } ?>
        </div>
        <div class="card-body  pl-4">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Sampah</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Harga Ditabung</th>

                        <th scope="col">Harga Langsung</th>
                        <th scope="col">Jenis Sampah</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($sampah as $sampah) { ?>
                        <tr>
                            <th scope="row"><?= $i ?></th>
                            <td><?= $sampah['nama_sampah'] ?></td>
                            <td><?= $sampah['kode'] ?></td>
                            <td><?= $sampah['harga_sampah'] ?></td>
                            <td><?= $sampah['harga_langsung'] ?></td>
                            <td><?= $sampah['jenis'] ?></td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        2 days ago
    </div>
</div>