<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LandlordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;
use App\Http\Controllers\WhatsAppController;

Route::post('/whatsapp/webhook', [WhatsAppController::class, 'webhook']);

// Homepage
Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/terms', 'terms')->name('terms');

Route::middleware(['auth','landlord'])->group(function () {
    Route::post('/landlord/notifications/{id}/read', function($id) {
        $note = Auth::user()->notifications()->findOrFail($id);
        $note->markAsRead();
        return back();
    })->name('landlord.notifications.read');
});

Route::middleware(['auth','landlord'])->group(function () {
    Route::post('/landlord/requests/{id}/approve', [LandlordController::class, 'approveRequest'])
        ->name('landlord.requests.approve');

    Route::post('/landlord/requests/{id}/reject', [LandlordController::class, 'rejectRequest'])
        ->name('landlord.requests.reject');
});


Route::middleware(['auth'])->group(function () {
    Route::post('/student/like/{property}', [PropertyController::class, 'likeProperty'])->name('student.like');
    Route::post('/student/request/{property}', [PropertyController::class, 'requestProperty'])->name('student.request');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/student/preferences', [ProfileController::class, 'preferences'])->name('student.preferences');
    Route::post('/student/preferences', [ProfileController::class, 'updatePreferences']);
});

Route::middleware(['auth'])->group(function () {
    Route::patch('/student/update-profile', [ProfileController::class, 'updateProfile'])->name('student.updateProfile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/student/change-password', [ProfileController::class, 'editPassword'])->name('student.changePassword');
    Route::patch('/student/change-password', [ProfileController::class, 'updatePassword'])->name('student.updatePassword');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [PropertyController::class, 'studentDashboard'])
        ->name('student.dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'landlord'])->group(function () {
    Route::get('/landlord/dashboard', [LandlordController::class, 'index'])->name('landlord.dashboard');
    Route::get('/landlord/properties/create', [LandlordController::class, 'create'])->name('landlord.properties.create');
    Route::post('/landlord/properties', [LandlordController::class, 'store'])->name('landlord.properties.store');
    Route::get('/landlord/properties/{property}/edit', [LandlordController::class, 'edit'])->name('landlord.properties.edit');
    Route::patch('/landlord/properties/{property}', [LandlordController::class, 'update'])->name('landlord.properties.update');
    Route::delete('/landlord/properties/{property}', [LandlordController::class, 'destroy'])->name('landlord.properties.destroy');
});


Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/submit', [ContactController::class, 'submit'])
    ->name('contact.submit');

Route::get('/dashboard', function () {
    return view('student.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // ✅ home page
})->name('logout');

Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();   // ✅ clear admin guard
    Auth::logout();                   // optional: clear default guard too
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('filament.admin.auth.logout');


// Route::post('/whatsapp/webhook', function (Request $request) {
//     Log::info('WhatsApp webhook:', $request->all());

//     $message = $request->input('Body'); // Twilio sends message body here
//     $from = $request->input('From');

//     // Example: simple auto-reply
//     return response("Hello! You said: $message");
// });



// Route::post('/whatsapp/webhook', [WhatsAppController::class, 'webhook']);
// Route::get('/whatsapp/test', function () {
//     app(WhatsAppController::class)
//         ->sendWhatsAppMessage('+263717958363', 'Hello from CampusStay!');
// });

Route::get('/webhook', [WhatsAppController::class, 'verify']);

Route::post('/webhook', [WhatsAppController::class, 'receive']);







require __DIR__.'/auth.php';
