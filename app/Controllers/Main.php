<?php

namespace App\Controllers;

use App\Models\Mahasiswa;
//use app/Models/;
class Main extends BaseController
{
    public function __construct()
    {
        helper('form');

        $this->Mahasiswa = new Mahasiswa();
    }

    public function index()
    {

        $this->Mahasiswa->set_nama("Mona ");
        $this->Mahasiswa->set_alamat("Malang ");
        $this->Mahasiswa->set_jalan("Suhat");

        echo $this->Mahasiswa->get_nama();
        echo $this->Mahasiswa->get_alamat();
        echo $this->Mahasiswa->get_jalan();
    }
}
