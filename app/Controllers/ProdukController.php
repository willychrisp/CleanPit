<?php

namespace App\Controllers;

use App\Models\Produk;

class ProdukController extends BaseController
{


    public function index()
    {
        $produk = new Produk();
        $barang = $produk->getSemuaProduk();
        $session = session()->get('role');
        $data = [
            'title' =>     'Bank Sampah Dampit || Produk',
            'isi'   =>      'v_petugas/produk_petugas',
            'barang'  => $barang,
            'role' => $session
        ];
        if ($session == 3) {
            echo view('wrapper-petugas', $data);
        } else {
            echo view('wrapper-anggota', $data);
        }
    }

    public function inputProduk()
    {
        $data = [

            'title' => 'Bank Sampah Dampit || Kirimkan Produk',
            'isi' => 'v_petugas/kirim_produk'
        ];
        echo view('wrapper-petugas', $data);
    }

    public function kirimProduk()
    {
        $produk = new Produk();
        $fileFoto = $this->request->getFile('foto');
        $fileFoto->move('img/data_produk/foto_produk');
        $namaFoto = $fileFoto->getName();
        //dd($fileFoto);
        $produk->set_nama_produk($this->request->getVar('nama'));
        $produk->set_detail_produk($this->request->getVar('detail'));
        $produk->set_bahan_produk($this->request->getVar('bahan'));
        $produk->set_kontak_pemilik($this->request->getVar('kontak'));
        $produk->set_foto_produk($namaFoto);

        $kirim = $produk->inputMasukkanProduk();
        if ($kirim == true) {
            return redirect()->to('/produk-petugas');
        } else {
            return redirect()->to('/produk-petugas');
        }
    }

    public function bukaDetailProduk($id_produk)
    {
        $session = session()->get('role');
        $produk = new Produk();
        $barang = $produk->getProdukbyID($id_produk);
        $data = [
            'title' =>     'Bank Sampah Dampit || Produk',
            'isi'   =>      'v_petugas/detail_produk_petugas',
            'produk'  => $barang
        ];
        if ($session == 3) {
            echo view('wrapper-petugas', $data);
        } else {
            echo view('wrapper-anggota', $data);
        }
    }
}
