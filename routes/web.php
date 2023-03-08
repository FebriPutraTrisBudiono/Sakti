<?php

use App\Models\RegistrationFee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogapiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\BackEnd\BankController;
use App\Http\Controllers\BackEnd\MenuController;
use App\Http\Controllers\BackEnd\PageController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\BackEnd\AboutController;
use App\Http\Controllers\BackEnd\LevelController;
use App\Http\Controllers\BackEnd\LoginController;
use App\Http\Controllers\FrontEnd\HomeController;
use App\Http\Controllers\BackEnd\ClientController;
use App\Http\Controllers\BackEnd\SliderController;
use App\Http\Controllers\ListpermohonanController;
use App\Http\Controllers\BackEnd\PaymentController;
use App\Http\Controllers\BackEnd\ProfileController;
use App\Http\Controllers\BackEnd\SectionController;
use App\Http\Controllers\BackEnd\ServiceController;
use App\Http\Controllers\BackEnd\SettingController;
use App\Http\Controllers\BackEnd\CKEditorController;
use App\Http\Controllers\FrontEnd\ContactController;
use App\Http\Controllers\BackEnd\OurserviceController;
use App\Http\Controllers\BackEnd\KajianclientController;
use App\Http\Controllers\BackEnd\RencanaauditController;
use App\Http\Controllers\BackEnd\RencanaclientController;
use App\Http\Controllers\Stage2temuanverifcationController;
use App\Http\Controllers\BackEnd\RegistrationFeeController;
use App\Http\Controllers\BackEnd\PerjanjianclientController;
use App\Http\Controllers\BackEnd\Stage1checkauditController;
use App\Http\Controllers\BackEnd\Stage2checkauditController;
use App\Http\Controllers\MemopenerbitansertifikasiController;
use App\Http\Controllers\BackEnd\Stage2laporanauditController;
use App\Http\Controllers\BackEnd\Stage2rencanaauditController;
use App\Http\Controllers\BackEnd\Stage1kajiantimauditController;
use App\Http\Controllers\Stage2surveikepuasancustomerController;
use App\Http\Controllers\BackEnd\Stage2daftarhadirauditController;
use App\Http\Controllers\BackEnd\Stage1penunjukantimauditController;
use App\Http\Controllers\BackEnd\Stage2ketidaksesuaianpageController;
use App\Http\Controllers\BackEnd\ReviewkeputusansertifikasiController;
use App\Http\Controllers\EvaluasisatusiklussertifikasiController;
use App\Http\Controllers\FrontEnd\PageController as FrontEndPageController;
use App\Http\Controllers\FrontEnd\TrackingController;
use App\Http\Controllers\LognotifikasiexpiredController;
use App\Http\Controllers\PenerbitansertifikatController;
use App\Http\Controllers\PermohonansertifikasiController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/tracking', [TrackingController::class, 'index']);
Route::get('/tracking/show', [TrackingController::class, 'show']);
Route::get('/tracking/show/{client:id}', [TrackingController::class, 'listpermohonan']);
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact/sendmessage', [ContactController::class, 'sendmessage']);
Route::get('/pages/{page:slug}', [FrontEndPageController::class, 'show']);

// LOGAPI
Route::get('/dashboard/clientsapi/{id}', [LogapiController::class, 'show']);
Route::get('/dashboard/statusapi/{id}/{statusid}', [LogapiController::class, 'status']);
Route::get('/dashboard/logsapi/{id}/{logid}', [LogapiController::class, 'log']);
Route::get('/dashboard/logsclientapi/{id}/{logid}', [LogapiController::class, 'clientlog']);
// Route::get('/notifikasiexpired', [PenerbitansertifikatController::class, 'notifikasiexpired']);
// Route::get('/dashboardnotifikasiexpired', [DashboardController::class, 'notifikasiexpired']);

Route::get('/dashboard/notifikasiexpired', [LognotifikasiexpiredController::class, 'lognotifikasiexpired']);

Route::get('/dashboard/lognotifikasiexpireds', [LognotifikasiexpiredController::class, 'index'])->name('Log Notifikasi Expired.index');

