<?php

namespace App\Models;

use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;
use App\Models\Laporan;
use CodeIgniter\Test\FeatureTestCase;

class sendLaporanTest extends FeatureTestCase
{

    use ControllerTestTrait, DatabaseTestTrait;
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
    public function testFooNotBar()
    {
        $_SESSION['id'] = "3";
        $_POST["nama"] = 'Banjir';
        $_POST["tanggal"] = '1212-12-12';
        $_POST["lokasi"] = "Dampit Pusat";
        $_POST["wilayah"] = "kepatihan";
        $_POST["objek"] = "pasar kobong";
        $_POST["wilayah"] = "kepatihan";
        $_POST["jumlah"] = "12";
        $_POST["foto"] = "12.jpg";

        $results = $this->controller(\App\Controllers\LaporanController::class)
            ->execute('kirimLaporan');
        $results->assertRedirectTo('/home');
    }
    public function verifLaporanTest()
    {
        $results = $this->withURI('http://example.com/1/2')
            ->controller(\App\Controllers\LaporanController::class)
            ->execute('kirimLaporan');
        $results->assertRedirectTo('/verifikasi-laporan');
    }
}
