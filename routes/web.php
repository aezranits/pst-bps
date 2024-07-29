<?php

use App\Livewire\FeedBackPage;
use App\Livewire\GuestBookPage;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class);
Route::get('/buku-tamu', GuestBookPage::class);
Route::get('/feedback', FeedBackPage ::class)->name('feedback');;
