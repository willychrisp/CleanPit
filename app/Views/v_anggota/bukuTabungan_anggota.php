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

                        <hr>
                    </div>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Kontak anggota</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        <?= $anggota['kontak_anggota'] ?>
                    </div>
                    <hr>
                    <hr>
                </div>
            </div>
            <hr>
            <p class="login-card-description">Buku Tabungan</p>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-buku-tabungan" role="tab" aria-controls="nav-home" aria-selected="true">Buku Tabungan</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-penarikan" role="tab" aria-controls="nav-profile" aria-selected="false">Penarikan</a>

                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-buku-tabungan" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="panel panel-default table-responsive">
                        <table class="table mt-4">
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
                                    <th scope="col">

                                    </th>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-penarikan" role="tabpanel" aria-labelledby="nav-profile-tab">


                    <div class="panel panel-default table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Transaksi</th>
                                    <th scope="col">-</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td colspan="2">Setor Sampah</td>

                                    <td id="setor"></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td colspan="2">Penarikan</td>

                                    <td id="ambil"></td>
                                </tr>
                                <tr>
                                    <th colspan="3">Saldo</th>
                                    <th id="saldo"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>
                <div class="card-footer text-muted">
                    2 days ago
                </div>
            </div>

        </div>
        <script>
            ambilSetor();

            function ambilSetor() {
                $.ajax({
                    type: 'POST',
                    url: '<?php base_url() ?>/ProsesBankController/ambilSaldoTabungan',
                    dataType: 'json',
                    data: {
                        id: <?= $anggota['id_anggota'] ?>
                    },
                    success: function(data) {
                        hitungSaldo(data);
                        $('#setor').html(data);

                    }
                })
                $.ajax({
                    type: 'POST',
                    url: '<?php base_url() ?>/ProsesBankController/ambilDataPenarikan',
                    dataType: 'json',
                    data: {
                        id: <?= $anggota['id_anggota'] ?>
                    },
                    success: function(data) {

                        $('#ambil').html(data);
                    }
                })
            }

            function hitungSaldo(data) {
                var a = data;
                $.ajax({
                    type: 'POST',
                    url: '<?php base_url() ?>/ProsesBankController/ambilDataPenarikan',
                    dataType: 'json',
                    data: {
                        id: <?= $anggota['id_anggota'] ?>
                    },
                    success: function(data) {
                        var b = a + data;
                        $('#saldo').html(b);
                        tarik(b);
                    }
                })

            }
            $("#form-tarik").hide();
            $(document).ready(function() {
                $("#tarik").click(function() {
                    $("#form-tarik").slideToggle();
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
                        path: 2
                    },
                    success: function(data) {

                        $('#sub').html(data);
                    }
                })
            }

            function ambilData() {
                $.ajax({
                    type: 'POST',
                    url: '<?php base_url() ?>/ProsesBankController/ambilSemuaDataTabungan',
                    dataType: 'json',
                    data: {
                        id: <?= $anggota['id_anggota'] ?>

                    },
                    success: function(data) {

                        var baris = "";
                        var l = 1;
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].jenis == 1) {
                                var sampah = "Plastik"
                            }
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
                                '<td>' + (data[i].harga_sampah * data[i].jumlah_sampah) + '</td>' +
                                '<td>' + moment(new Date(data[i].created_at)).format('dddd, MMMM DD YYYY, h:mm:ss a') + '</td>' +

                                '<tr>';
                            l++;
                        }
                        $('#target').html(baris);
                    }
                })
            }
        </script>