<div class="container" style="padding-top: 130px;">

    <div class="card login-card">

        <div class="row justify-content-md-center text-center mb-5">
            <div class="col-lg-7">
                <h2 class="mt-10 heading-border-top login-card-description">Buat Komunitas Baru</h2>

            </div>
        </div>
        <?php if (empty($kom)) { ?>
            <form action="/KomunitasController/KirimKomunitas" id="formKomunitas" method="POST" enctype="multipart/form-data" style="padding-left: 50px;" onsubmit="validateForm(event)">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="nama">Nama komunitas</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama komunitas" autofocus>


                </div>
                <div class="form-group">
                    <label for="lokasi">Nomor kontak</label>
                    <input type="text" class="form-control" id="no_kontak" name="no_kontak" placeholder="Nomor kontak aktif">

                </div>
                <div class="form-group">
                    <label for="jumlah">Tentang komunitas</label>
                    <input type="text" class="form-control" id="bio" name="bio" placeholder="Tuliskan sedikit tentang komunitas anda">

                </div>
                <div class="form-group">
                    <input class="btn btn-block login-btn mb-4" type="submit">
                </div>

            </form>
        <?php } else { ?>
            <div class="row justify-content-md-center text-center mb-5">
                <div class="col-lg-7">
                    <h2 class="mt-10 heading-border-top login-card-description">Tidak bisa membuat komunitas ketika sedang tergabung kedalam sebuah komunitas</h2>

                </div>
            <?php } ?>
            </div>


            <script type="text/javascript">
                function validateForm(e) {
                    e.preventDefault();
                    var nama = document.getElementById("nama").value;
                    var no_kontak = document.getElementById("no_kontak").value;
                    var bio = document.getElementById("bio").value;

                    if (nama == "" || no_kontak == "" || bio == "") {
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
                            text: 'Nama komunitas setidaknya berisi 5 karakter',
                        });
                        return false;
                    } else if (no_kontak.length < 11) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Nomor kontak setidaknya 11 digit',
                        });
                        return false;
                    } else if (bio.length < 5) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'keterangan komunitas terlalu singkat',
                        });
                        return false;
                    } else {
                        Swal.fire({
                            title: 'Komunitas yang dikirimkan sudah benar?',
                            showDenyButton: true,
                            confirmButtonText: `Save`,
                            denyButtonText: `Don't save`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire('Komunitas terkirim!', 'Menunggu verifikasi oleh admin', 'success')
                                document.getElementById('formKomunitas').submit();
                            } else if (result.isDenied) {
                                return false
                            }
                        })

                    }

                }
            </script>

    </div>
</div>