<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('cabinet.dashboard', compact('user'));
    }
}
