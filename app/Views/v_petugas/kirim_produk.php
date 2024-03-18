<div class="container" style="padding-top: 50px;">

    <div class="card login-card">

        <div class="row justify-content-md-center text-center mb-5">
            <div class="col-lg-7">
                <h2 class="mt-10 heading-border-top login-card-description">Tambahkan produk baru ke dalam daftar produk</h2>

            </div>
        </div>
        <form action="/ProdukController/kirimProduk" id="formProduk" method="POST" enctype="multipart/form-data" style="padding-left: 50px;" onsubmit="validateForm(event)">
            <?= csrf_field(); ?>

            <div class="form-group">
                <label for="nama">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama laporan" autofocus>


            </div>
            <div class="form-group">
                <label for="bahan">Bahan Produk</label>
                <input type="text" class="form-control" id="bahan" placeholder="Tanggal Kegiatan" name="bahan">

            </div>

            <div class="form-group">
                <label for="detail">Detail Produk</label>
                <input type="text" class="form-control" id="detail" placeholder="Tanggal Kegiatan" name="detail">

            </div>
            <div class="form-group">
                <label for="kontak">Kontak Pemilik Produk</label>
                <input type="text" class="form-control" id="kontak" placeholder="Tanggal Kegiatan" name="kontak">

            </div>

            <label>Foto produk</label>
            <div class="form-group row">
                <div class="col-sm-2">
                    <img src="/img/default.png" class="img-thumbnail img-preview" alt="">
                </div>
                <div class="col-sm-8">
                    <label for="foto">Foto</label>
                    <input type="file" class="" id="foto" name="foto" onchange="showPreview();">
                </div>
            </div>

            <div class="form-group">
                <input class="btn btn-block login-btn mb-4" type="submit">
            </div>

        </form>


        <script type="text/javascript">
            function validateForm(e) {
                e.preventDefault();
                var nama = document.getElementById("nama").value;
                var detail = document.getElementById("detail").value;
                var bahan = document.getElementById("bahan").value;
                var foto = document.getElementById("foto").value;
                var kontak = document.getElementById("kontak").value;
                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                if (nama == "" || detail == "" || bahan == "" || foto == "" || kontak == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Tidak boleh ada field yang kosong',
                    });

                    return false;
                } else if (nama.length < 2) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nama produk setidaknya berisi 3 karakter',
                    });
                    return false;
                } else if (detail.length < 10) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Detail produk setidaknya berisi 10 karakter',
                    });
                    return false;
                } else if (!allowedExtensions.exec(foto)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'File yang diupload harus memiliki ektensi .JPG, .JPEG, atau .PNG',
                    });
                    return false;
                } else {
                    Swal.fire({
                        title: 'Produk yang dikirimkan sudah benar?',
                        showDenyButton: true,
                        confirmButtonText: `Save`,
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire('Produk terkirim!', 'success')
                            document.getElementById('formProduk').submit();
                        } else if (result.isDenied) {
                            return false
                        }
                    })

                }

            }

            function showPreview() {
                const foto = document.querySelector('#foto');
                const fotoLabel = document.querySelector('.form-control');
                const imgPreview = document.querySelector('.img-preview');

                fotoLabel.textContent = foto.files[0].name;
                const fileFoto = new FileReader();
                fileFoto.readAsDataURL(foto.files[0]);
                fileFoto.onload = function(e) {
                    imgPreview.src = e.target.result;
                }
            }
        </script>

    </div>
</div>