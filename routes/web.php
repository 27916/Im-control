<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdController;
use App\Http\Controllers\anunciosController;
use App\Http\Controllers\CampaignsController;
use App\Http\Controllers\FinancialStatusController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PasswordAltController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PruebaController;

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

Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/social_networks', 'social-networks')->name('social_networks');

Route::get('/pages', [PagesController::class, 'index'])->name('pages');

// ! Anuncios y Campañas
Route::get('/ads_all/{account_id}/{account_name}', [AdController::class, 'indexAdsAll'])->name('ads_all');
// ! Rutas Leo
Route::post('/ad_info/id={ad_id}',  [AdController::class, 'details'])->name('ad_info');
//Route::get('/ad_info1/{ad_id}/{filter}', [AdController::class, 'adInfo1'])->name('ad_info1');

// Route::post('/ad_info', [anunciosController::class, 'filter'])->name('ad_info');
Route::get('/ad_info1', [anunciosController::class, 'filterF'])->name('ad_info1');


// ! Rutas que ya tenia
// Route::post('/ad_info/{ad_id}',  [AdController::class, 'details'])->name('ad_info');
// Route::post('/ad_info1/{ad_id}/{time}', [AdController::class, 'adInfo1'])->name('ad_info1');


Route::post('/ad_info/{user_id}/send_report', [AdController::class, 'sendReportAd'])->name('ad_info_report_email');
Route::get('/ads/ad_report/{ad_id}', [AdController::class, 'viewReport'])->name('ads_report');
Route::get('/ads/ad_report1/{ad_id}', [AdController::class, 'viewReport1'])->name('ads_report1');


Route::post('/campaigns/{account_id}/{account_name}', [CampaignsController::class, 'index'])->name('campaigns');
Route::post('/campaign_info/{campaign_id}',  [CampaignsController::class, 'details'])->name('campaign_info');
Route::post('/campaign_info1/{campaign_id}', [CampaignsController::class, 'campaignInfo1'])->name('campaign_info1');

// ! Rutas Reportes
Route::get('/campaigns/campaign_report', [CampaignsController::class, 'viewReport'])->name('campaigns_report');

Route::post('/campaign_info/{user_id}/send_report', [CampaignsController::class, 'sendReportCampaigns'])->name('campaign_info_report_email');

Route::view('/ads', 'ads.ads')->name('ads');
Route::get('/client_profile/{ad_id}', [FinancialStatusController::class, 'index'])->name('client_profile');

require __DIR__ . '/auth.php';

Route::get('/prueba', [PruebaController::class, 'index'])->name('prueba');

// ! Esta ruta se va a eliminar aqui y en la vista se refactorizará por forgot_password en las rutas de authenticacion
Route::controller(PasswordAltController::class)
    ->prefix('change_password')
    ->as('change_password.')
    ->group(function () {
        Route::get('', 'index')->name('index'); // ! change password provisional para el hosting
    });

// Route::prefix('dashboard')->group(['middleware' => 'auth'], function () {
//     // Aqui van las rutas de la aplicación que serán protegidas
// });
