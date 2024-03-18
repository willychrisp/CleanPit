<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//user routes
$routes->get('/', 'homeController', ['filter' => 'noauth']);
$routes->get('/laporan-user', 'laporanController', ['filter' => 'noauth']);
$routes->get('/semua-laporan-user', 'LaporanController::lihatSemuaLaporan', ['filter' => 'noauth']);
$routes->get('/login', 'AuthController', ['filter' => 'noauth']);
$routes->get('/register', 'AuthController::register', ['filter' => 'noauth']);

//volunteer 

$routes->get('/home', 'HomeController::volunteerHome', ['filter' => 'authfilter']);


$routes->get('/laporan-terkirim', 'LaporanController::lihatLaporanTerkirim', ['filter' => 'authfilter']);
$routes->get('/kiriman-laporan/(:any)', 'LaporanController::lihatLaporanOrang/$1', ['filter' => 'authfilter']);
$routes->get('/lapor', 'LaporanController', ['filter' => 'authfilter']);
$routes->get('/laporan', 'LaporanController::lihatSemuaLaporan', ['filter' => 'authfilter']);
$routes->get('/kirim', 'LaporanController::kirimLaporan', ['filter' => 'authfilter']);


$routes->get('/partisipasi/(:any)/(:any)', 'PartisipanController::index/$1/$2', ['filter' => 'authfilter']);
$routes->get('/partisipan/(:num)', 'PartisipanController::lihatPartisipan/$1', ['filter' => 'authfilter']);


$routes->get('/komunitas', 'KomunitasController', ['filter' => 'authfilter']);
$routes->get('/gabung-komunitas/(:num)', 'KomunitasController::DaftarKomunitas/$1', ['filter' => 'authfilter']);
$routes->get('/detail-komunitas/(:any)', 'KomunitasController::detailKomunitas/$1', ['filter' => 'authfilter']);
$routes->get('/profilPendiri/(:any)', 'KomunitasController::ProfilPendiri/$2', ['filter' => 'authfilter']);
$routes->get('/buat-komunitas', 'KomunitasController::buatKomunitas', ['filter' => 'authfilter']);
$routes->get('/listAnggota/(:any)', 'KomunitasController::daftarAnggotaKomunitas/$1', ['filter' => 'authfilter']);
$routes->get('/komunitas-saya', 'KomunitasController::komunitasSaya', ['filter' => 'authfilter']);


$routes->get('/profil', 'ProfilController', ['filter' => 'authfilter']);
$routes->get('/gantiFoto', 'ProfilController::gantiFotoPage', ['filter' => 'authfilter']);
$routes->get('/updateDataDiri', 'ProfilController::updateDataDiriPage', ['filter' => 'authfilter']);


//Anggota

$routes->get('/home-anggota', 'HomeController::AnggotaHome', ['filter' => 'anggotaauth']);
$routes->get('/home-bank-anggota', 'HomeController::AnggotaHomeBank', ['filter' => 'anggotaauth']);
$routes->get('/buku-tabungan-anggota', 'ProsesBankController::bukuTabunganAnggota', ['filter' => 'anggotaauth']);
$routes->get('/harga-sampah', 'ProsesBankController::hargaSampahP', ['filter' => 'anggotaauth']);
$routes->get('/profil-anggota', 'ProfilController::profilAnggota', ['filter' => 'anggotaauth']);
$routes->get('/riwayat-anggota', 'TabunganController::riwayatTabunganAnggota', ['filter' => 'anggotaauth']);
$routes->get('/produk-anggota', 'ProdukController', ['filter' => 'anggotaauth']);
$routes->get('/detail-produk/(:any)', 'ProdukController::bukaDetailProduk/$1', ['filter' => 'anggotaauth']);
$routes->get('/anggota-ubah-password', 'ProfilController::ubahPasswordPage', ['filter' => 'anggotaauth']);
$routes->get('/laporan-anggota', 'laporanController', ['filter' => 'anggotaauth']);
$routes->get('/semua-laporan-anggota', 'LaporanController::lihatSemuaLaporan', ['filter' => 'anggotaauth']);


//Petugas
$routes->get('/home-petugas', 'HomeController::AnggotaHome', ['filter' => 'petugasauth']);
$routes->get('/home-bank-petugas', 'HomeController::PetugasHomeBank', ['filter' => 'petugasauth']);
$routes->get('/isi_tabungan-petugas', 'ProsesBankController', ['filter' => 'petugasauth']);
$routes->get('/rekap', 'ProsesBankController::rekap', ['filter' => 'petugasauth']);

$routes->get('/input_tabungan-petugas/(:any)', 'ProsesBankController::inputTabungan/$1', ['filter' => 'petugasauth']);
$routes->get('/data-tabungan', 'TabunganController', ['filter' => 'petugasauth']);
$routes->get('/buku-tabungan/(:any)', 'ProsesBankController::bukuTabungan/$1', ['filter' => 'petugasauth']);
$routes->get('/riwayat-tabungan', 'TabunganController::riwayatTabungan', ['filter' => 'petugasauth']);

$routes->get('/produk-petugas', 'ProdukController', ['filter' => 'petugasauth']);
$routes->get('/kirim-produk', 'ProdukController::inputProduk', ['filter' => 'petugasauth']);
$routes->get('/detail-produk/(:any)', 'ProdukController::bukaDetailProduk/$1', ['filter' => 'petugasauth']);

$routes->get('/anggota-bs', 'ProsesBankController::anggota_bs', ['filter' => 'petugasauth']);
$routes->get('/tambah-anggota', 'ProsesBankController::tambahAnggota', ['filter' => 'petugasauth']);

$routes->get('/harga-sampah-page', 'ProsesBankController::hargaSampahP', ['filter' => 'petugasauth']);
$routes->get('/manage-sampah', 'ProsesBankController::hargaSampahPage', ['filter' => 'petugasauth']);

$routes->get('/laporan-petugas', 'laporanController', ['filter' => 'petugasauth']);
$routes->get('/semua-laporan-petugas', 'LaporanController::lihatSemuaLaporan', ['filter' => 'petugasauth']);

$routes->get('/partisipan-petugas/(:num)', 'PartisipanController::lihatPartisipan/$1', ['filter' => 'petugasauth']);




//Admin
$routes->get('/home-anggota', 'HomeController::AnggotaHome', ['filter' => 'anggotaauth']);
$routes->get('/home-admin', 'HomeController::AdminHome', ['filter' => 'adminauth']);
$routes->get('/verifikasi-laporan', 'VerifikasiController::laporanPage', ['filter' => 'adminauth']);
$routes->get('/verifikasi-pengguna', 'VerifikasiController::volunteerPage', ['filter' => 'adminauth']);
$routes->get('/verifikasi/(:any)/(:any)', 'VerifikasiController::verifikasiLaporan/$1/$2', ['filter' => 'adminauth']);
$routes->get('/verifPengguna/(:any)/(:any)', 'VerifikasiController::verifikasiPengguna/$1/$2', ['filter' => 'adminauth']);



//$routes->post('/lapor', 'c_laporlingkungan');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
