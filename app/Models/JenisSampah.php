<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisSampah extends Model
{
    private $nama_jenis, $keterangan_jenis;
    public function set_nama_jenis_sampah($nama_jenis)
    {
        $this->nama_jenis = $nama_jenis;
    }

    public function get_nama_jenis_sampah()
    {
        return $this->nama_jenis;
    }

    public function set_keterangan_jenis($keterangan_jenis)
    {
        $this->keterangan_jenis = $keterangan_jenis;
    }
    public function get_keterangan_jenis()
    {
        return $this->keterangan_jenis;
    }
}
