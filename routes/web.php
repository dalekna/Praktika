<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

// ⬇⬇⬇ PERKELTAS ČIA – forma prieinama be prisijungimo
Route::get('/form', fn() => view('form'));
Route::post('/submit-form', [FormController::class, 'submit'])->name('submit.form');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::prefix('c')->group(function () {
        Route::resource('contacts', ContactController::class);
        Route::get('contacts-deleted', [ContactController::class, 'trashed'])->name('contacts.trashed');
        Route::post('contacts/{id}/restore', [ContactController::class, 'restore'])->name('contacts.restore');
        Route::delete('contacts/{id}/force-delete', [ContactController::class, 'forceDelete'])->name('contacts.forceDelete');
    });
});

Route::get('/test-email', function () {
    Mail::raw('Tai yra testinis laiškas!', function ($message) {
        $message->to('test@example.com')
                ->subject('Testas iš Laravel');
    });

    return 'Laiškas išsiųstas!';
});
