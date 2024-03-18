<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\KerjaBakti;

class LaporanKegiatan extends Model
{
    private $jumlahVol, $isi_laporan;

    public function setJumlahVolunteer($jumlahVol)
    {
        $this->jumlahVol = $jumlahVol;
    }
    public function getJumlahVolunteer()
    {
        return $this->jumlahVol;
    }
    public function setIsiLaporan($isi_laporan)
    {
        $this->isi_laporan = $isi_laporan;
    }
    public function getIsiLaporan()
    {
        return $this->isi_laporan;
    }
    public function sendLaporanKegiatan($id_laporan)
    {
        $data = [
            'laporan_kegiatan' => $this->isi_laporan,
            'jumlah_peserta' => $this->jumlahVol
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
