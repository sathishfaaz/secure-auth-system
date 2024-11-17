<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use Spatie\Activitylog\Facades\Activity;
use App\Models\AuditLog;
use App\Http\Controllers\AuditLogController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth', 'role:Admin'])->group(function () {
Route::get('/users/{user}/permissions', [UserController::class, 'editPermissions'])->name('users.editPermissions');
Route::post('/users/{user}/permissions', [UserController::class, 'assignPermissions'])->name('users.assignPermissions');
// Route to toggle user status
Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);
});



//Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard');
});
Route::middleware(['auth', 'role:User'])->group(function () {
    Route::get('/user', [HomeController::class, 'user'])->name('user.dashboard');
});
Route::middleware(['auth', 'role:Guest'])->group(function () {
    Route::get('/guest', [HomeController::class, 'guest'])->name('guest.dashboard');
});

Route::get('/', [HomeController::class, 'index'])->name('home'); // Homepage route

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');





Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');



Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/audit-logs', [AuditLogController::class, 'index'])->name('audit.logs');
});

require __DIR__.'/auth.php';
