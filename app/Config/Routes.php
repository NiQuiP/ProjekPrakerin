<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->setAutoRoute(true);
$routes->setDefaultNamespace('App\Controllers');


$routes->group('member/', ['filter' => 'auth'], function ($routes) {
    $routes->add('my-profile', 'Member\user::index');
    $routes->add('attendance', 'Member\user::attendance');
    $routes->post('attendance', 'Member\user::attendanceProcess', ['as' => 'user.attendance']);
    $routes->add('permission', 'Member\user::permission');
    $routes->post('permission', 'Member\user::permissionProcess', ['as' => 'user.permission']);
    $routes->add('history', 'Member\user::history');
    $routes->add('setting', 'Member\user::setting');
    $routes->post('setting', 'Member\user::settingProcess', ['as' => 'user.setting']);
    $routes->add('admin', 'Member\auth::admin');

});
$routes->group('/', ['filter' => 'noauth'], function ($routes) {
    $routes->add('login', 'Member\auth::login');
    $routes->post('projek_pkl/public/login', 'Member\auth::loginProcess', ['as' => 'user.login']);
    $routes->add('forgetpassword', 'Member\auth::forgetPassword');
    $routes->add('resetpassword', 'Member\auth::resetPassword');
    $routes->post('resetpassword', 'Member\auth::resetPasswordProcess', ['as' => 'user.resetpassword']);
    $routes->add('member/verifikasi', 'Member\auth::verifikasi');
    $routes->add('resetpassword', 'Member\auth::resetPassword');

});

$routes->group('member/', ['filter' => 'authregister'], function ($routes) {
    $routes->add('index', 'Member\auth::index');
    $routes->post('index', 'Member\auth::indexHandler', ['as' => 'member.index.handler']);
});


$routes->group('/', ['filter' => 'noauthregister'], function ($routes) {
    $routes->add('register', 'Member\auth::register');
    $routes->post('register', 'Member\auth::registerProcess', ['as' => 'user.register']);
});


$routes->add('member/kirim_ulang', 'Member\auth::kirim_ulang_token');
$routes->add('member/logout', 'Member\auth::logout');
$routes->get('member/profile', 'Member\template::profil');
$routes->get('member/attendance2', 'Member\template::attendance');
$routes->get('member/permission2', 'Member\template::permission');
$routes->get('member/history2', 'Member\template::history');
$routes->get('member/setting2', 'Member\template::setting');

$routes->get('/webcamaja', 'WebcamController::index');
$routes->post('/webcam/capture', 'WebcamController::capture');

$routes->get('admin/dashboard', 'admin\admin::dashboard');

// $routes->group('/', function ($routes) {
//     $routes->add('login', 'User\Auth::login');
//     $routes->add('registrasi', 'User\Auth::registrasi');
// });

// $routes->group('user', function ($routes) {
//     $routes->add('sukses', 'User\user::sukses');
//     $routes->add('logout', 'User\user::logout');
//     $routes->add('passwordlupa', 'User\user::user_lupapassword');
//     $routes->add('passwordreset', 'User\user::user_resetpassword');

// });
// $routes->add('admin/logout', 'Admin\admin::logout');

// $routes->group('admin', ['filter' => 'noauth'], function ($routes) {
//     $routes->add('login', 'Admin\admin::login');
//     $routes->add('lupapassword', 'Admin\admin::lupapassword');
//     $routes->add('resetpassword', 'Admin\admin::resetpassword');
// });

// $routes->group('admin', ['filter' => 'auth'], function ($routes) {
//     $routes->add('sukses', 'Admin\admin::sukses');
//     $routes->add('article', 'Admin\article::index');
//     $routes->add('article/tambah', 'Admin\article::tambah');
//     $routes->add('article/edit', 'Admin\article::edit');
//     $routes->add('siswa', 'Admin\article::siswa');
//     $routes->add('siswa/tambah', 'Admin\Article::siswa_tambah');
// });