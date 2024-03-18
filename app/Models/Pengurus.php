<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengurus extends Model
{
    private $nama_pengurus, $jam_login;
    public function set_nama_pengurus($nama_pengurus)
    {
        $this->nama_pengurus = $nama_pengurus;
    }
    public function set_jam_login($jam_login)
    {
        $this->jam_login = $jam_login;
    }

    public function get_nama_pengurus()
    {
        return $this->nama_pengurus;
    }
    public function get_jam_login()
    {
        return $this->jam_login;
    }
}
