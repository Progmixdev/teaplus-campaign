<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignController;


Route::get('/', [CampaignController::class, 'index'])->name('campaign.index');
Route::post('campaign/store', [CampaignController::class, 'store'])->name('campaign.store')->middleware('throttle:10,1');
