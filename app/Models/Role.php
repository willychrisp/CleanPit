<?php

namespace App\Models;

use CodeIgniter\Model;

class Role extends Model
{
    private $nama_role, $deskripsi;

    public function set_nama_role($nama_role)
    {
        $this->nama_role = $nama_role;
    }
    public function get_nama_role()
    {
        return $this->nama_role;
    }
    public function set_deskripsi($deskripsi)
    {
        $this->deskripsi = $deskripsi;
    }
    public function get_deskripsi()
    {
        return $this->deskripsi;
    }
}
