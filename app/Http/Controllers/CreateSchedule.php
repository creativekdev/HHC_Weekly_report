<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateSchedule extends Controller
{
    public function index()
    {
      return view('content.nurse.create-schedule');
    }
}
