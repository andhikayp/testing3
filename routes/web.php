<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'AuthController@home');
Route::post('/login', 'AuthController@login');

Route::middleware(['auth'])->group(function () {
	Route::get('/dashboard', 'DashboardController@index');
	Route::get('/logout', 'AuthController@logout');

	//siswa
	Route::get('/ajax/datatables/siswa/{param}/{id}', 'SiswaController@ajaxSiswa');
	Route::get('/siswa/{id}', 'SiswaController@siswa');
	Route::get('/ajax/grafik/siswa/{id}', 'SiswaController@ajaxSiswaGrafik');

	//ujian
	Route::get('/ujian', 'UjianController@index');
	Route::get('/ajax/datatables/ujian', 'UjianController@ajaxUjian');
	Route::get('/json/ujian', 'UjianController@jsonUjian');
	Route::get('/ujian/tambah', 'UjianController@tambahUjian');
	Route::post('/ujian/save/', 'UjianController@saveUjian');
	Route::get('/ajax/datatables/ujian/{id}', 'UjianController@ajaxUjianTanggal');

	//soal
	Route::get('/soal', 'SoalController@index');
	Route::get('/soal/cetak/{id}', 'SoalController@cetak');
	Route::get('/ajax/datatables/pelajaran','SoalController@ajaxPelajaran');
	Route::get('/ajax/datatables/paket/{id}','SoalController@ajaxPaket');
	Route::get('/paket/{id}', 'SoalController@paket');
	Route::get('/ajax/datatables/soal/{id}','SoalController@ajaxSoal');
	Route::get('/ajax/grafik/soal/analisis_butir_soal/{paket_id}','SoalController@getAnalisisButirSoal');
	Route::get('/ajax/grafik/soal/analisis_butir_soal_all/{paket_id}','SoalController@getAllAnalisis');

	//peringkat
	Route::get('/peringkat', 'PeringkatController@index');
	Route::get('/ajax/peringkat_kota/{id}', 'PeringkatController@ajax_peringkat_kota');
	Route::get('/ajax/peringkat_sekolah/{id}', 'PeringkatController@ajax_peringkat_sekolah');
	Route::get('/ajax/sebaran_peringkat_sekolah/{id}', 'PeringkatController@ajax_sebaran_peringkat_sekolah');
	Route::get('/ajax/get_rank_siswa/{id}/{kurikulum}', 'PeringkatController@get_rank_siswa');
	Route::get('/ajax/get_rank_siswa_individu/{pelajaran_id}', 'PeringkatController@get_rank_pelajaran');

	//nilai
	Route::get('/nilai', 'NilaiController@index');
	Route::get('/nilai/capaian_nasional', 'NilaiController@capaian_nasional');
	Route::get('/nilai/{id}', 'NilaiController@nilai');
	Route::get('/nilai/{sekolah}/{id}', 'NilaiController@nilai_individu');
	Route::get('/nilai/soal/{mapel}/{id}', 'NilaiController@soal_individu');
	Route::get('/ajax/grafik/nilai_siswa/{id}', 'NilaiController@ajaxNilaiSiswa');
	Route::get('/ajax/rata2_paket/{pelajaran_id}', 'NilaiController@ajax_rata2_paket');
	Route::get('/ajax/pelajaran/{kurikulum_id}', 'NilaiController@ajax_get_pelajaran');
	Route::get('/ajax/get_detail_paket/{pelajaran_id}', 'NilaiController@ajax_get_detail_paket');

	Route::middleware(['admin'])->group(function () {
		//siswa
		Route::get('/siswa', 'SiswaController@index');
		Route::get('/ajax/datatables/siswa', 'SiswaController@ajaxIndex');
		Route::get('/ajax/datatables/sekolah/{param}/{id}', 'SiswaController@ajaxSekolah');

		//dashboard
		Route::get('/count_ujian', 'UjianController@ajaxCountUjian');

		//bank_soal
		Route::get('/bank_soal', 'BankSoalController@index');
		Route::get('/ajax/datatables/pelajaran/action','SoalController@ajaxPelajaranWithAction');
		Route::get('/bank_soal/{pelajaran_id}', 'BankSoalController@view_bank_soal');
		Route::get('/ajax/bank_soal/{ket}/{pelajaran_id}', 'BankSoalController@ajax_bank_soal');
	});
	Route::middleware(['siswa'])->group(function () {
		
	});
	Route::middleware(['admin', 'sekolah'])->group(function () {

	});
});


Route::get('/test', 'AuthController@testing_auth');
Route::get('/wkwk', function () {
    return view('dashboard.index');
});
Route::get('/pelajaran', 'UserController@pelajaran');
Route::get('/admindt', 'UserController@admindt');
Route::get('/testing_db', 'UserController@testing_db');
