<div class="container" style="padding-top: 100px;">

    <div class="card login-card">

        <div class="row justify-content-md-center text-center mb-5">
            <div class="col-lg-7">
                <h2 class="mt-10 heading-border-top login-card-description">Ubah data pribadi</h2>

            </div>
        </div>
        <form action="ProfilController/updateDataDiri/<?= $volunteer['id_volunteer'] ?>" id="formDaftar" method="POST" enctype="multipart/form-data" style="padding-left: 50px;" onsubmit="validateForm(event)">
            <?= csrf_field(); ?>
            <div class="form-group">
                <label for="nama">Nama lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $volunteer['nama_volunteer'] ?>" placeholder="Tulis nama lengkap" autofocus>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal lahir</label>
                <input type="date" class="form-control" id="tanggal" value="<?= $volunteer['tanggal'] ?>" placeholder="Tanggal lahir" name="tanggal">
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $volunteer['alamat'] ?>" placeholder="Tulis alamat sesuai dengan KTP">
            </div>

            <div class="form-group">
                <label for="hp">No HP</label>
                <input type="number" class="form-control" id="hp" name="hp" value="<?= $volunteer['hp'] ?>" placeholder="Masukkan nomor HP...">

            </div>

            <div class="form-group">
                <label for="biodata">Biodata</label>
                <input type="text" class="form-control" id="biodata" name="biodata" value="<?= $volunteer['biodata'] ?>" placeholder="Tulis biodata">

            </div>
            <div class="form-group">
                <input class="btn btn-block login-btn mb-4" type="submit">
            </div>

        </form>

    </div>
</div>
<script type="text/javascript">
    function validateForm(e) {
        e.preventDefault();

        var nama = document.getElementById("nama").value;
        var tanggal = document.getElementById("tanggal").value;
        var alamat = document.getElementById("alamat").value;
        var hp = document.getElementById("hp").value;
        var biodata = document.getElementById("biodata").value;

        if (nama == "" || tanggal == "" || alamat == "" || hp == "" || biodata == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak boleh ada field yang kosong',
            });

            return false;
        } else if (nama.length < 5) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Nama laporan setidaknya berisi 5 karakter',
            });
            return false;
        } else if (alamat.length < 10) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'alamat laporan setidaknya berisi 10 karakter',
            });
            return false;
        } else {
            Swal.fire({
                title: 'Perubahan data yang dikirimkan sudah benar?',
                showDenyButton: true,
                confirmButtonText: `Save`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Data berhasil diubah!', '', 'success')
                    document.getElementById('formDaftar').submit();
                } else if (result.isDenied) {
                    return false
                }
            })

        }

    }
</script>