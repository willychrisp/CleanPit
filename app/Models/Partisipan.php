<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KerjaBakti;

class Partisipan extends Volunteer
{

    private $nama_partisipan, $laporan;
    private KerjaBakti $KerjaBakti;

    public function __construct()
    {
        parent::__construct();
        $this->KerjaBakti = new KerjaBakti();
    }
    public function set_nama_partisipan($nama_partisipan)
    {
        $this->nama_partisipan = $nama_partisipan;
    }
    public function get_nama_partisipan()
    {
        return $this->nama_partisipan;
    }
    public function set_laporan($laporan)
    {
        $this->$laporan = $laporan;
    }
    public function get_laporan()
    {
        return $this->laporan;
    }

    function cekIdPartisipan($id_volunteer, $id_laporan)
    {
        return $this->db->table('partisipan')
            ->where('id_volunteer', $id_volunteer)
            ->where('id_laporan', $id_laporan)
            ->get()->getResult();
    }

    function getPartisipan($id_laporan)
    {
        return $this->db->table('partisipan')
            ->where('id_laporan', $id_laporan)
            ->join('volunteer', 'partisipan.id_volunteer=volunteer.id_volunteer')
            ->get()->getResultArray();
    }
    public function part($id_laporan)
    {
        $data =
            [
                'id_volunteer' => $this->nama_partisipan,
                'id_laporan' => $id_laporan,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
        $this->db->table('partisipan')
            ->insert($data);
    }
}
