<?php

namespace App\Models;

use CodeIgniter\Model;

class Penarikan extends Model
{

    public function getJumlahPenarikan($id)
    {
        return $this->db->table('penarikan')
            ->where('id_anggota', $id)
            ->get()->getResultArray();
    }
    public function getSemuaPenarikan()
    {
        return $this->db->table('anggota')
            ->select('anggota.nama_anggota')
            ->select('penarikan.*')
            ->select('akun_pengguna.username')
            ->orderBy("created_at", "desc")
            ->join('penarikan', 'anggota.id_anggota = penarikan.id_anggota')
            ->join('akun_pengguna', 'anggota.id_pengguna = akun_pengguna.id')
            ->get()->getResultArray();
    }
}
