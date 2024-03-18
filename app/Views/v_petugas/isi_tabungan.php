<div class="container" style="padding-top: 10px;">
    <div class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body  pl-4">
            <h5 class="card-title">Lihat data tabungan</h5><br>
            <div>
                <div>
                    <label for="anggota">Masukkan nama atau nomor anggota :</label>
                    <select class="selectpicker mb-3" data-live-search="true" title="Nama atau nomor anggota" id="anggota" name="anggota" data-width="75%">
                        <?php $i = 1;
                        foreach ($anggota as $anggota) { ?>
                            <option value=<?= $anggota['id_anggota'] ?> id="a"><?= $anggota['username'] ?>. <?= $anggota['nama_anggota'] ?></option>
                        <?php $i++;
                        } ?>
                    </select>


                </div>
                <div class="mt-3">
                    <a type="submit" class="btn btn-primary" onclick="nama()">Submit</a>
                </div>
            </div>


        </div>
        <div class="card-footer text-muted">
            2 days ago
        </div>
    </div>

</div>


<script>
    function nama() {
        var a = document.getElementById("anggota").value;
        if (a != "") {
            window.location.replace("/input_tabungan-petugas/" + a);
            return true;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak boleh ada field yang kosong',
            });

        }
    };
</script>