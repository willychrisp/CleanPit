<?php

namespace App\Models;

use CodeIgniter\Model;

class Anggota extends Model
{
    private $nama_anggota, $alamat_anggota, $tanggal_bergabung, $foto_anggota, $kontak_anggota, $bio_anggota;
    public function set_nama_anggota($nama_anggota)
    {
        $this->nama_anggota = $nama_anggota;
    }
    public function get_nama_anggota()
    {
        return $this->nama_anggota;
    }
    public function set_alamat_anggota($alamat_anggota)
    {
        $this->alamat_anggota = $alamat_anggota;
    }
    public function get_alamat_anggota()
    {
        return $this->alamat_anggota;
    }
    public function set_tanggal_bergabung($tanggal_bergabung)
    {
        $this->tanggal_bergabung = $tanggal_bergabung;
    }
    public function get_tanggal_bergabung()
    {
        return $this->tanggal_bergabung;
    }
    public function set_foto_anggota($foto_anggota)
    {
        $this->foto_anggota = $foto_anggota;
    }
    public function get_foto_anggota()
    {
        return $this->foto_anggota;
    }
    public function set_kontak_anggota($kontak_anggota)
    {
        $this->kontak_anggota = $kontak_anggota;
    }
    public function get_kontak_anggota()
    {
        return $this->kontak_anggota;
    }
    public function set_bio_anggota($bio_anggota)
    {
        $this->bio_anggota = $bio_anggota;
    }
    public function get_bio_anggota()
    {
        return $this->bio_anggota;
    }


    public function getDataAnggota($username)
    {
        return $this->db->table('akun_pengguna')
            ->where('username', $username)
            ->join('anggota', 'anggota.id_pengguna=akun_pengguna.id')
            ->get()->getRowArray();
    }

    public function getSemuaDataAnggota()
    {
        return $this->db->table('akun_pengguna')
            ->join('anggota', 'anggota.id_pengguna=akun_pengguna.id')
            ->get()->getResultArray();
    }
    public function getDatabyIdAnggota($anggota)
    {
        return $this->db->table('anggota')
            ->where('id_anggota', $anggota)
            ->join('akun_pengguna', 'anggota.id_pengguna=akun_pengguna.id')
            ->get()->getRowArray();
    }
    public function tambahAnggota($id_pengguna)
    {
        $data = [
            'nama_anggota' => $this->nama_anggota,
            'alamat_anggota' => $this->alamat_anggota,
            'tanggal_bergabung' => $this->tanggal_bergabung,
            'foto_profil_anggota' => "user.png",
            'kontak_anggota' => $this->kontak_anggota,
            'bio_anggota' => $this->bio_anggota,
            'id_pengguna' => $id_pengguna,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->table('anggota')
            ->insert($data);
    }

    public function keterangan($id, $data)
    {
        return $this->db->table('anggota')
            ->where('id_anggota', $id)
            ->update($data);
    }
    public function jumlahAktif()
    {
        return $this->db->table('anggota')
            ->where('status', 0)
            ->get()->getResultArray();
    }
    public function ubahStatus($id, $a)
    {
        return $this->db->table('anggota')
            ->where('id_anggota', $id)
            ->update(array('status' => $a));
    }
    public function getPassword($session)
    {
        return $this->db->table('akun_pengguna')
            ->select('password')
            ->where('username', $session)
            ->get()->getRowArray();
    }
}
