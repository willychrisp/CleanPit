<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Laporan;

class KerjaBakti extends Model
{

    private String $tanggalKegiatan, $lokasiKegiatan;
    public function setTanggalKegiatan($tanggalKegiatan)
    {
        $this->tanggalKegiatan = $tanggalKegiatan;
    }
    public function getTanggalKegiatan()
    {
        return $this->tanggalKegiatan;
    }
    public function setLokasiKegiatan($lokasiKegiatan)
    {
        $this->lokasiKegiatan = $lokasiKegiatan;
    }
    public function getLokasiKegiatan()
    {
        return $this->lokasiKegiatan;
    }

    public function sendKegiatan($id_laporan)
    {
        $data = [
            'tanggal_kegiatan' => $this->tanggalKegiatan,
            'lokasi_pertemuan' => $this->lokasiKegiatan
        ];
        $update = $this->db->table('Laporan')
            ->where('id', $id_laporan)
            ->update($data);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
