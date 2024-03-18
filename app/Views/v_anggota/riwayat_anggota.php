<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body  pl-4">

            <div>

                <p class="login-card-description">Riwayat transaksi</p>
                <select class="selectpicker mb-3" id="transaksi" title="Choose one of the following...">
                    <option value="1">Penarikan</option>
                    <option value="2">Setor Sampah</option>
                </select>

                <hr>
                <div class="col-sm-6">
                    <div class="container" id="filter-tarik">
                        <input type="text" class="form-control" placeholder="Filter Penarikan" name="filter-tarik">
                        '<p class="login-card-description">Riwayat penarikan sampah</p>'

                    </div>
                    <div class="container" id="filter-setor">
                        <input type="text" class="form-control" placeholder="Filter Setor Sampah" name="filter-setor">
                        '<p class="login-card-description">Riwayat penyetoran sampah</p>'
                    </div>
                </div>


                <div class="container" id="tarik">

                </div>



            </div>
        </div>

        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>

</div>

<script>
    $("#filter-tarik").hide();
    $("#filter-setor").hide();
    $(document).ready(function() {
        $('#transaksi').on('change', function() {
            var a = document.getElementById("transaksi").value;
            if (a == 1) {
                $("#filter-setor").slideUp();
                ambilPenarikan();
                $("#filter-tarik").slideDown();

            } else if (a == 2) {
                $("#filter-tarik").slideUp();
                ambilTabungan();
                $("#filter-setor").slideDown();
            }
        })
    })

    function ambilPenarikan() {
        $.ajax({
            type: 'POST',
            url: '<?php base_url() ?>/TabunganController/ambilDataAnggota',
            dataType: 'json',
            data: {
                jenis: 1
            },
            success: function(data) {
                var baris = "";
                for (var i = 0; i < data.length; i++) {
                    baris += '<div class="container">' +
                        '<div class="card">' +
                        '<div class="card-body">' +
                        '<h4 class="card-title">Transaksi Penarikan</h4>' +
                        '<hr>' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<h6 class="mb-0">Nama anggota</h6>' +
                        '</div>' +
                        '<div class="col-sm-9 text-secondary">' +
                        '' + data[i].nama_anggota + '' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<h6 class="mb-0">username</h6>' +
                        '</div>' +
                        '<div class="col-sm-9 text-secondary">' +
                        data[i].username +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<h6 class="mb-0">Ditarik pada tanggal</h6>' +
                        '</div>' +
                        '<div class="col-sm-9 text-secondary">' +
                        moment(new Date(data[i].created_at)).format('dddd, MMMM DD YYYY, h:mm:ss a') +
                        '</div>' +
                        '</div>' +
                        '<hr>' +
                        '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<h6 class="mb-0">Melakukan penarikan sebesar</h6>' +
                        '</div>' +
                        '<div class="col-sm-6 mr-5" style="color:red; text-decoration:underline">' +
                        data[i].jumlah_penarikan +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<br>';
                }
                $('#tarik').html(baris);


            }
        })
    }

    function ambilTabungan() {
        $.ajax({
            type: 'POST',
            url: '<?php base_url() ?>/TabunganController/ambilDataAnggota',
            dataType: 'json',
            data: {
                jenis: 2
            },
            success: function(data) {
                var baris = "";
                for (var i = 0; i < data.length; i++) {
                    baris += '<div class="container">' +

                        '<div class="card">' +
                        '<div class="card-body">' +
                        '<h4 class="card-title">Transaksi Penarikan</h4>' +
                        '<hr>' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<h6 class="mb-0">Nama anggota</h6>' +
                        '</div>' +
                        '<div class="col-sm-9 text-secondary">' +
                        '' + data[i].nama_anggota + '' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<h6 class="mb-0">username</h6>' +
                        '</div>' +
                        '<div class="col-sm-9 text-secondary">' +
                        data[i].username +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-sm-3">' +
                        '<h6 class="mb-0">Diatrik pada tanggal</h6>' +
                        '</div>' +
                        '<div class="col-sm-9 text-secondary">' +
                        moment(new Date(data[i].created_at)).format('dddd, MMMM DD YYYY, h:mm:ss a') +
                        '</div>' +
                        '</div>' +
                        '<hr>' +
                        '<div class="row">' +
                        '<div class="col-sm-4">' +
                        '<h6 class="mb-0">Melakukan penyetoran sebesar</h6>' +
                        '</div>' +
                        '<div class="col-sm-6 mr-5" style="color:green">' +
                        'Rp. ' + data[i].harga_sampah * data[i].jumlah_sampah + ',00' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<br>';
                }
                $('#tarik').html(baris);


            }
        })
    }
</script>