<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body  pl-4">
            <div>
                <div>
                    <p class="login-card-description">Data pemilik tabungan</p>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nama anggota</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $anggota['nama_anggota'] ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nomor anggota</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $anggota['username'] ?>
                        </div>

                    </div>


                    <br>
                    <div>
                        <hr>
                        <form method="post" id="tabungan_form">
                            <p class="login-card-description">Masukkan data tabungan</p>
                            <p id="pesan"></p>
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Cari jenis atau nama sampah</label>
                                    <select class="selectpicker mb-3" data-live-search="true" title="Cari jenis atau nama Sampah" id="sampah" name="sampah" data-width="75%">

                                        <?php $i = 1;
                                        foreach ($sampah as $sampahh) { ?>
                                            <option value=<?= $sampahh['id_sampah'] ?>><?= $sampahh['nama_sampah'] ?></option>
                                        <?php $i++;
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Masukkan berat atau jumlah sampah(/kg atau /biji)</label>
                                    <input type="number" class="form-control" id="berat" name="berat" placeholder="Berat sampah">
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-sm-5">


                                </div>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" id="disabledInput" type="text" name="total" value="0" disabled>

                                </div>
                            </div>
                            <?php if ($anggota['status'] == 0) { ?>
                                <a type="button" class="btn btn-success mt-4" onclick="tambahData()">Kirimkan data tabungan</a>
                            <?php } else { ?>
                                <a type="button" class="btn btn-secondary mt-4 disabled">Anggota tidak aktif</a>
                            <?php } ?>
                        </form>
                    </div>

                    <br>
                    <hr>
                    <br />

                    <div class="panel panel-default table-responsive">
                        <?php



                        echo "*Riwayat transakasi hanya menampilkan transaksi tanggal " . date("d-m-Y") .  "<br>";

                        ?>
                        <br>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nama sampah</th>
                                    <th scope="col">Berat(kg)</th>
                                    <th scope="col">Jumlah(biji)</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Tanggal Kirim</th>
                                </tr>
                            </thead>
                            <tbody id="target">

                            </tbody>

                            <tbody id="">
                                <tr>
                                    <td scope="col">#</td>

                                    <th scope="col" colspan="4">Total tabungan hari ini</th>


                                    <th scope="col" id="sub"></th>
                                    <td scope="col" id="sub"></td>

                                </tr>
                            </tbody>
                        </table>


                    </div>


                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#berat').on('input', function() {

            event.preventDefault();
            var berat = $('#berat').val();
            var sampah = document.getElementById("sampah").value;
            if (berat && sampah != '') {
                $.ajax({
                    url: "<?php base_url() ?>/ProsesBankController/hitungBerat",
                    method: "POST",
                    dataType: "json",
                    data: {
                        sampah: sampah,
                        berat: berat
                    },
                    success: function(data) {
                        console.log(data);
                        $('#disabledInput').val(data);
                    }
                });
            }

        });
    });
    ambilData()
    hitung()

    function hitung() {
        $.ajax({
            type: 'POST',
            url: '<?php base_url() ?>/ProsesBankController/totalHariIni',
            dataType: 'json',
            data: {
                id: <?= $anggota['id_anggota'] ?>,
                path: 1
            },
            success: function(data) {

                $('#sub').html(data);
            }
        })
    }

    function ambilData() {
        $.ajax({
            type: 'POST',
            url: '<?php base_url() ?>/ProsesBankController/ambilDataTabungan',
            dataType: 'json',
            data: {
                id: <?= $anggota['id_anggota'] ?>

            },
            success: function(data) {

                var baris = "";
                var l = 1;
                for (var i = 0; i < data.length; i++) {

                    if (data[i].satuan == "0") {
                        berat = data[i].jumlah_sampah;
                        jumlah = "-";
                        console.log("berat");
                    } else if (data[i].satuan == "1") {
                        jumlah = data[i].jumlah_sampah;
                        berat = "-";
                        console.log("satuan");
                    }
                    baris += '<tr>' +
                        '<td>' + l + '</td>' +
                        '<td>' + data[i].nama_anggota + '</td>' +
                        '<td>' + data[i].nama_sampah + '</td>' +
                        '<td>' + berat + '</td>' +
                        '<td>' + jumlah + '</td>' +
                        '<td>' + data[i].jumlah_tabungan + '</td>' +
                        '<td>' + moment(new Date(data[i].created_at)).format('dddd, MMMM DD YYYY, h:mm:ss a') + '</td>' +

                        '<tr>';
                    l++;
                }
                $('#target').html(baris);
            }
        })
    }

    function tambahData() {
        var sampah_id = $("[name='sampah']").val();
        var berat = $("[name='berat']").val();
        var total = $("[name='total']").val();

        if (sampah_id == "" || berat == "" || total == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak boleh ada field yang kosong',
            });

            return false;
        } else {
            Swal.fire({
                title: 'Data registrasi yang dikirimkan sudah benar?',
                showDenyButton: true,
                confirmButtonText: `Save`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Data berhasil terkirim!', 'success')
                    $.ajax({
                        type: "POST",
                        data: 'sampah_id=' + sampah_id + '&berat=' + berat + '&total=' + total + '&id_anggota=' + <?php echo $anggota['id_anggota'] ?>,
                        url: "<?php base_url() ?>/ProsesBankController/kirimTabungan",
                        dataType: 'json',
                        success: function(hasil) {
                            $('#pesan').html(hasil.pesan);

                            if (hasil.pesan == 'data tabungan berhasil dikirimkan') {
                                $("[name='sampah']").val('');
                                $("[name='berat']").val('');
                                $("[name='total']").val('');
                                ambilData();
                                hitung();
                            }
                        }
                    });
                } else if (result.isDenied) {
                    return false
                }
            })

        }
    }
</script>