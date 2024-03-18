<div class="container" style="padding-top: 100px;">

    <div class="card login-card">
        <div class="card-body pt-4 pl-4 pb-4">
            <div class="row justify-content-md-center text-center mb-3">
                <div class="col-lg-7">
                    <h2 class="mt-10 heading-border-top login-card-description">Pelaporan Lingkungan Kotor</h2>

                </div>
            </div>
            <form action="/LaporanController/kirimlaporan" id="formLapor" method="POST" enctype="multipart/form-data" style="padding-left: 50px;" onsubmit="validateForm(event)">
                <?= csrf_field(); ?>


                <div class="form-group">
                    <label for="lokasi">Pelapor yang tidak memiliki akun mohon diisi identitas diri untuk proses verifikasi laporan</label></br>
                    <div class="card">
                        <h5 class="card-header" style="font-size: 16px;">Form identitas diri</h5>
                        <div class="card-body pt-4 pl-4 pb-4">
                            <div class="form-group">
                                <label for="nama">Identitas Pengirim</label>
                                <input type="text" class="form-control" id="identitas" name="identitas" placeholder="Isikan nama lengkap" autofocus>
                            </div>

                            <div class="form-group">
                                <label for="nama">Nomer HP</label>
                                <input type="text" class="form-control" id="nomor" name="nomor" placeholder="Isikan nomer hp yang dapat dihubungi">
                            </div>
                        </div>
                    </div>

                </div>


                <div class="form-group">
                    <label for="nama">Nama Laporan</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama laporan" autofocus>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal kegiatan</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Kegiatan" name="tanggal">

                </div>


                <div class="form-group">
                    <label for="lokasi">Lokasi lingkungan kotor</label></br>
                    <div class="card">
                        <h5 class="card-header" style="font-size: 16px;">Form lokasi lingkungan kotor</h5>
                        <div class="card-body pt-4 pl-4 pb-4">
                            <div>
                                <label for="anggota">Masukkan wilayah yang akan dilaporkan :</label>
                                <select class="selectpicker mb-3" data-live-search="true" title="Wilayah" id="wilayah" name="wilayah" data-width="75%">
                                    <option value="Dampit pusat" id="a">Dampit Pusat</option>
                                    <option value="Dampit barat" id="a">Dampit Barat (wilayah Pamotan dan sekitarnya)</option>
                                    <option value="Dampit utara" id="a">Dampit Utara (wilayah Umbulrejo dan sekitarnya)</option>
                                    <option value="Dampit timur" id="a">Dampit Timur (wilayah Amadanom dan sekitarnya)</option>
                                    <option value="Dampit selatan" id="a">Dampit Selatan (wilayah Pamotan dan sekitarnya)</option>
                                </select>


                            </div>

                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi Laporan">
                            <h6 style="font-size: 11px; font-style: italic;" class="text-secondary">*Obyek sekitar contohnya : kolam, pohon, tempat pembungan sampah, dll</h6>
                            <input type="text" class="form-control" id="objek" name="objek" placeholder="Objek sekitar">
                            <h6 style="font-size: 11px; font-style: italic;" class="text-secondary">*Untuk memastikan keabsahan informasi lingkungan kotor, apabila masukkan lokasi tidak benar sesuai dengan wilayahnya maka laporan tidak dapat diverifikasi</h6>

                        </div>
                    </div>

                </div>
                <label>Foto lampiran lingkungan kotor</label>
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
                    <label for="jumlah">Jumlah volunteer</label>
                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Volunteer">

                </div>
                <div class="form-group">
                    <input class="btn btn-block login-btn mb-4" id="jenis" name="jenis" value="3" type="hidden">
                    <input class="btn btn-block login-btn mb-4" type="submit">
                </div>

            </form>


            <script type="text/javascript">
                function validateForm(e) {
                    e.preventDefault();
                    var identitas = document.getElementById("identitas").value;
                    var nomor = document.getElementById("nomor").value;
                    var jenis = document.getElementById("jenis").value;
                    var nama = document.getElementById("nama").value;
                    var tanggal = document.getElementById("tanggal").value;
                    var lokasi = document.getElementById("lokasi").value;
                    var foto = document.getElementById("foto").value;
                    var jumlah = document.getElementById("jumlah").value;
                    var wilayah = document.getElementById("wilayah").value;
                    var objek = document.getElementById("objek").value;
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                    var num = +jumlah;
                    if (identitas == "" || nomor == "" || nama == "" || tanggal == "" || lokasi == "" || foto == "" || jumlah == "" || wilayah == "" || objek == "") {
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
                    } else if (lokasi.length < 10) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Lokasi laporan setidaknya berisi 10 karakter',
                        });
                        return false;
                    } else if (!allowedExtensions.exec(foto)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'File yang diupload harus memiliki ektensi .JPG, .JPEG, atau .PNG',
                        });
                        return false;
                    } else if (Number.isInteger(num) == false) {
                        alert("This is not a valid ID");
                    } else {
                        Swal.fire({
                            title: 'Laporan yang dikirimkan sudah benar?',
                            showDenyButton: true,
                            confirmButtonText: `Save`,
                            denyButtonText: `Don't save`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire('Laporan terkirim!', 'Menunggu verifikasi oleh admin', 'success')
                                document.getElementById('formLapor').submit();
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
</div>