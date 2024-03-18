<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body  pl-4">
            <div>
                <div>
                    <div class="row">
                        <div class="col-sm-5">
                            <p class="login-card-description">Daftar anggota Bank Sampah</p>
                        </div>
                        <div class="col-sm-4 mt-3 ml-auto">
                            <button type="button" class="btn btn-primary">Rekap</button>
                        </div>


                    </div>


                    <div class="panel panel-default table-responsive">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Bergabung</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="target">
                                <?php $i = 1;
                                foreach ($anggota as $list) { ?>
                                    <tr>
                                        <td scope="col"><?= $i ?></td>
                                        <td scope="col"><?= $list['nama_anggota'] ?></td>
                                        <td scope="col"><?= $list['alamat_anggota'] ?></td>
                                        <td scope="col"><?= date("d-m-Y", strtotime($list['bio_anggota'])) ?> </td>
                                        <td scope="col"><?= $list['bio_anggota'] ?></td>
                                        <td scope="col">
                                            <a type="button" class="btn btn-primary" href="/buku-tabungan/<?= $list['id_anggota'] ?>">Buka buku tabungan</a>
                                        </td>
                                        <td scope=" col">
                                        </td>
                                    </tr>

                                <?php $i++;
                                }  ?>
                            </tbody>
                        </table>


                    </div>

                    <hr>

                    <br />

                    <br>
                    <div>
                        <hr>

                    </div>

                    <br>
                    <hr>
                    <br />




                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>

</div>

<script>


</script>