<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            Tekan data dalam tabel untuk memperbarui data harga sampah
        </div>
        <div class="card-body  pl-4">
            <h1 id="pesan"></h1>
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

                <tbody id="target">

                </tbody>
            </table>

        </div>
    </div>
    <div class="card-footer text-muted">
        2 days ago
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        function load_data() {
            $.ajax({
                url: '<?php base_url() ?>/ProsesBankController/ambilDataSampah',
                dataType: 'json',
                success: function(data) {

                    var baris = "";
                    l = 1;
                    for (var i = 0; i < data.length; i++) {
                        baris += '<tr>' +
                            '<td>' + l + '</td>' +
                            '<td class="table_data" data-row_id="' + data[i].id_sampah + '" data-column_name="nama_sampah" contenteditable>' + data[i].nama_sampah + '</td>' +
                            '<td class="table_data" data-row_id="' + data[i].id_sampah + '" data-column_name="kode" contenteditable>' + data[i].kode + '</td>' +
                            '<td class="table_data" data-row_id="' + data[i].id_sampah + '" data-column_name="harga_sampah" contenteditable>' + data[i].harga_sampah + '</td>' +
                            '<td class="table_data" data-row_id="' + data[i].id_sampah + '" data-column_name="harga_langsung" contenteditable>' + data[i].harga_langsung + '</td>' +
                            '<td>' + data[i].jenis + '</td>' +
                            '<tr>';
                        l++;
                    }
                    $('#target').html(baris);
                }
            });
        }

        load_data();
        $(document).on('blur', '.table_data', function() {
            var id = $(this).data('row_id');
            var table_column = $(this).data('column_name');
            var value = $(this).text();
            console.log(table_column);
            console.log(id);
            console.log(value);

            $.ajax({
                url: "<?php echo base_url(); ?>/ProsesBankController/updateHargaSampah",
                method: "POST",
                data: {
                    id: id,
                    table_column: table_column,
                    value: value
                },
                success: function(data) {
                    Swal.fire('Data berhasil diperbarui!', '', 'success')
                    load_data();
                }
            })
        });
    });
</script>