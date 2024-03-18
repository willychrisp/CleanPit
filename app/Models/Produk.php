<?php

namespace App\Models;

use CodeIgniter\Model;

class Produk extends Model
{
    private string $nama_produk, $detail_produk, $bahan_produk, $foto_produk, $kontak;
    public function set_nama_produk($nama_produk)
    {
        $this->nama_produk = $nama_produk;
    }
    public function get_nama_produk()
    {
        return $this->nama_produk;
    }
    public function set_detail_produk($detail_produk)
    {
        $this->detail_produk = $detail_produk;
    }
    public function get_detail_produk()
    {
        return $this->detail_produk;
    }
    public function set_bahan_produk($bahan_produk)
    {
        $this->bahan_produk = $bahan_produk;
    }
    public function get_bahan_produk()
    {
        return $this->bahan_produk;
    }
    public function set_foto_produk($foto_produk)
    {
        $this->foto_produk = $foto_produk;
    }
    public function get_foto_produk()
    {
        return $this->foto_produk;
    }
    public function set_kontak_pemilik($kontak)
    {
        $this->kontak = $kontak;
    }
    public function get_kontak_pemilik()
    {
        return $this->kontak;
    }
    public function inputMasukkanProduk()
    {
        $data = [
            'nama_produk' => $this->nama_produk,
            'detail_produk' => $this->detail_produk,
            'bahan_produk' => $this->bahan_produk,
            'foto_produk' => $this->foto_produk,
            'kontak_pemilik' => $this->kontak,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $insert = $this->db->table('produk')->insert($data);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }
    public function getSemuaProduk()
    {
        return $this->db->table('produk')
            ->orderBy("created_at", "desc")
            ->get()->getResultArray();
    }
    public function getProdukbyID($id_produk)
    {
        return $this->db->table('produk')
            ->where('id_produk', $id_produk)
            ->get()->getRowArray();
    }
}
