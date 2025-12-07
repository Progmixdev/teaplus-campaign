<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');
