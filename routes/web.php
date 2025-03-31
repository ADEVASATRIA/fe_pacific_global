<?php




use App\Http\Controllers\WEB\Back\Clubhouse\ClubhouseController;
use App\Http\Controllers\WEB\Back\Item\ItemController;
use App\Http\Controllers\WEB\Back\Package\PackageController;
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
});
