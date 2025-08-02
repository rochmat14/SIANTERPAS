<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\Antrian\AntrianController;
use App\Http\Controllers\Dashboard\Antrian\AntrianLayananInformasiController;
use App\Http\Controllers\Dashboard\Antrian\AntrianLayananKunjunganController;
use App\Http\Controllers\Dashboard\Antrian\AntrianLayananPengaduanController;
use App\Http\Controllers\Dashboard\Antrian\KelolaDataAntrianLayananKunjunganController;
use App\Http\Controllers\Dashboard\Antrian\KelolaDataAntrianLayananInformasiController;

Auth::routes();



Route::group(array(
    'prefix' => LaravelLocalization::setLocale() . '/dashboard',
    'namespace' => 'Dashboard',
    'middleware' => ['adminauth',
    'cors']
) , function ()
{

    Route::get('/layanan', AntrianController::class. '@aturAntrian');
    Route::post('/atur_antrian', AntrianController::class. '@store')->name('antrian.store');
    
    // manage urutan antrian
    // layanan informasi 
    Route::get('/antrian_layanan_informasi', AntrianLayananInformasiController::class. '@index');
    Route::post('/antrian_informasi', AntrianLayananInformasiController::class. '@store')->name('antrianInformasi.store');
    Route::post('antrian_layanan_informasi/tutup_antrian','Antrian\AntrianLayananInformasiController@tutupAntrian');
    
    // layanan kunjungan
    Route::get('/sesi_layanan_kunjungan', AntrianLayananKunjunganController::class. '@index');
    
    Route::get('/sesi_pertama', AntrianLayananKunjunganController::class. '@sesiPertama');
    Route::post('/sesi_pertama_kunjungan', AntrianLayananKunjunganController::class. '@storeSesiPertama')->name('sesiPertama.store');
    
    Route::get('/sesi_kedua', AntrianLayananKunjunganController::class. '@sesiKedua');
    Route::post('/sesi_kedua_kunjungan', AntrianLayananKunjunganController::class. '@storeSesiKedua')->name('sesiKedua.store');;
    
    Route::get('/sesi_ketiga', AntrianLayananKunjunganController::class. '@sesiKetiga');
    Route::post('/sesi_ketiga_kunjungan', AntrianLayananKunjunganController::class. '@storeSesiKetiga')->name('sesiKetiga.store');;
    
    // layanan pengaduan
    Route::get('/antrian_layanan_pengaduan', AntrianLayananPengaduanController::class. '@aturAntrian');
    Route::post('/antrian_pengaduan', AntrianLayananPengaduanController::class. '@store')->name('antrianPengaduan.store');


    // manage data urutan antrian
    // layanan informasi 
    Route::get('kelola_antrian_layanan_informasi/get-data', 'Antrian\KelolaDataAntrianLayananInformasiController@getData')
        ->name('kelola_antrian_layanan_informasi.getData');
    Route::get('kelola_antrian_layanan_informasi', 'Antrian\KelolaDataAntrianLayananInformasiController@index');
    Route::post('kelola_antrian_layanan_informasi/create','Antrian\KelolaDataAntrianLayananInformasiController@create');
    Route::get('kelola_antrian_layanan_informasi/get_data/id', 'Antrian\KelolaDataAntrianLayananInformasiController@get_data_byid');
    Route::post('kelola_antrian_layanan_informasi/update','Antrian\KelolaDataAntrianLayananInformasiController@update');
    Route::post('kelola_antrian_layanan_informasi/delete','Antrian\KelolaDataAntrianLayananInformasiController@delete');

    
    // layanan kunjungan
    Route::get('kelola_antrian_layanan_kunjungan/get-data', 'Antrian\KelolaDataAntrianLayananKunjunganController@getData')
        ->name('kelola_antrian_layanan_kunjungan.getData');
    Route::get('kelola_antrian_layanan_kunjungan', 'Antrian\KelolaDataAntrianLayananKunjunganController@index');
    Route::post('kelola_antrian_layanan_kunjungan/create','Antrian\KelolaDataAntrianLayananKunjunganController@create');
    Route::get('/kelola_antrian_layanan_kunjungan/{id}', 'Antrian\KelolaDataAntrianLayananKunjunganController@showSesiKunjungan');
    Route::get('kelola_antrian_layanan_kunjungan/get_data/id', 'Antrian\KelolaDataAntrianLayananKunjunganController@get_data_byid');
    Route::post('kelola_antrian_layanan_kunjungan/update','Antrian\KelolaDataAntrianLayananKunjunganController@update');
    Route::post('kelola_antrian_layanan_kunjungan/delete','Antrian\KelolaDataAntrianLayananKunjunganController@delete');


    // layanan pengaduan
    Route::get('kelola_antrian_layanan_pengaduan/get-data', 'Antrian\KelolaDataAntrianLayananPengaduanController@getData')
        ->name('kelola_antrian_layanan_pengaduan.getData');
    Route::get('kelola_antrian_layanan_pengaduan', 'Antrian\KelolaDataAntrianLayananPengaduanController@index');
    Route::post('kelola_antrian_layanan_pengaduan/create','Antrian\KelolaDataAntrianLayananPengaduanController@create');
    Route::get('kelola_antrian_layanan_pengaduan/get_data/id', 'Antrian\KelolaDataAntrianLayananPengaduanController@get_data_byid');
    Route::post('kelola_antrian_layanan_pengaduan/update','Antrian\KelolaDataAntrianLayananPengaduanController@update');
    Route::post('kelola_antrian_layanan_pengaduan/delete','Antrian\KelolaDataAntrianLayananPengaduanController@delete');


    








    
    // Dashboard
    Route::get('/', 'HomeController@index')->name('dashboard.index');

    // MASTER DATA
    /* User */
    Route::get('users_pengguna/{id}', 'UserController@show')->name('users_pengguna_get.show');
    Route::resource('users_pengguna', 'UserController');
    Route::post('users_pengguna/get-data', 'UserController@getData')
        ->name('users_pengguna.getData');
    Route::post('users_pengguna/{user}/activated', 'UserController@activated')
        ->name('users_pengguna.activated');
    Route::post('users_pengguna/save', 'UserController@save');
    Route::get('/users_pengguna/get_data/{id}', 'UserController@get_data_byid');
    Route::post('users_pengguna/update', 'UserController@update');
    Route::get('users/get-data-option', 'UserController@getOptionData');
    // Route::post('users/delete','UserController@delete');


    // User Signature
    Route::get('users_signature/create/{id}', 'Master\\SignatureController@create');
    Route::post('users_signature/tambah_signature', 'Master\\SignatureController@tambahSignature')
        ->name('tambah_signature');
    Route::get('users_signature/edit/{id}', 'Master\\SignatureController@edit');
    Route::post('users_signature/ubah_signature', 'Master\\SignatureController@ubahSignature')
        ->name('ubah_signature');


    //profile
    Route::get('/profile', 'ProfileController@index')
        ->name('profile.index');
    Route::post('/profile/change_password', 'ProfileController@updatePassword')
        ->name('profile.change_password');
    Route::post('/profile/change_profile', 'ProfileController@change_profile')
        ->name('profile.change_profile');
    Route::post('/profile/change_image', 'ProfileController@change_image')
        ->name('profile.change_image');



    //setting general
    Route::get('/setting_general', 'SettingGeneralController@index')
        ->name('setting_general.index');
    Route::post('setting_general/get-data', 'SettingGeneralController@getData')
        ->name('setting_general.getData');
    Route::post('setting_general/get-data-system', 'SettingGeneralController@getDataSystem')
        ->name('setting_general.getDataSystem');
    Route::post('setting_general/get-data-web-setting', 'SettingGeneralController@getDataSettingWeb')
        ->name('setting_general.getDataSettingWeb');
    Route::post('setting_general/get-data-loadcell-setting', 'SettingGeneralController@getDataSettingLoadcell')
        ->name('setting_general.getDataSettingLoadcell');
    Route::get('setting_general/edit_data_system/{id}', 'SettingGeneralController@edit_data_system')
        ->name('setting_general.edit_data_system');
    Route::post('setting_general/act_update', 'SettingGeneralController@act_update')
        ->name('setting_general.act_update');
    Route::get('/setting_general/get_data/id', 'SettingGeneralController@get_data_byid');
    Route::post('setting_general/update', 'SettingGeneralController@update');

    //role
    Route::get('roles/{role}/permission', 'RolesController@permission')->name('roles.permission');
    Route::put('roles/{role}/permission', 'RolesController@updatePermission')->name('roles.permission_put');
    Route::post('roles/get-data', 'RolesController@getData')
        ->name('roles.getData');

    Route::get('roles/get-data-option', 'RolesController@getOptionData');
    Route::resource('roles', 'RolesController');

    
    /* Permission */
    Route::resource('permissions', 'PermissionsController');
    Route::post('permissions/get-data', 'PermissionsController@getData')
        ->name('permissions.getData');
    Route::post('permissions/save', 'PermissionsController@save');
    Route::get('/permissions/get_data/id', 'PermissionsController@get_data_byid');
    Route::post('permissions/update', 'PermissionsController@update');
    Route::post('permissions/delete', 'PermissionsController@delete');


    Route::resource('infobox', 'Master\\InfoboxController');
    Route::post('infobox/get-data', 'Master\\InfoboxController@getData')->name('infobox.getData');
    Route::get('/infobox/get_data/id', 'Master\\InfoboxController@get_data_byid');
    Route::post('infobox/update','Master\\InfoboxController@update');


    // inbox
    Route::resource('inbox', 'CMS\\InboxController');
    Route::post('inbox/get-data', 'CMS\\InboxController@getData')->name('inbox.getData');
    Route::post('inbox/save','CMS\\InboxController@save');
    Route::get('/inbox/get_data/id', 'CMS\\InboxController@get_data_byid');
    
    
    

    // Testimonial
    Route::resource('testimonial', 'CMS\\TestimonialController');
    Route::post('testimonial/get-data', 'CMS\\TestimonialController@getData')->name('testimonial.getData');
    Route::post('testimonial/save','CMS\\TestimonialController@save');
    Route::get('/testimonial/get_data/id', 'CMS\\TestimonialController@get_data_byid');
    Route::post('testimonial/update','CMS\\TestimonialController@update');
    Route::post('testimonial/delete','CMS\\TestimonialController@delete');


    // client menu
    Route::resource('client', 'CMS\\ClientController');
    Route::post('client/get-data', 'CMS\\ClientController@getData')->name('client.getData');
    Route::post('client/save','CMS\\ClientController@save');
    Route::get('/client/get_data/id', 'CMS\\ClientController@get_data_byid');
    Route::post('client/update','CMS\\ClientController@update');
    Route::post('client/delete','CMS\\ClientController@delete');

    //tags
    Route::resource('tags', 'CMS\\TagsController');
    Route::post('tags/get-data', 'CMS\\TagsController@getData')->name('tags.getData');
    Route::post('tags/save','CMS\\TagsController@save');
    Route::get('/tags/get_data/id', 'CMS\\TagsController@get_data_byid');
    Route::post('tags/update','CMS\\TagsController@update');
    Route::post('tags/delete','CMS\\TagsController@delete');


    //category
    Route::resource('category', 'CMS\\CategoryController');
    Route::post('category/get-data', 'CMS\\CategoryController@getData')->name('category.getData');
    Route::post('category/save','CMS\\CategoryController@save');
    Route::get('/category/get_data/id', 'CMS\\CategoryController@get_data_byid');
    Route::post('category/update','CMS\\CategoryController@update');
    Route::post('category/delete','CMS\\CategoryController@delete');
    Route::post('category/setup_main','CMS\\CategoryController@setup_main');
    

    


    //slider
    Route::resource('slider', 'CMS\\SliderController');
    Route::post('slider/get-data', 'CMS\\SliderController@getData')->name('slider.getData');
    Route::post('slider/save','CMS\\SliderController@save');
    Route::get('/slider/get_data/id', 'CMS\\SliderController@get_data_byid');
    Route::post('slider/update','CMS\\SliderController@update');
    Route::post('slider/delete','CMS\\SliderController@delete');
    
    

    // news article
    Route::resource('news', 'CMS\\NewsController');
    Route::post('news/get-data', 'CMS\\NewsController@getData')->name('news.getData');
    Route::get('/news/get_data/id', 'CMS\\NewsController@get_data_byid');
    Route::post('/news/change_status', 'CMS\\NewsController@ChangeStatus');
    Route::post('/news/send_article', 'CMS\\NewsController@SendArticle')->name('news.send_article');
    Route::post('/news/pull_article', 'CMS\\NewsController@PullArticle')->name('news.pull_article');

    

    
    Route::get('/news/create', 'CMS\\NewsController@create');
    Route::post('/news/create', 'CMS\\NewsController@store');
    Route::get('/news/{id?}/edit', 'CMS\\NewsController@edit');
    Route::post('/news/{id?}/edit', 'CMS\\NewsController@update');
    Route::get('/news/{id?}/show', 'CMS\\NewsController@show');

    // pages menu
    Route::resource('pages', 'CMS\\PagesController');
    Route::get('/pages/create', 'CMS\\PagesController@create');
    Route::post('/pages/create', 'CMS\\PagesController@store');
    Route::get('/pages/create/{id?}', 'CMS\\PagesController@create');
    Route::post('/pages/create/{id?}', 'CMS\\PagesController@store');
    Route::get('/pages/children/{parent_id?}/{depth?}', 'CMS\\PagesController@children');
    Route::get('/pages/{id?}/edit', 'CMS\\PagesController@edit');
    Route::post('/pages/{id?}/edit', 'CMS\\PagesController@update');
    Route::get('/pages/{id?}/show', 'CMS\\PagesController@show');
    Route::get('/pages/reorder/{id?}', 'CMS\\PagesController@reorder');


    // gallery
    Route::get('gallery', 'Master\GalleryController@index')->name('gallery.index');
    Route::post('gallery/get-data', 'Master\GalleryController@getData')->name('gallery.getData');
    Route::get('/gallery/create', 'Master\GalleryController@create');
    Route::get('/gallery/{id}/edit', 'Master\GalleryController@edit');
    Route::post('/gallery/{id}/edit', 'Master\GalleryController@update');
    Route::post('/gallery/create', 'Master\GalleryController@store');
    Route::post('gallery/delete','Master\GalleryController@delete');


    // fasilitas gallery
    Route::post('fasilitas_gallery/get-data', 'Master\FasilitasGalleryController@getData')->name('fasilitas_gallery.getData');
    Route::post('fasilitas_gallery/save','Master\FasilitasGalleryController@save');
    Route::post('fasilitas_gallery/delete','Master\FasilitasGalleryController@delete');



    //divisi
    // Route::resource('divisi', 'Master\\DivisiController');
    // Route::post('divisi/get-data', 'Master\\DivisiController@getData')->name('divisi.getData');
    // Route::post('divisi/save','Master\\DivisiController@save');
    // Route::get('/divisi/get_data/id', 'Master\\DivisiController@get_data_byid');
    // Route::post('divisi/update','Master\\DivisiController@update');
    // Route::post('divisi/delete','Master\\DivisiController@delete');

    // teams
    // Route::resource('teams', 'Master\\TeamsController');
    // Route::post('teams/get-data', 'Master\\TeamsController@getData')->name('teams.getData');
    // Route::post('teams/save','Master\\TeamsController@save');
    // Route::get('/teams/get_data/id', 'Master\\TeamsController@get_data_byid');
    // Route::post('teams/update','Master\\TeamsController@update');
    // Route::post('teams/delete','Master\\TeamsController@delete');


    // company 
    // Route::get('company', 'Master\CompanyController@index')->name('company.index');
    // Route::post('company/get-data', 'Master\CompanyController@getData')->name('company.getData');
    // Route::get('/company/get_data/id', 'Master\\CompanyController@get_data_byid');
    // Route::post('/company/save', 'Master\CompanyController@save');
    // Route::post('company/update','Master\\CompanyController@update');
    // Route::post('company/delete','Master\CompanyController@delete');

    // auditor
    // Route::get('auditor', 'Master\AuditorController@index')->name('auditor.index');
    // Route::post('auditor/get-data', 'Master\AuditorController@getData')->name('auditor.getData');
    // Route::get('/auditor/get_data/id', 'Master\\AuditorController@get_data_byid');
    // Route::post('/auditor/save', 'Master\AuditorController@save');
    // Route::post('auditor/update','Master\\AuditorController@update');
    // Route::post('auditor/delete','Master\AuditorController@delete');


    // Document
    // Route::get('document', 'Master\DocumentController@index')->name('document.index');
    // Route::post('document/get-data', 'Master\DocumentController@getData')->name('document.getData');
    // Route::get('/document/get_data/id', 'Master\\DocumentController@get_data_byid');
    // Route::post('/document/save', 'Master\DocumentController@save');
    // Route::post('document/update','Master\\DocumentController@update');
    // Route::post('document/delete','Master\DocumentController@delete');
    // Route::get('document/show-document', 'Master\DocumentController@showfile')->name('document.showfile');


    // Event
    // Route::get('event', 'Master\EventController@index')->name('event.index');
    // Route::post('event/get-data', 'Master\EventController@getData')->name('event.getData');
    // Route::get('/event/get_data/id', 'Master\EventController@get_data_byid');
    // Route::post('/event/save', 'Master\EventController@save');
    // Route::post('event/update','Master\EventController@update');
    // Route::post('event/delete','Master\EventController@delete');
    

    // Standard
    // Route::get('standard', 'Master\StandardController@index')->name('standard.index');
    // Route::post('standard/get-data', 'Master\StandardController@getData')->name('standard.getData');
    // Route::get('/standard/get_data/id', 'Master\StandardController@get_data_byid');
    // Route::post('/standard/save', 'Master\StandardController@save');
    // Route::post('standard/update','Master\StandardController@update');
    // Route::post('standard/delete','Master\StandardController@delete');
   

    // Membership
    Route::get('users-members', 'Modul\Members\MembersController@index')->name('users_member.index');
    Route::post('users-members/get-data', 'Modul\Members\MembersController@getData')->name('users_member.getData');
    Route::get('/users-members/get_data/id', 'Modul\Members\MembersController@get_data_byid');
    Route::post('/users-members/save', 'Modul\Members\MembersController@save');
    Route::post('users-members/update','Modul\Members\MembersController@update');
    Route::post('users-members/delete','Modul\Members\MembersController@delete');
   



});








Route::group(['prefix' => LaravelLocalization::setLocale() ], function ()
{
    Route::get('/', 'Frontend\FrontendController@index')->name('home'); 
    Route::get('/testing', 'Frontend\FrontendController@testing'); 
    
});

