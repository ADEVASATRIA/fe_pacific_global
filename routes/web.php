<?php




use App\Http\Controllers\WEB\Back\Clubhouse\ClubhouseController;
use App\Http\Controllers\WEB\Back\Item\ItemController;
use App\Http\Controllers\WEB\Back\Package\PackageController;
use App\Http\Controllers\WEB\Back\Promo\PromoController;
use App\Http\Controllers\WEB\Front\Home\HomeController;
use App\Http\Controllers\WEB\Option\ContentOptionController;
use Illuminate\Support\Facades\Route;

// Controller dari pacific global
use App\Http\Controllers\WEB\Auth\LoginController;
use App\Http\Controllers\WEB\Back\Dashboard\dashboardController;
use App\Http\Controllers\WEB\Back\Role\RoleController;
use App\Http\Controllers\WEB\Back\TicketType\TicketTypeController;

// Group Route Pacific Global
Route::group([], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'resgiter'])->name('register');
    Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

    // ROUTE OPTION FOR BACK OFFICE OR FRONT OFFICE
    Route::get('/content-option', [ContentOptionController::class, 'index'])->name('contentOption');


    // ROUTE FOR FRONT OFFICE
    Route::get('/home-front', [HomeController::class, 'index'])->name('homeFront');

    // ROLE VIEW BACK OFFICE
    Route::get('/role-view', [RoleController::class, 'index'])->name('viewRole');
    Route::get('/role-create', [RoleController::class, 'createRole'])->name('createRole');

    // TICKET TYPE VIEW BACK OFFICE
    Route::get('/ticket-type-view', [TicketTypeController::class, 'index'])->name('viewTicketType');

    // CLUBHOUSE VIEW BACK OFFICE
    Route::get('/clubhouse-view', [ClubhouseController::class, 'index'])->name('viewClubhouse');

    // ITEM VIEW BACK OFFICE
    Route::get('/item-view', [ItemController::class, 'index'])->name('viewItem');

    // PACKAGE VIEW BACK OFFICE
    Route::get('/package-view', [PackageController::class, 'index'])->name('viewPackage');

    // PROMO VIEW BACK OFFICE
    Route::get('/promo-view', [PromoController::class, 'index'])->name('viewPromo');
});

Route::get('/error-page', function () {
    return view('content.error.misc-error');
});
