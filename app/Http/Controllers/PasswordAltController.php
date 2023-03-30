<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordAltController extends Controller
{
    public function index()
    {
        return view('password.password');
    }
}
