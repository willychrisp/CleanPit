<div class="container" style="padding-top: 10px;">

    <div class="row gutters-sm">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">

                        <img src="<?= base_url() ?>/img/data_anggota/foto_profil/<?= $anggota['foto_profil_anggota']; ?>" alt="Admin" class="rounded-circle" width="150">
                        <div class="mt-3">
                            <h4><?= $anggota['nama_anggota'] ?></h4>
                            <p class="text-secondary mb-1">@<?= session()->get('username') ?></p>


                            <p class="text-muted font-size-sm"></p>


                            <p class="text-muted font-size-sm"></p>


                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-8">
            <div class="card mb-3">

                <div class="card-body">
                    <form action="ProfilController/ubahPassword" id="formUbahPass" method="POST" enctype="multipart/form-data" onsubmit="validateForm(event)">
                        <p class="login-card-description">Perbarui password</p>
                        <div class="form-group">
                            <label for="nama">Password Lama</label>
                            <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Password lama" autofocus>
                            <span id="check_result"></span>

                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="nama">Password Baru</label>
                            <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="Password baru" autofocus>


                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="nama">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" placeholder="Konfirmasi password baru" autofocus>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input class="btn btn-success mt-4" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    // Get the <span> element that closes the modal
    $(document).ready(function() {
        $('#passwordLama').change(function() {
            var passwordLama = $('#passwordLama').val();
            console.log(passwordLama);
            if (passwordLama != '') {
                $.ajax({
                    url: "ProfilController/checkPassword",
                    method: "POST",
                    data: {
                        password: passwordLama
                    },

                    success: function(data) {
                        $('#check_result').html(data);
                    }
                });
            }
        });
    });

    function validateForm(e) {
        e.preventDefault();

        var lama = document.getElementById("passwordLama").value;
        var baru = document.getElementById("passwordBaru").value;
        var konfirmasi = document.getElementById("konfirmasi").value;

        if (lama == "" || baru == "" || konfirmasi == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tidak boleh ada field yang kosong',
            });

            return false;
        } else if (baru.length < 6) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'password setidaknya harus berisi 6 karakter',
            });
            return false;
        } else if (baru != konfirmasi) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Konfirmasi password tidak sesuai',
            });
            return false;

        } else {
            Swal.fire({
                title: 'Yakin memperbarui password ?',
                showDenyButton: true,
                confirmButtonText: `Save`,
                denyButtonText: `Don't save`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Data berhasil terkirim!', '', 'success')
                    document.getElementById('formUbahPass').submit();
                } else if (result.isDenied) {
                    return false
                }
            })

        }

    }
    // When the user clicks on <span> (x), close the modal
</script>