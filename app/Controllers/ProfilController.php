<?php

namespace App\Controllers;

use App\Models\AkunPengguna;
use App\Models\Volunteer;
use App\Models\Laporan;
use App\Models\Anggota;
use App\Models\Komunitas;

//use app/Models/;
class ProfilController extends BaseController
{
    //membuka profil pribadi aktor volunteer
    public function index()
    {
        $volunteer = new Volunteer();
        $laporan = new Laporan();
        $komunitas = new Komunitas();
        $session = session()->get('username');

        $volunter = $volunteer->getDataVolunteer($session);
        $lapor = $laporan->getLaporanbyID($volunter['id_volunteer'], 2);
        $jumlahlaporan = $laporan->getLaporanbyID($volunter['id_volunteer'], null);
        $getKomunitas = $volunter['id_komunitas'];
        $kom = $komunitas->getKomunitas($getKomunitas);

        $i = count($jumlahlaporan);


        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_profilVolunteer',
            'volunteer' => $volunter,
            'laporan' => $lapor,
            'jumlah'  => $i,
            'komunitas' => $kom
        ];
        echo view('wrapper1', $data);
    }

    //membuka profil pribadi aktor anggota
    public function profilAnggota()
    {
        $anggota = new Anggota();
        $session = session()->get('username');

        $angota = $anggota->getDataAnggota($session);

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_anggota/profil_anggota',
            'anggota' => $angota,
        ];
        echo view('wrapper-anggota', $data);
    }

    //Halaman mengganti foto profil volunteer
    public function gantiFotoPage()
    {

        $volunteer = new Volunteer();
        $laporan = new Laporan();
        $session = session()->get('username');

        $volunter = $volunteer->getDataVolunteer($session);

        $jumlahlaporan = $laporan->getLaporanbyID($volunter['id_volunteer'], null);
        $i = count($jumlahlaporan);

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_gantiFotoPage',
            'volunteer' => $volunter,
            'jumlah'  => $i
        ];
        echo view('wrapper1', $data);
    }

    //Fungsi mengubah foto profil
    public function updateFoto()
    {
        $volunteer = new Volunteer();
        $session = session()->get('username');
        $volunter = $volunteer->getDataVolunteer($session);
        $oldFile = "./img/data_volunteer/" . $volunter['foto'];
        //  unlink($oldFile);
        $newFile = $this->request->getFile('foto');
        $newFile->move('./img/data_volunteer');
        $namaFoto = $newFile->getName();

        $volunteer->set_foto_volunteer($namaFoto);

        $update = $volunteer->updateFoto($volunter['id_volunteer']);
        if ($update == true) {
            return redirect()->to('/profil');
        } else {
            return redirect()->to('/gantiFoto');
        }
    }

    //Halaman perbarui data diri volunteere
    public function updateDataDiriPage()
    {
        $volunteer = new Volunteer();
        $session = session()->get('username');
        $volunter = $volunteer->getDataVolunteer($session);
        $data = [
            'title' =>     'Bank Sampah Dampit || Register',
            'isi'   =>      'v_volunteer/v_updateData',
            'volunteer' => $volunter,
        ];
        echo view("wrapper1", $data);
    }

    //fungsi mengubah data diri
    public function updateDataDiri($id_volunteer)
    {
        $volunteer = new Volunteer();
        $volunteer->set_nama_volunteer($this->request->getVar('nama'));
        $volunteer->set_alamat_volunteer($this->request->getVar('alamat'));
        $volunteer->set_tanggal_lahir($this->request->getVar('tanggal'));
        $volunteer->set_kontak_volunteer($this->request->getVar('hp'));
        $volunteer->set_bo_volunteer($this->request->getVar('biodata'));

        $update = $volunteer->ubahDataDiri($id_volunteer);
        if ($update == true) {
            return redirect()->to('/profil');
        } else {
            return redirect()->to('/updateDataDiri');
        }
    }
    //halaman ubah password anggota
    public function ubahPasswordPage()
    {
        $anggota = new Anggota();
        $session = session()->get('username');
        $data = $anggota->getpassword($session);
        $angota = $anggota->getDataAnggota($session);

        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_anggota/ubah-password-page',
            'anggota' => $angota,
        ];
        echo view('wrapper-anggota', $data);
    }

    //fungsi memeriksa password sesuai atau tidak
    public function checkPassword()
    {
        $anggota = new Anggota();
        $session = session()->get('username');
        $data = $anggota->getpassword($session);

        if ($data['password'] == $_POST["password"]) {
            echo
            '
            <div class="alert alert-success">Password sesuai</div>';
        } else {
            echo '
            <div class="alert alert-warning">Password salah</div>';
        }
    }

    //fungsi mengubah password
    public function ubahPassword()
    {
        $akun = new AkunPengguna();
        $session = session()->get('username');
        $akun->set_password($this->request->getVar('passwordBaru'));

        $update = $akun->ubahPass($session);
        if ($update == true) {
            return redirect()->to('/home-anggota');
        } else {
            return redirect()->to('/profil-anggota');
        }
    }
}
