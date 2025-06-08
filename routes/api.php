<?php

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/pengumuman/baru', [PengumumanController::class, 'pengumumanBaru']);
