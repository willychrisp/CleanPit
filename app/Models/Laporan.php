<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class Laporan extends Model
{
    private string $identitas, $nomor, $nama_laporan, $isi_laporan, $tanggal, $lokasi, $wilayah, $objek, $foto, $pengirim;
    private int $jumlah, $status;

    public function set_identitas_pengirim($identitas)
    {
        $this->identitas = $identitas;
    }
    public function get_identitas_pengirim()
    {
        return $this->identitas;
    }
    public function set_nomor_pengirim($nomor)
    {
        $this->nomor = $nomor;
    }
    public function get_nomor_pengirim()
    {
        return $this->nomor;
    }
    public function set_nama_laporan($nama_laporan)
    {
        $this->nama_laporan = $nama_laporan;
    }
    public function get_nama_laporan()
    {
        return $this->nama_laporan;
    }
    public function set_isi_laporan($isi_laporan)
    {
        $this->isi_laporan = $isi_laporan;
    }
    public function get_isi_laporan()
    {
        return $this->isi_laporan;
    }
    public function set_tanggal_laporan($tanggal)
    {
        $this->tanggal = $tanggal;
    }
    public function get_tanggal_laporan()
    {
        return $this->tanggal;
    }
    public function set_lokasi_laporan($lokasi)
    {
        $this->lokasi = $lokasi;
    }
    public function get_lokasi_laporan()
    {
        return $this->lokasi;
    }
    public function set_wilayah($wilayah)
    {
        $this->wilayah = $wilayah;
    }
    public function get_wilayah()
    {
        return $this->wilayah;
    }
    public function set_objek($objek)
    {
        $this->objek = $objek;
    }
    public function get_objek()
    {
        return $this->objek;
    }
    public function set_foto_laporan($foto)
    {
        $this->foto = $foto;
    }
    public function get_foto_laporan()
    {
        return $this->foto;
    }
    public function set_jumlah_volunteer($jumlah)
    {
        $this->jumlah = $jumlah;
    }
    public function get_jumlah_vounteer()
    {
        return $this->jumlah;
    }
    public function set_pengirim_laporan($pengirim)
    {
        $this->pengirim = $pengirim;
    }
    public function get_pengirim_laporan()
    {
        return $this->pengirim;
    }
    public function set_status_laporan($status)
    {
        $this->status = $status;
    }
    public function get_status_laporan()
    {
        return $this->status;
    }
    public function getLaporanbyID($id_volunteer, $lmt)
    {

        return $this->db->table('Laporan')
            ->where('id_volunteer', $id_volunteer)
            ->orderBy("created_at", "desc")
            ->limit($lmt)
            ->get()->getResultArray();
    }

    public function getLaporan($id_laporan, $lmt)
    {

        return $this->db->table('Laporan')
            ->where('id', $id_laporan)
            ->limit($lmt)
            ->get()->getRowArray();
    }

    public function getLaporanData($a)
    {
        return $this->db->table('Laporan')
            ->select('laporan.*')
            ->select('akun_pengguna.username')
            ->select('volunteer.nama_volunteer')
            ->select('volunteer.foto as fotow')
            ->join('volunteer', 'laporan.id_volunteer=volunteer.id_volunteer')
            ->join('akun_pengguna', 'volunteer.id_pengguna=akun_pengguna.id')
            ->where('laporan.status', $a)
            ->orderBy("laporan.created_at", "desc")
            ->get()->getResultArray();
    }
    public function getLaporanDataUmum($a, $jenis)
    {
        return $this->db->table('Laporan')
            ->select('laporan.*')
            ->where('laporan.status', $a)
            ->where('jenis', $jenis)
            ->orderBy("laporan.created_at", "desc")
            ->get()->getResultArray();
    }
    public function sendLaporan(): bool
    {
        $data = [
            'nama_laporan' => $this->nama_laporan,
            'isi_laporan' => $this->isi_laporan,
            'tanggal' => $this->tanggal,
            'lokasi' => $this->lokasi,
            'wilayah' => $this->wilayah,
            'objek' => $this->objek,
            'foto' => $this->foto,
            'id_volunteer' => $this->pengirim,
            'status' => "0",
            'jenis' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $insert = $this->db->table('laporan')->insert($data);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
    public function sendLaporanUser($jenis): bool
    {
        $data = [
            'identitas_pengirim' => $this->identitas,
            'nomor' => $this->nomor,
            'nama_laporan' => $this->nama_laporan,
            'isi_laporan' => $this->isi_laporan,
            'tanggal' => $this->tanggal,
            'lokasi' => $this->lokasi,
            'wilayah' => $this->wilayah,
            'objek' => $this->objek,
            'foto' => $this->foto,
            'status' => "0",
            'jenis' => $jenis,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $insert = $this->db->table('laporan')->insert($data);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }

    public function verifikasiLaporan($id)
    {
        $status = [
            'status' => $this->get_status_laporan()
        ];
        $update = $this->db->table('laporan')->where('id', $id)->update($status);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteLaporan($id)
    {
        return $this->db->table('laporan')
            ->where('id', $id)
            ->delete();
    }
}
