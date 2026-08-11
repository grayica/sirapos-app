<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PosyanduController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\MessageLogController;
use App\Http\Controllers\UserController;

Route::redirect('/', '/login');

Route::get('/test-reminder-meta', function () {

    $response = Http::withToken(env('WHATSAPP_ACCESS_TOKEN'))
        ->post(
            'https://graph.facebook.com/v23.0/'
            . env('WHATSAPP_PHONE_NUMBER_ID')
            . '/messages',
            [
                'messaging_product' => 'whatsapp',

                'to' => '6285748435663',

                'type' => 'template',

                'template' => [
                    'name' => 'reminder_posyandu',

                    'language' => [
                        'code' => 'id',
                    ],

                    'components' => [
                        [
                            'type' => 'body',

                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => 'Ibu Siti',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => '11 Agustus 2026',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => 'Balai Desa Cermee',
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

    return response()->json([
        'http_status' => $response->status(),
        'response' => $response->json(),
    ]);
});

/*
|--------------------------------------------------------------------------
| Semua User (Login)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Peserta
    Route::resource('peserta', PesertaController::class)
        ->parameters(['peserta' => 'peserta']);

    Route::get('/peserta/import', [PesertaController::class, 'importForm'])
        ->name('peserta.import.form');

    Route::post('/peserta/import', [PesertaController::class, 'import'])
        ->name('peserta.import');

    Route::get('/peserta/export/pdf', [PesertaController::class, 'exportPdf'])
        ->name('peserta.export.pdf');

    Route::post('/peserta/{peserta}/test-wa', [PesertaController::class, 'testWhatsApp'])
        ->name('peserta.test-wa');

    // Jadwal
    Route::resource('jadwal', JadwalController::class)
        ->parameters(['jadwal' => 'jadwal']);

    Route::patch('/jadwal/{jadwal}/cancel', [JadwalController::class, 'cancel'])
        ->name('jadwal.cancel');

    Route::post('/jadwal/{jadwal}/send', [JadwalController::class, 'sendReminder'])
        ->name('jadwal.send');

    Route::get('/jadwal/export/pdf', [JadwalController::class, 'exportPdf'])
        ->name('jadwal.export.pdf');

    // Message Log
    Route::get('/message-log/pdf', [MessageLogController::class, 'exportPdf'])
        ->name('message-log.pdf');

    Route::resource('message-log', MessageLogController::class)
        ->only(['index', 'show']);
});

/*
|--------------------------------------------------------------------------
| Khusus Super Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'super_admin'])->group(function () {

    Route::resource('users', UserController::class);

    Route::resource('posyandu', PosyanduController::class);

    Route::patch('/users/{user}/approve', [UserController::class, 'approve'])
        ->name('users.approve');

    Route::patch('/users/{user}/reject', [UserController::class, 'reject'])
        ->name('users.reject');

    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])
        ->name('users.reset-password');
});

require __DIR__ . '/auth.php';
