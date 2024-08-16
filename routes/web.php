<?php

use App\Livewire\AboutUs;
use App\Livewire\FeedBackPage;
use App\Livewire\GuestBookPage;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/buku-tamu', GuestBookPage::class);
Route::get('/feedback', FeedBackPage ::class)->name('feedback');;
Route::get('/about-us', AboutUs ::class)->name('feedback');;
