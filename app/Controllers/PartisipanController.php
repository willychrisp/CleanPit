<?php

namespace App\Controllers;

use App\Models\Volunteer;
use App\Models\Partisipan;
use App\Models\Laporan;

class PartisipanController extends BaseController
{
    public function __construct()
    {
        helper('form');

        $this->Volunteer = new Volunteer();
        $this->Partisipan = new Partisipan();
        $this->Laporan = new Laporan();
    }

    //Mendaftarkan diri sebagai partisipan
    public function index()
    {
        $id_pengguna = $this->request->uri->getSegment(3);
        $id_laporan = $this->request->uri->getSegment(2);
        $volunteer = $this->Volunteer->getDataVolunteerById($id_pengguna);
        $part = $this->Partisipan->cekIdPartisipan($volunteer['id_volunteer'], $id_laporan);
        $int = (int)$id_laporan;

        if (session()->get('id') == $id_pengguna) {
            if (count($part) > 0) {
                return redirect()->to('/partisipan/' . $int);
            } else {

                $this->Partisipan->set_nama_partisipan($volunteer['id_volunteer']);


                $this->Partisipan->set_laporan($id_laporan);
                $this->Partisipan->part($id_laporan);

                return redirect()->to('/partisipan/' . $int);
            }
        } else {
            echo "gabisa bor";
            return redirect()->to('/partisipan/' . $int);
        }
    }

    //melihat siapa saja partisipan yang pada suatu laporan tertentu
    public function lihatPartisipan()
    {
        $session = session()->get('role');
        $id_laporan = $this->request->uri->getSegment(2);
        $part = $this->Partisipan->getPartisipan($id_laporan);

        $pemilik = $this->Volunteer->getDataVolunteerByLaporan($id_laporan);


        $laporan = $this->Laporan->getLaporan($id_laporan, 1);



        $data = [
            'title' =>     'Bank Sampah Dampit bos',
            'isi'   =>      'v_volunteer/v_lihatPartisipanPage',
            'pemilik' => $pemilik,
            'partisipan' => $part,
            'laporan' => $laporan,
            'role' => $session
        ];
        if ($session == 1) {
            echo view('wrapper1', $data);
        } else if ($session == 3) {
            echo view('wrapper3', $data);
        }
    }
}
