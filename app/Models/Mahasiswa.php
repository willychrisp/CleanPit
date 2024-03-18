<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Alamat;

class Mahasiswa extends Model
{
    private $nama;
    private Alamat $kota;
    private Alamat $jalan;

    public function __construct()
    {
        $this->Alamat = new Alamat();
    }
    public function set_nama($nama)
    {
        $this->nama = $nama;
    }
    public function get_nama()
    {
        return $this->nama;
    }
    public function set_alamat($kota)
    {
        $this->Alamat->set_alamat($kota);
    }
    public function get_alamat()
    {
        return $this->Alamat->get_alamat();
    }
    public function set_jalan($jalan)
    {
        $this->Alamat->set_jalan($jalan);
    }
    public function get_jalan()
    {
        return $this->Alamat->get_jalan();
    }
}
