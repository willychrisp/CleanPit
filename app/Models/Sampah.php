<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\JenisSampah;

class Sampah extends Model
{
    private String $nama_sampah, $harga_sampah;
    private JenisSampah $jenis_sampah;

    public function __construct()
    {
        parent::__construct();
        $this->jenis_sampah = new JenisSampah();
    }
    public function set_nama_sampah($nama_sampah)
    {
        $this->nama_sampah = $nama_sampah;
    }
    public function get_nama_sampah()
    {
        return $this->nama_sampah;
    }
    public function set_harga_sampah($harga_sampah)
    {
        $this->harga_sampah = $harga_sampah;
    }
    public function get_harga_sampah()
    {
        return $this->harga_sampah;
    }
    public function set_jenis_sampah()
    {
        $this->nama_sampah = $this->jenis_sampah->get_nama_jenis_sampah();
    }
    public function getSemuaDataSampah()
    {
        return $this->db->table('sampah')

            ->get()->getResultArray();
    }
    public function getHarga($sampah)
    {
        return $this->db->table('sampah')
            ->select('harga_sampah')
            ->where('id_sampah', $sampah)
            ->get()->getResult();
    }
    public function updateSampah($id, $data)
    {
        return $this->db->table('sampah')
            ->where('id_sampah', $id)
            ->update($data);
    }
}
