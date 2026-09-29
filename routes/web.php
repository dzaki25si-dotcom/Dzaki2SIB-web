<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MahasiswaController;

use App\Http\Controllers\MatakuliahController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\QuestionController;

use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/Zaki',function(){
    return 'Halo Zaki';
});

Route::get('/{param1}/{param2}/Zaki',function(){
    return 'Halo Zaki';
});

Route::get('/{param1}/nama/', function ($param1) {
    if($param1 == 'Zaki')
        return 'Rahman';
    else
        return 'Nama saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [App\Http\Controllers\MahasiswaController::class, 'show']);

Route::get('/matakuliah/index', [MatakuliahController::class, 'index']);
Route::get('/matakuliah/create', [MatakuliahController::class, 'create']);
Route::get('/matakuliah/store', [MatakuliahController::class, 'store']);
Route::get('/matakuliah/show/{id?}', [MatakuliahController::class, 'show']);
Route::get('/matakuliah/edit/{id}', [MatakuliahController::class, 'edit']);
Route::get('/matakuliah/update/{id}', [MatakuliahController::class, 'update']);
Route::get('/matakuliah/destroy/{id}', [MatakuliahController::class, 'destroy']);

Route::get('/home', [HomeController::class, 'index']);

Route::post('question/store', [QuestionController::class, 'store'])
		->name('question.store');

Route::get('question', [QuestionController::class,'index'])->name('question.index');

Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
