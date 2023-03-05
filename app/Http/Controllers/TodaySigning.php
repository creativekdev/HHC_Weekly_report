<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodaySigning extends Controller
{
    public function index()
    {
      return view('content.nurse.today-signing');
    }
}
