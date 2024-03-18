<?php

namespace App\Models;

use CodeIgniter\Model;

class Komunitas extends Model
{
    private $nama_komunitas, $tanggal_berdiri, $nomor_kontak, $status_komunitas, $biodata_komunitas, $pendiri_komunitas;

    public function set_nama_komnitas($nama_komunitas)
    {
        $this->nama_komunitas = $nama_komunitas;
    }
    public function get_nama_komunitas()
    {
        return $this->nama_komunitas;
    }
    public function set_tanggal_berdiri($tanggal_berdiri)
    {
        $this->tanggal_berdiri = $tanggal_berdiri;
    }
    public function get_tanggal_berdiri()
    {
        return $this->tanggal_berdiri;
    }
    public function set_nomor_kontak($nomor_kontak)
    {
        $this->nomor_kontak = $nomor_kontak;
    }
    public function get_nomor_kontak()
    {
        return $this->nomor_kontak;
    }
    public function set_status_komnitas($status_komunitas)
    {
        $this->status_komunitas = $status_komunitas;
    }
    public function get_status_komunitas()
    {
        return $this->status_komunitas;
    }
    public function set_biodata_komnitas($biodata_komunitas)
    {
        $this->biodata_komunitas = $biodata_komunitas;
    }
    public function get_biodata_komunitas()
    {
        return $this->biodata_komunitas;
    }
    public function set_pendiri_komunitas($pendiri_komunitas)
    {
        $this->pendiri_komunitas = $pendiri_komunitas;
    }
    public function get_pendiri_komunitas()
    {
        return $this->pendiri_komunitas;
    }

    public function getKomunitas($id_komunitas)
    {
        return $this->db->table('komunitas')
            ->select('komunitas.*')
            ->select('volunteer.nama_volunteer')
            ->join('volunteer', 'komunitas.pendiri=volunteer.id_volunteer')
            ->where('komunitas.id_komunitas', $id_komunitas)
            ->get()->getRowArray();
    }
    public function getSemuaKomunitas()
    {
        return $this->db->table('Komunitas')
            ->orderBy("created_at", "desc")
            ->get()->getResultArray();
    }

    public function getVolunteerKomunitas($id)
    {
        return $this->db->table('volunteer')
            ->select('id_komunitas')
            ->where('id_pengguna', $id)
            ->get()->getRowArray();
    }
    public function buatKomunitas()
    {

        $data = [
            'nama_komunitas' => $this->nama_komunitas,
            'tanggal_berdiri' => $this->tanggal_berdiri,
            'nomor_kontak' => $this->nomor_kontak,
            'bio_komunitas' => $this->biodata_komunitas,
            'pendiri' => $this->pendiri_komunitas,
            'status' => "0",
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->table('komunitas')
            ->insert($data);
    }
    public function pemilikKomunitas($id_volunteer, $id_komunitas)
    {
        $dataVol = [
            'id_komunitas' => $id_komunitas
        ];
        $this->db->table('volunteer')
            ->where('id_volunteer', $id_volunteer)
            ->update($dataVol);
    }
}
