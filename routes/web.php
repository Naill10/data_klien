<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KlienController;

// Halaman utama        
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $totalKlien      = \App\Models\Klien::where('user_id', auth()->id())->count();
    $klienAktif      = \App\Models\Klien::where('user_id', auth()->id())->where('status', 'Aktif')->count();
    $klienTidakAktif = \App\Models\Klien::where('user_id', auth()->id())->where('status', 'Tidak Aktif')->count();
    $klienTerbaru    = \App\Models\Klien::where('user_id', auth()->id())->latest()->take(5)->get();

    return view('dashboard', compact('totalKlien', 'klienAktif', 'klienTidakAktif', 'klienTerbaru'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/ecommerce', function () {
    return view('pages.dashboard.ecommerce', ['title' => 'Ecommerce']);
})->middleware(['auth', 'verified'])->name('ecommerce');
// Semua halaman yang BUTUH login
Route::middleware('auth')->group(function () {

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Calendar
    Route::get('/profile', function () {
        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');
    // Calendar
    Route::get('/calendar', function () {
        return view('pages.calender', ['title' => 'Calendar']);
    })->name('calendar');
    
    // Tabel User
    Route::get('/tabel_user', function () {
        return view('pages.tabel_user', ['title' => 'Tabel User']);
    })->name('tabel_user');

    // Form Elements
    Route::get('/form-elements', function () {
        return view('pages.form.form-elements', ['title' => 'Form Elements']);
    })->name('form-elements');

    // Basic Tables
    Route::get('/basic-tables', function () {
        return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
    })->name('basic-tables');

    // Blank Page
    Route::get('/blank', function () {
        return view('pages.blank', ['title' => 'Blank']);
    })->name('blank');

    // Charts
    Route::get('/line-chart', function () {
        return view('pages.chart.line-chart', ['title' => 'Line Chart']);
    })->name('line-chart');

    Route::get('/bar-chart', function () {
        return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
    })->name('bar-chart');

    // UI Elements
    Route::get('/alerts', function () {
        return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
    })->name('alerts');

    Route::get('/avatars', function () {
        return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
    })->name('avatars');

    Route::get('/badge', function () {
        return view('pages.ui-elements.badges', ['title' => 'Badges']);
    })->name('badges');

    Route::get('/buttons', function () {
        return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
    })->name('buttons');

    Route::get('/image', function () {
        return view('pages.ui-elements.images', ['title' => 'Images']);
    })->name('images');

    Route::get('/videos', function () {
        return view('pages.ui-elements.videos', ['title' => 'Videos']);
    })->name('videos');

    Route::get('/tooltips', function () {
        return view('pages.ui-elements.tooltips', ['title' => 'Tooltips']);
    })->name('tooltips');

});

// Error page (boleh diakses tanpa login)
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');

//klien
//klien - ✅ taruh semua SEBELUM resource
Route::get('/klien/import-page', function () {
    return view('pages.klien.import');
})->middleware('auth')->name('klien.import.page');

Route::get('/klien/import/template', [KlienController::class, 'downloadTemplate'])->name('klien.import.template')->middleware('auth');
Route::post('/klien/import', [KlienController::class, 'import'])->name('klien.import')->middleware('auth');

Route::resource('klien', App\Http\Controllers\KlienController::class); // ✅ resource PALING BAWAH

require __DIR__.'/auth.php';