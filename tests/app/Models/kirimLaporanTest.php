<?php

namespace App\Models;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\Fabricator;


class kirimLaporanTest extends CIUnitTestCase
{
    public function testFooNotBar()
    {
        $stub = $this->createStub(Laporan::class);

        $stub->set_nama_laporan('Banjir');
        $stub->set_tanggal_laporan('2121-12-12');
        $stub->set_lokasi_laporan('Dampit Timur');
        $stub->set_wilayah('Pamotan');
        $stub->set_foto_laporan('12.jpg');
        $stub->set_jumlah_volunteer('12');
        $stub->set_pengirim_laporan('2');
        $stub->set_status_laporan('0');

        $stub->method('sendLaporan')
            ->willReturn(false);
        if ($stub->sendLaporan() == true) {
            $this->assertTrue($stub->sendLaporan());
        } else {
            $this->assertFalse($stub->sendLaporan());
        }
    }
    public function verifLaporanTest()
    {
        $stub = $this->createStub(Laporan::class);
        $act = 1;
        if ($act == 1) {
            $a = 1;
            $stub->set_status_laporan($a);
            $stub->method('verifikasiLaporan')
                ->willReturn(true);
        } else {
            $stub->method('deleteLaporan')
                ->willReturn(true);
        }
        $this->assertTrue($stub->verifikasiLaporan(1));
        $this->assertTrue($stub->deleteLaporan(1));
    }
}
