<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
        </div>
        <div class="card-body  pl-4">
            <div>
                <div>
                    <div class="row">
                        <div class="col-sm-5">
                            <p class="login-card-description">Data Rekap keseluruhan Bank Sampah Dampit</p>
                        </div>
                    </div>
                    <hr>
                    <div class="panel panel-default table-responsive">
                        <h4>Data tabungan masuk</h4>
                        <div class="tab-pane fade show active" id="nav-buku-tabungan" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="panel panel-default table-responsive">
                                <table class="table mt-4">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Nama sampah</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Berat(kg)</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="target">

                                    </tbody>

                                    <tbody id="">
                                        <tr>
                                            <td scope="col">#</td>

                                            <th scope="col" colspan="4">Total tabungan masuk</th>


                                            <th scope="col" id="sub"><?= $total_masuk ?></th>
                                            <th scope="col">

                                            </th>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <h4>Data tabungan masuk</h4>
                        <div class="panel panel-default table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Anggota</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">-</th>
                                    </tr>
                                </thead>
                                <tbody id="target-tarik">

                                </tbody>
                                <tbody id="">
                                    <tr>
                                        <td scope="col">#</td>

                                        <th scope="col" colspan="1">Total tabungan keluar</th>


                                        <th scope="col" id="sub"><?= $total_tarik ?></th>
                                        <th scope="col">

                                        </th>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>




                </div>
            </div>
        </div>
        <div class="card-footer text-muted">

        </div>
    </div>

</div>

<script>
    ambilData()
    ambilDataTarik()

    function ambilData() {
        $.ajax({
            type: 'POST',
            url: '<?php base_url() ?>/ProsesBankController/ambilSemuaDataTabunganBank',
            dataType: 'json',

            success: function(data) {

                var baris = "";
                var l = 1;
                for (var i = 0; i < data.length; i++) {
                    baris += '<tr>' +
                        '<td>' + l + '</td>' +
                        '<td>' + data[i].nama_anggota + '</td>' +
                        '<td>' + data[i].nama_sampah + '</td>' +
                        '<td>' + data[i].kode + '</td>' +
                        '<td>' + data[i].jumlah_sampah + '</td>' +
                        '<td>' + (data[i].harga_sampah * data[i].jumlah_sampah) + '</td>' +

                        '<tr>';
                    l++;
                }
                $('#target').html(baris);
            }
        })
    }


    function ambilDataTarik() {
        $.ajax({
            type: 'POST',
            url: '<?php base_url() ?>/ProsesBankController/ambilSemuaDataPenarikanBank',
            dataType: 'json',

            success: function(data) {

                var baris = "";
                var l = 1;
                for (var i = 0; i < data.length; i++) {
                    baris += '<tr>' +
                        '<td>' + l + '</td>' +
                        '<td>' + data[i].nama_anggota + '</td>' +
                        '<td>' + data[i].jumlah_penarikan + '</td>' +

                        '<tr>';
                    l++;
                }
                $('#target-tarik').html(baris);
            }
        })
    }
</script>