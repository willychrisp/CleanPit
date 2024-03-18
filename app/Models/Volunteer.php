<?php

namespace App\Models;

use CodeIgniter\Model;

class Volunteer extends Model
{
    private $nama_volunteer, $alamat, $tanggal, $foto, $foto_ktp, $hp, $biodata, $alamat_KTP, $status;

    public function set_nama_volunteer($nama_volunteer)
    {
        $this->nama_volunteer = $nama_volunteer;
    }
    public function get_nama_volunteer()
    {
        return $this->nama_volunteer;
    }
    public function set_alamat_volunteer($alamat)
    {
        $this->alamat = $alamat;
    }
    public function get_alamat_volunteer()
    {
        return $this->alamat;
    }
    public function set_tanggal_lahir($tanggal)
    {
        $this->tanggal = $tanggal;
    }
    public function get_tanggal_lahir()
    {
        return $this->tanggal;
    }
    public function set_foto_volunteer($foto)
    {
        $this->foto = $foto;
    }
    public function get_foto_volunteer()
    {
        return $this->foto_ktp;
    }
    public function set_foto_ktp($foto_ktp)
    {
        $this->foto_ktp = $foto_ktp;
    }
    public function get_foto_ktp()
    {
        return $this->foto;
    }
    public function set_kontak_volunteer($hp)
    {
        $this->hp = $hp;
    }
    public function get_kontak_volunteer()
    {
        return $this->hp;
    }
    public function set_bo_volunteer($biodata)
    {
        $this->biodata = $biodata;
    }
    public function get_bo_volunteer()
    {
        return $this->biodata;
    }
    public function set_alamat_KTP($alamat_KTP)
    {
        $this->alamat_KTP = $alamat_KTP;
    }
    public function get_alamat_KTP()
    {
        return $this->alamat_KTP;
    }
    public function set_status($status)
    {
        $this->status = $status;
    }
    public function get_status()
    {
        return $this->status;
    }
    public function cekLogin($username, $password)
    {
        return $this->db->table('akun_pengguna')
            ->where(array(
                'username' => $username,
                'password' => $password
            ))

            ->get()->getRowArray();
    }

    public function getDataVolunteer($username)
    {
        return $this->db->table('akun_pengguna')
            ->where('username', $username)
            ->join('volunteer', 'volunteer.id_pengguna=akun_pengguna.id')
            ->get()->getRowArray();
    }

    public function getDataVolunteerByIdVolunteer($id_profil)
    {
        return $this->db->table('akun_pengguna')
            ->where('id_volunteer', $id_profil)
            ->join('volunteer', 'volunteer.id_pengguna=akun_pengguna.id')
            ->get()->getRowArray();
    }
    public function getDataVolunteerById($id_profil)
    {
        return $this->db->table('akun_pengguna')
            ->where('id_pengguna', $id_profil)
            ->join('volunteer', 'volunteer.id_pengguna=akun_pengguna.id')
            ->get()->getRowArray();
    }
    public function getDataVolunteerByLaporan($id_laporan)
    {
        return $this->db->table('laporan')
            ->select('volunteer.*')
            ->where('id', $id_laporan)
            ->join('volunteer', 'volunteer.id_volunteer=laporan.id_volunteer')
            ->get()->getRowArray();
    }
    public function getDataVolunteerByKomunitas($id_komunitas)
    {
        return $this->db->table('volunteer')
            ->where('id_komunitas', $id_komunitas)
            ->get()->getResultArray();
    }

    public function getIdVolunteer($id)
    {
        return $this->db->table('volunteer')
            ->select('id_volunteer')
            ->where('id_pengguna', $id)
            ->get()->getRowArray();
    }
    public function getVolunteerData($a)
    {
        return $this->db->table('Volunteer')
            ->where('status', $a)

            ->get()->getResultArray();
    }

    public function regisVolunteer($id_pengguna)
    {
        $data = [
            'nama_volunteer' => $this->nama_volunteer,
            'alamat' => $this->alamat,
            'tanggal' => $this->tanggal,
            'foto' => $this->foto,
            'foto_ktp' => $this->foto_ktp,
            'hp' => $this->hp,
            'biodata' => $this->biodata,
            'status' => "0",
            'id_pengguna' => $id_pengguna,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->table('volunteer')
            ->insert($data);
    }
    public function updateFoto($id_volunteer)
    {
        $foto = [
            'foto' => $this->foto
        ];
        $update = $this->db->table('volunteer')->where('id_volunteer', $id_volunteer)->update($foto);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    public function ubahDataDiri($id_volunteer)
    {
        $data = [
            'nama_volunteer' => $this->nama_volunteer,
            'alamat' => $this->alamat,
            'tanggal' => $this->tanggal,
            'hp' => $this->hp,
            'biodata' => $this->biodata
        ];
        $update = $this->db->table('volunteer')->where('id_volunteer', $id_volunteer)->update($data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    public function gabungKomunitas($id_komunitas, $id_pengguna)
    {
        $data = [
            'id_komunitas' => $id_komunitas
        ];
        $this->db->table('volunteer')->where('id_pengguna', $id_pengguna)->update($data);
    }

    //Proses verifikasi
    public function verifikasiPengguna($id)
    {
        $status = [
            'status' => $this->get_status()
        ];
        $update = $this->db->table('volunteer')->where('id_volunteer', $id)->update($status);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    //Proses verifikasi bagian hapus
    public function deletePengguna($id)
    {
        return $this->db->table('akun_pengguna')
            ->where('id', $id)
            ->delete();
    }
}