Route::middleware(['guest'])->group(function () {
    Route::get('/auth', [LoginController::class, 'index'])->name('login');
    Route::post('/auth', [LoginController::class, 'login']);
    Route::get('/auth/registration', [LoginController::class, 'registration'])->name('registration.form');
    Route::post('/auth/registration', [LoginController::class, 'store'])->name('registration.store');
    Route::get('/auth/forgot', [LoginController::class, 'forgot']);
    Route::post('/auth/forgot', [LoginController::class, 'reset']);
    Route::get('/auth/newpassword', [LoginController::class, 'newpassword']);
    Route::put('/auth/newpassword/{user:username}', [LoginController::class, 'update']);
    Route::get('/users/username', [UserController::class, 'createUsername']);
    Route::get('/payment/confirmation/{user:id}', [LoginController::class, 'confirmation']);
    Route::get('/payment/confirmation/{user:id}', [LoginController::class, 'confirmation']);
    Route::post('/payment/confirmation/{user:id}', [LoginController::class, 'confirmed']);
    Route::put('/payment/confirmation/{user:id}', [LoginController::class, 'confirmupdate']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/auth/logout', [LoginController::class, 'logout']);
    Route::get('/create/users/username', [UserController::class, 'createUsername']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('clients.index');
    Route::get('/dashboard/profile', [ProfileController::class, 'index']);
    Route::post('/dashboard/profile/{user:username}', [ProfileController::class, 'update']);
    Route::post('/ckeditor/upload', [CKEditorController::class, 'upload'])->name('image-upload');

    Route::get('/dashboard/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::delete('/dashboard/clientshows/{listpermohonan:id}', [ClientController::class, 'deleteproses'])->name('clients.destroyprosessertifikasi');

    Route::put('/dashboard/clients/confirmation/{client:id}', [ClientController::class, 'confirmation']);
    Route::get('/dashboard/clients/{id}', [ClientController::class, 'showconfirmation']);
    Route::delete('/dashboard/clients/{client:id}', [ClientController::class, 'destroy']);

    Route::get('/dashboard/stage2kajiantimaudits/{client:id}/{id}/edit', [Stage1kajiantimauditController::class, 'edit']);
    Route::get('/dashboard/stage2penunjukantimaudits/{client:id}/{id}/edit', [Stage1penunjukantimauditController::class, 'edit']);

    Route::delete('/dashboard/stage2daftarhadiraudits/{id}', [Stage2daftarhadirauditController::class, 'destroy']);
    Route::delete('/dashboard/stage2rencanaaudits/{id}', [Stage2rencanaauditController::class, 'destroy']);

    Route::put('/dashboard/penerbitansertifikatsvalidasi/{client:id}/{id}', [PenerbitansertifikatController::class, 'updatevalidasi']);

    Route::post('/dashboard/listpermohonans', [ListpermohonanController::class, 'store']);
    Route::post('/dashboard/client', [ClientController::class, 'store']);

    Route::get('/dashboard/document/download/{client:id}/{id}', [ListpermohonanController::class, 'document']);

    Route::middleware(['auth', 'roles'])->group(function () {
        Route::get('/dashboard/client/{client:id}', [ClientController::class, 'show'])->name('clients.prosessertifikasi');

        Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/dashboard/users/{user:id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/dashboard/users/{user:id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/dashboard/users/{user:id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/dashboard/levels', [LevelController::class, 'index'])->name('levels.index');
        Route::post('/dashboard/levels', [LevelController::class, 'store'])->name('levels.store');
        Route::get('/dashboard/levels/{level:id}/edit', [LevelController::class, 'edit'])->name('levels.edit');
        Route::put('/dashboard/levels/{level:id}', [LevelController::class, 'update'])->name('levels.update');
        Route::delete('/dashboard/levels/{level:id}', [LevelController::class, 'destroy'])->name('levels.destroy');

        Route::get('/dashboard/banks', [BankController::class, 'index'])->name('banks.index');
        Route::post('/dashboard/banks', [BankController::class, 'store'])->name('banks.store');
        Route::get('/dashboard/banks/{bank:id}', [BankController::class, 'show'])->name('banks.show');
        Route::put('/dashboard/banks/{bank:id}', [BankController::class, 'update'])->name('banks.update');
        Route::delete('/dashboard/banks/{bank:id}', [BankController::class, 'destroy'])->name('banks.destroy');

        Route::get('/dashboard/registrationfees', [RegistrationFeeController::class, 'index'])->name('registrationfees.index');
        Route::post('/dashboard/registrationfees', [RegistrationFeeController::class, 'store'])->name('registrationfees.store');
        Route::get('/dashboard/registrationfees/{registrationfee:id}', [RegistrationFeeController::class, 'show'])->name('registrationfees.show');
        Route::put('/dashboard/registrationfees/{registrationfee:id}', [RegistrationFeeController::class, 'update'])->name('registrationfees.update');
        Route::delete('/dashboard/registrationfees/{registrationfee:id}', [RegistrationFeeController::class, 'destroy'])->name('registrationfees.destroy');

        Route::get('/dashboard/services', [ServiceController::class, 'index'])->name('services.index');
        Route::post('/dashboard/services', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/dashboard/services/{service:id}', [ServiceController::class, 'show'])->name('services.show');
        Route::put('/dashboard/services/{service:id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/dashboard/services/{service:id}', [ServiceController::class, 'destroy'])->name('services.destroy');

        // Route::get('/dashboard/about', [AboutController::class, 'index'])->name('about.index');

        Route::get('/dashboard/sections', [SectionController::class, 'index'])->name('sections.index');
        Route::get('/dashboard/sections/{section:id}', [SectionController::class, 'show'])->name('sections.show');
        Route::put('/dashboard/sections/{section:id}', [SectionController::class, 'update'])->name('sections.update');

        Route::get('/dashboard/menus', [MenuController::class, 'index'])->name('menus.index');
        Route::post('/dashboard/menus', [MenuController::class, 'store'])->name('menus.store');
        Route::get('/dashboard/menus/{menu:id}', [MenuController::class, 'show'])->name('menus.show');
        Route::put('/dashboard/menus/{menu:id}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/dashboard/menus/{menu:id}', [MenuController::class, 'destroy'])->name('menus.destroy');

        Route::get('/dashboard/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/dashboard/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/dashboard/sliders', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/dashboard/sliders/{slider:id}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/dashboard/sliders/{slider:id}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/dashboard/sliders/{slider:id}', [SliderController::class, 'destroy'])->name('sliders.destroy');

        Route::get('/dashboard/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/dashboard/settings/{setting:id}', [SettingController::class, 'show'])->name('settings.show');
        Route::put('/dashboard/settings/{setting:id}', [SettingController::class, 'update'])->name('settings.update');

        Route::get('/dashboard/payments', [PaymentController::class, 'index'])->name('pembayaran.index');
        Route::get('/dashboard/payments/{id}', [PaymentController::class, 'show'])->name('pembayaran.show');
        Route::put('/dashboard/payments/confirmation/{payment:id}', [PaymentController::class, 'confirmation'])->name('pembayaran.confirmation');
        Route::delete('/dashboard/payments/{payment:id}', [PaymentController::class, 'destroy'])->name('pembayaran.destroy');

        Route::get('/dashboard/pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('/dashboard/pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('/dashboard/pages', [PageController::class, 'store'])->name('pages.store');
        Route::get('/dashboard/pages/{page:id}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('/dashboard/pages/{page:id}', [PageController::class, 'update'])->name('pages.update');
        Route::delete('/dashboard/pages/{page:id}', [PageController::class, 'destroy'])->name('pages.destroy');
        Route::post('/dashboard/pages/upload', [PageController::class, 'upload'])->name('pages.upload');

        Route::get('/dashboard/permohonansertifikasis/{client:id}/{id}/edit', [PermohonansertifikasiController::class, 'edit'])->name('F-CER-01 - Daftar Isian Permohon.view');
        Route::post('/dashboard/permohonansertifikasis', [PermohonansertifikasiController::class, 'store'])->name('F-CER-01 - Daftar Isian Permohon.store');
        Route::put('/dashboard/permohonansertifikasis/{client:id}/{id}', [PermohonansertifikasiController::class, 'update'])->name('F-CER-01 - Daftar Isian Permohon.update');
        Route::get('/dashboard/permohonansertifikasi/download/{permohonansertifikasi:id}', [PermohonansertifikasiController::class, 'download'])->name('F-CER-01 - Daftar Isian Permohon.download');
        Route::put('/dashboard/permohonanclientsvalidasi/{client:id}/{id}', [PermohonansertifikasiController::class, 'updatevalidasi'])->name('F-CER-01 - Daftar Isian Permohon.validasi');

        Route::get('/dashboard/kajianclients/{client:id}/{id}/edit', [KajianclientController::class, 'edit'])->name('F-CER-02 - Kajian Permohon.view');
        Route::post('/dashboard/kajianclients', [KajianclientController::class, 'store'])->name('F-CER-02 - Kajian Permohon.store');
        Route::put('/dashboard/kajianclients/{client:id}/{id}', [KajianclientController::class, 'update'])->name('F-CER-02 - Kajian Permohon.update');
        Route::get('/dashboard/kajianpermohonan/download/{kajianclient:id}', [KajianclientController::class, 'download'])->name('F-CER-02 - Kajian Permohon.download');
        Route::put('/dashboard/kajianclientsvalidasi/{client:id}/{id}', [KajianclientController::class, 'updatevalidasi'])->name('F-CER-02 - Kajian Permohon.validasi');

        Route::get('/dashboard/perjanjianclients/{client:id}/{id}/edit', [PerjanjianclientController::class, 'edit'])->name('DOC-CER-01 - Kontrak Sertifikasi.view');
        Route::get('/dashboard/perjanjiansertifikasi/download/{kajianclient:id}', [PerjanjianclientController::class, 'download'])->name('DOC-CER-01 - Kontrak Sertifikasi.download');
        Route::post('/dashboard/perjanjiansertifikasi/', [PerjanjianclientController::class, 'store'])->name('DOC-CER-01 - Kontrak Sertifikasi.store');
        Route::put('/dashboard/perjanjiansertifikasi/{client:id}/{id}', [PerjanjianclientController::class, 'update'])->name('DOC-CER-01 - Kontrak Sertifikasi.update');
        Route::put('/dashboard/perjanjianclientsvalidasi/{client:id}/{id}', [PerjanjianclientController::class, 'updatevalidasi'])->name('DOC-CER-01 - Kontrak Sertifikasi.validasi');

        Route::get('/dashboard/rencanaclients/{client:id}/{id}/edit', [RencanaclientController::class, 'edit'])->name('F-CER-03 - Rencana Siklus Sertifikasi.view');
        Route::post('/dashboard/rencanaclients', [RencanaclientController::class, 'store'])->name('F-CER-03 - Rencana Siklus Sertifikasi.store');
        Route::put('/dashboard/rencanaclients/{client:id}/{id}', [RencanaclientController::class, 'update'])->name('F-CER-03 - Rencana Siklus Sertifikasi.update');
        Route::get('/dashboard/rencanaclients/download/{rencanaclient:id}', [RencanaclientController::class, 'download'])->name('F-CER-03 - Rencana Siklus Sertifikasi.download');
        Route::put('/dashboard/rencanaclientsvalidasi/{client:id}/{id}', [RencanaclientController::class, 'updatevalidasi'])->name('F-CER-03 - Rencana Siklus Sertifikasi.validasi');

        Route::get('/dashboard/stage1kajiantimaudits/{client:id}/{id}/edit', [Stage1kajiantimauditController::class, 'edit'])->name('F-CER-39 - Kajian Tim Audit.view');
        Route::post('/dashboard/stage1kajiantimaudits', [Stage1kajiantimauditController::class, 'store'])->name('F-CER-39 - Kajian Tim Audit.store');
        Route::put('/dashboard/stage1kajiantimaudits/{client:id}/{id}', [Stage1kajiantimauditController::class, 'update'])->name('F-CER-39 - Kajian Tim Audit.update');
        Route::get('/dashboard/stage1kajiantimaudits/download/{stage1kajiantimaudit:id}', [Stage1kajiantimauditController::class, 'download'])->name('F-CER-39 - Kajian Tim Audit.download');
        Route::put('/dashboard/stage1kajiantimauditsvalidasi/{client:id}/{id}', [Stage1kajiantimauditController::class, 'updatevalidasi'])->name('F-CER-39 - Kajian Tim Audit.validasi');

        Route::get('/dashboard/stage1penunjukantimaudits/{client:id}/{id}/edit', [Stage1penunjukantimauditController::class, 'edit'])->name('F-CER-04 - Penunjukan Tim Audit.view');
        Route::post('/dashboard/stage1penunjukantimaudits', [Stage1penunjukantimauditController::class, 'store'])->name('F-CER-04 - Penunjukan Tim Audit.store');
        Route::put('/dashboard/stage1penunjukantimaudits/{client:id}/{id}', [Stage1penunjukantimauditController::class, 'update'])->name('F-CER-04 - Penunjukan Tim Audit.update');
        Route::get('/dashboard/stage1penunjukantimaudits/download/{stage1penunjukantimaudit:id}', [Stage1penunjukantimauditController::class, 'download'])->name('F-CER-04 - Penunjukan Tim Audit.download');
        Route::put('/dashboard/stage1penunjukantimauditsvalidasi/{client:id}/{id}', [Stage1penunjukantimauditController::class, 'updatevalidasi'])->name('F-CER-04 - Penunjukan Tim Audit.validasi');

        Route::get('/dashboard/stage1checkaudits/{client:id}/{id}/edit', [Stage1checkauditController::class, 'edit'])->name('F-CER-06 - Check List Audit Stage I.view');
        Route::post('/dashboard/stage1checkaudits', [Stage1checkauditController::class, 'store'])->name('F-CER-06 - Check List Audit Stage I.store');
        Route::put('/dashboard/stage1checkaudits/{client:id}/{id}', [Stage1checkauditController::class, 'update'])->name('F-CER-06 - Check List Audit Stage I.update');
        Route::get('/dashboard/stage1checkaudits/download/{stage1checkaudit:id}', [Stage1checkauditController::class, 'download'])->name('F-CER-06 - Check List Audit Stage I.download');
        Route::put('/dashboard/stage1checkauditsvalidasi/{client:id}/{id}', [Stage1checkauditController::class, 'updatevalidasi'])->name('F-CER-06 - Check List Audit Stage I.validasi');

        Route::get('/dashboard/stage2rencanaaudits/{client:id}/{id}/edit', [Stage2rencanaauditController::class, 'edit'])->name('F-CER-05 - Rencana Audit.view');
        Route::post('/dashboard/stage2rencanaaudits', [Stage2rencanaauditController::class, 'store'])->name('F-CER-05 - Rencana Audit.store');
        Route::put('/dashboard/stage2rencanaaudits/{client:id}/{id}', [Stage2rencanaauditController::class, 'update'])->name('F-CER-05 - Rencana Audit.update');
        Route::get('/dashboard/stage2rencanaaudits/download/{stage2rencanaaudit:id}', [Stage2rencanaauditController::class, 'download'])->name('F-CER-05 - Rencana Audit.download');
        Route::put('/dashboard/stage2rencanaauditsvalidasi/{client:id}/{id}', [Stage2rencanaauditController::class, 'updatevalidasi'])->name('F-CER-05 - Rencana Audit.validasi');

        Route::get('/dashboard/stage2daftarhadiraudits/{client:id}/{id}/edit', [Stage2daftarhadirauditController::class, 'edit'])->name('F-CER-07 - Daftar Hadir Audit.view');
        Route::post('/dashboard/stage2daftarhadiraudits', [Stage2daftarhadirauditController::class, 'store'])->name('F-CER-07 - Daftar Hadir Audit.store');
        Route::put('/dashboard/stage2daftarhadiraudits/{client:id}/{id}', [Stage2daftarhadirauditController::class, 'update'])->name('F-CER-07 - Daftar Hadir Audit.update');
        Route::get('/dashboard/stage2daftarhadiraudits/download/{stage2daftarhadiraudit:id}', [Stage2daftarhadirauditController::class, 'download'])->name('F-CER-07 - Daftar Hadir Audit.download');
        Route::put('/dashboard/stage2daftarhadirauditsvalidasi/{client:id}/{id}', [Stage2daftarhadirauditController::class, 'updatevalidasi'])->name('F-CER-07 - Daftar Hadir Audit.validasi');

        Route::get('/dashboard/stage2ketidaksesuaianpages/{client:id}/{id}/edit', [Stage2ketidaksesuaianpageController::class, 'edit'])->name('F-CER-09 - Lembar Ketidaksesuaian.view');
        Route::post('/dashboard/stage2ketidaksesuaianpages', [Stage2ketidaksesuaianpageController::class, 'store'])->name('F-CER-09 - Lembar Ketidaksesuaian.store');
        Route::put('/dashboard/stage2ketidaksesuaianpages/{client:id}/{id}', [Stage2ketidaksesuaianpageController::class, 'update'])->name('F-CER-09 - Lembar Ketidaksesuaian.update');
        Route::get('/dashboard/stage2ketidaksesuaianpages/download/{stage2ketidaksesuaianpage:id}', [Stage2ketidaksesuaianpageController::class, 'download'])->name('F-CER-09 - Lembar Ketidaksesuaian.download');
        Route::put('/dashboard/stage2ketidaksesuaianpagesvalidasi/{client:id}/{id}', [Stage2ketidaksesuaianpageController::class, 'updatevalidasi'])->name('F-CER-09 - Lembar Ketidaksesuaian.validasi');

        Route::get('/dashboard/stage2checkaudits/{client:id}/{id}/edit', [Stage2checkauditController::class, 'edit'])->name('F-CER-06B - Checklist Audit Stage II.view');
        Route::post('/dashboard/stage2checkaudits', [Stage2checkauditController::class, 'store'])->name('F-CER-06B - Checklist Audit Stage II.store');
        Route::put('/dashboard/stage2checkaudits/{client:id}/{id}', [Stage2checkauditController::class, 'update'])->name('F-CER-06B - Checklist Audit Stage II.update');
        Route::get('/dashboard/stage2checkaudits/download/{stage2checkaudit:id}', [Stage2checkauditController::class, 'download'])->name('F-CER-06B - Checklist Audit Stage II.download');
        Route::put('/dashboard/stage2checkauditsvalidasi/{client:id}/{id}', [Stage2checkauditController::class, 'updatevalidasi'])->name('F-CER-06B - Checklist Audit Stage II.validasi');

        Route::get('/dashboard/stage2laporanaudits/{client:id}/{id}/edit', [Stage2laporanauditController::class, 'edit'])->name('F-CER-08 - Laporan Audit.view');
        Route::post('/dashboard/stage2laporanaudits', [Stage2laporanauditController::class, 'store'])->name('F-CER-08 - Laporan Audit.store');
        Route::put('/dashboard/stage2laporanaudits/{client:id}/{id}', [Stage2laporanauditController::class, 'update'])->name('F-CER-08 - Laporan Audit.update');
        Route::get('/dashboard/stage2laporanaudits/download/{stage2laporanaudit:id}', [Stage2laporanauditController::class, 'download'])->name('F-CER-08 - Laporan Audit.download');
        Route::put('/dashboard/stage2laporanauditsvalidasi/{client:id}/{id}', [Stage2laporanauditController::class, 'updatevalidasi'])->name('F-CER-08 - Laporan Audit.validasi');

        Route::get('/dashboard/stage2surveikepuasancustomers/{client:id}/{id}/edit', [Stage2surveikepuasancustomerController::class, 'edit'])->name('F-CER-10 - Survei Kepuasan Pelanggan.view');
        Route::post('/dashboard/stage2surveikepuasancustomers', [Stage2surveikepuasancustomerController::class, 'store'])->name('F-CER-10 - Survei Kepuasan Pelanggan.store');
        Route::put('/dashboard/stage2surveikepuasancustomers/{client:id}/{id}', [Stage2surveikepuasancustomerController::class, 'update'])->name('F-CER-10 - Survei Kepuasan Pelanggan.update');
        Route::get('/dashboard/stage2surveikepuasancustomers/download/{stage2surveikepuasancustomer:id}', [Stage2surveikepuasancustomerController::class, 'download'])->name('F-CER-10 - Survei Kepuasan Pelanggan.download');
        Route::put('/dashboard/stage2surveikepuasancustomersvalidasi/{client:id}/{id}', [Stage2surveikepuasancustomerController::class, 'updatevalidasi'])->name('F-CER-10 - Survei Kepuasan Pelanggan.validasi');

        Route::get('/dashboard/stage2temuanverifcations/{client:id}/{id}/edit', [Stage2temuanverifcationController::class, 'edit'])->name('F-CER-09 - Verifikasi Temuan.view');
        // Route::post('/dashboard/stage2temuanverifcations', [Stage2temuanverifcationController::class, 'store'])->name('F-CER-09 - Verifikasi Temuan.store');
        // Route::put('/dashboard/stage2temuanverifcations/{client:id}/{id}', [Stage2temuanverifcationController::class, 'update'])->name('F-CER-09 - Verifikasi Temuan.update');
        Route::post('/dashboard/stage2temuanvericationsvalidasi', [Stage2temuanverifcationController::class, 'validasi'])->name('F-CER-09 - Verifikasi Temuan.validasi');
        Route::put('/dashboard/stage2temuanvericationsvalidasi/{client:id}/{id}', [Stage2temuanverifcationController::class, 'updatevalidasi'])->name('F-CER-09 - Verifikasi Temuan.validasiupdate');

        Route::get('/dashboard/reviewkeputusansertifikasis/{client:id}/{id}/edit', [ReviewkeputusansertifikasiController::class, 'edit'])->name('F-CER-11 - Review Keputusan Sertifikasi.view');
        Route::post('/dashboard/reviewkeputusansertifikasis', [ReviewkeputusansertifikasiController::class, 'store'])->name('F-CER-11 - Review Keputusan Sertifikasi.store');
        Route::put('/dashboard/reviewkeputusansertifikasis/{client:id}/{id}', [ReviewkeputusansertifikasiController::class, 'update'])->name('F-CER-11 - Review Keputusan Sertifikasi.update');
        Route::get('/dashboard/reviewkeputusansertifikasis/download/{reviewkeputusansertifikasi:id}', [ReviewkeputusansertifikasiController::class, 'download'])->name('F-CER-11 - Review Keputusan Sertifikasi.download');
        Route::put('/dashboard/reviewkeputusansertifikasisvalidasi/{client:id}/{id}', [ReviewkeputusansertifikasiController::class, 'updatevalidasi'])->name('F-CER-11 - Review Keputusan Sertifikasi.validasi');

        Route::get('/dashboard/memopenerbitansertifikasis/{client:id}/{id}/edit', [MemopenerbitansertifikasiController::class, 'edit'])->name('F-CER-12 - Memo Penerbitan Sertifikat.view');
        Route::post('/dashboard/memopenerbitansertifikasis', [MemopenerbitansertifikasiController::class, 'store'])->name('F-CER-12 - Memo Penerbitan Sertifikat.store');
        Route::put('/dashboard/memopenerbitansertifikasis/{client:id}/{id}', [MemopenerbitansertifikasiController::class, 'update'])->name('F-CER-12 - Memo Penerbitan Sertifikat.update');
        Route::get('/dashboard/memopenerbitansertifikasis/download/{memopenerbitansertifikasi:id}', [MemopenerbitansertifikasiController::class, 'download'])->name('F-CER-12 - Memo Penerbitan Sertifikat.download');
        Route::put('/dashboard/memopenerbitansertifikasisvalidasi/{client:id}/{id}', [MemopenerbitansertifikasiController::class, 'updatevalidasi'])->name('F-CER-12 - Memo Penerbitan Sertifikat.validasi');

        Route::get('/dashboard/evaluasisatusiklussertifikasis/{client:id}/{id}/edit', [EvaluasisatusiklussertifikasiController::class, 'edit'])->name('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.view');
        Route::post('/dashboard/evaluasisatusiklussertifikasis', [EvaluasisatusiklussertifikasiController::class, 'store'])->name('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.store');
        Route::put('/dashboard/evaluasisatusiklussertifikasis/{client:id}/{id}', [EvaluasisatusiklussertifikasiController::class, 'update'])->name('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.update');
        Route::get('/dashboard/evaluasisatusiklussertifikasis/download/{id}', [EvaluasisatusiklussertifikasiController::class, 'download'])->name('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.download');
        Route::put('/dashboard/evaluasisatusiklussertifikasisvalidasi/{client:id}/{id}', [EvaluasisatusiklussertifikasiController::class, 'updatevalidasi'])->name('F-CER-13 - Evaluasi Satu Siklus Sertifikasi.validasi');

        Route::get('/dashboard/penerbitansertifikats/{client:id}/{id}/edit', [PenerbitansertifikatController::class, 'edit'])->name('Penerbitan Sertifikasi.view');
        Route::post('/dashboard/penerbitansertifikats', [PenerbitansertifikatController::class, 'store'])->name('Penerbitan Sertifikasi.store');
        Route::put('/dashboard/penerbitansertifikats/{client:id}/{id}', [PenerbitansertifikatController::class, 'update'])->name('Penerbitan Sertifikasi.update');
        Route::get('/dashboard/penerbitansertifikats/download/{penerbitansertifikat:id}', [PenerbitansertifikatController::class, 'download'])->name('Penerbitan Sertifikasi.download');

        // Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('users.create');
        // Route::post('/dashboard/users', [UserController::class, 'store'])->name('users.store');
        // Route::get('/dashboard/users/{user:id}/edit', [UserController::class, 'edit'])->name('users.edit');
        // Route::put('/dashboard/users/{user:id}', [UserController::class, 'update'])->name('users.update');
        // Route::delete('/dashboard/users/{user:id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
