<?php

namespace App\Models;

use CodeIgniter\Model;

class Alamat extends Model
{
    public function set_alamat($alamat)
    {
        $this->alamat = $alamat;
    }

    public function get_alamat()
    {
        return $this->alamat;
    }

    public function set_jalan($jalan)
    {
        $this->jalan = $jalan;
    }
    public function get_jalan()
    {
        return $this->jalan;
    }
}
