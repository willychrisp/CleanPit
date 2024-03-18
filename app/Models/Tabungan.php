<?php

namespace App\Models;

use CodeIgniter\Model;

class Tabungan extends Model
{
    private $tanggal_isi, $jumlah_sampah, $jumlah_tabungan, $pemilik_data, $penarikan;


    public function set_id_data($id_data)
    {
        $this->id_data = $id_data;
    }
    public function get_id_data()
    {
        return $this->id_data;
    }
    public function set_tanggal_isi($tanggal_isi)
    {
        $this->tanggal_isi = $tanggal_isi;
    }
    public function get_tanggal_isi()
    {
        return $this->tanggal_isi;
    }
    public function set_jumlah_sampah($jumlah_sampah)
    {
        $this->jumlah_sampah = $jumlah_sampah;
    }
    public function get_jumlah_sampah()
    {
        return $this->jumlah_sampah;
    }
    public function set_jumlah_tabungan($jumlah_tabungan)
    {
        $this->jumlah_tabungan = $jumlah_tabungan;
    }
    public function get_jumlah_tabungan()
    {
        return $this->jumlah_tabungan;
    }
    public function set_pemilik_data($pemilik_data)
    {
        $this->pemilik_data = $pemilik_data;
    }
    public function get_pemilik_data()
    {
        return $this->pemilik_data;
    }
    public function set_jumlah_penarikan($penarikan)
    {
        $this->penarikan = $penarikan;
    }
    public function get_jumlah_penarikan()
    {
        return $this->penarikan;
    }



    public function getTabunganbyID($id)
    {
        return $this->db->table('tabungan')
            ->select('tabungan.*')
            ->select('anggota.nama_anggota')
            ->select('sampah.*')
            ->join('anggota', 'anggota.id_anggota = tabungan.id_anggota')
            ->join('sampah', 'sampah.id_sampah = tabungan.id_sampah')
            ->where('CAST(tabungan.created_at AS DATE) = CAST(CURDATE() AS DATE)')
            ->where('tabungan.id_anggota', $id)
            ->get()->getResultArray();
    }
    public function getSemuaTabunganbyID($id)
    {
        return $this->db->table('tabungan')
            ->select('tabungan.*')
            ->select('anggota.nama_anggota')
            ->select('sampah.*')
            ->join('anggota', 'anggota.id_anggota = tabungan.id_anggota')
            ->join('sampah', 'sampah.id_sampah = tabungan.id_sampah')

            ->where('tabungan.id_anggota', $id)


            ->get()->getResultArray();
    }

    public function getSemuaTabungan()
    {
        return $this->db->table('anggota')
            ->select('anggota.nama_anggota')
            ->select('akun_pengguna.username')
            ->select('tabungan.*')
            ->select('sampah.*')
            ->orderBy("created_at", "desc")
            ->join('tabungan', 'anggota.id_anggota = tabungan.id_anggota')
            ->join('akun_pengguna', 'anggota.id_pengguna = akun_pengguna.id')
            ->join('sampah', 'sampah.id_sampah = tabungan.id_sampah')
            ->get()->getResultArray();
    }

    public function getRekap()
    {
    }
    public function kirimDataTabungan($data_tabungan)
    {
        $data = [
            'jumlah_sampah' => $this->jumlah_sampah,
            'jumlah_tabungan' => $this->jumlah_tabungan,
            'id_anggota' => $this->get_pemilik_data(),
            'id_sampah' => $data_tabungan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->table('tabungan')
            ->insert($data);
    }



    //Penarikan
    public function getJumlahPenarikan($id)
    {
        return $this->db->table('penarikan')
            ->where('id_anggota', $id)
            ->get()->getResultArray();
    }

    public function getSemuaPenarikan()
    {
        return $this->db->table('anggota')
            ->select('anggota.nama_anggota')
            ->select('penarikan.*')
            ->select('akun_pengguna.username')
            ->orderBy("created_at", "desc")
            ->join('penarikan', 'anggota.id_anggota = penarikan.id_anggota')
            ->join('akun_pengguna', 'anggota.id_pengguna = akun_pengguna.id')
            ->get()->getResultArray();
    }

    public function getSemuaPenarikanbyID($id)
    {
        return $this->db->table('anggota')
            ->select('anggota.nama_anggota')
            ->select('penarikan.*')
            ->select('akun_pengguna.username')
            ->orderBy("created_at", "desc")
            ->join('penarikan', 'anggota.id_anggota = penarikan.id_anggota')
            ->join('akun_pengguna', 'anggota.id_pengguna = akun_pengguna.id')

            ->where('penarikan.id_anggota', $id)


            ->get()->getResultArray();
    }
    public function insertPenarikan()
    {
        $data = [
            'jumlah_penarikan' => $this->penarikan,
            'id_anggota' => $this->pemilik_data,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->table('penarikan')
            ->insert($data);
    }
}
