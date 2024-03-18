<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            <h6>Anggota Aktif <span class="badge badge-success"><?= $aktif ?></span></h6>
        </div>
        <div class="card-body  pl-4">
            <div>
                <div>
                    <div class="row">
                        <div class="col-sm-5">
                            <p class="login-card-description">Daftar anggota Bank Sampah</p>
                        </div>
                        <div class="col-sm-4 mt-3 ml-auto">
                            <a type="button" class="btn btn-primary" href="tambah-anggota">Tambah Data Anggota</a>
                        </div>

                    </div>

                    <h6 style="font-size: 14px; font-style: italic;" class="text-secondary">*Tekan kolom keterangan untuk menambahkan keterangan tambahan pada anggota</h6>
                    <h6 style="font-size: 14px; font-style: italic;" class="text-secondary">*Tekan badge status untuk mengubah status (aktif atau tidak aktif)</h6>
                    <div class="panel panel-default table-responsive">

                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Tanggal Bergabung</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Status</th>
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
                                        <td scope="col"><?= date("d-m-Y", strtotime($list['tanggal_bergabung'])) ?> </td>
                                        <td class="ket" data-row_id=<?= $list['id_anggota'] ?> scope="col" contenteditable><?= $list['bio_anggota'] ?></td>
                                        <td scope="col">
                                            <?php if ($list['status'] == 0) {
                                                echo "<a href='ProsesBankController/ubahStatus/" . $list['id_anggota'] . "/0' class='badge badge-success'>Aktif</a>";
                                            } else {
                                                echo "<a href='ProsesBankController/ubahStatus/" . $list['id_anggota'] . "/-1' class='badge badge-danger'>Tida aktif</a>";
                                            }


                                            ?>

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
    $(document).on('blur', '.ket', function() {
        var id = $(this).data('row_id');
        var value = $(this).text();
        console.log(id);
        console.log(value);

        $.ajax({
            url: "<?php echo base_url(); ?>/ProsesBankController/tambahKeterangan",
            method: "POST",
            data: {
                id: id,
                value: value
            },
            success: function(data) {
                Swal.fire('Data berhasil diperbarui!', '', 'success')
                load_data();
            }
        })
    });
</script>