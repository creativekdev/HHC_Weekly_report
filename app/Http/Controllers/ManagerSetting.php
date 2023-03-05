<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerSetting extends Controller
{
    public function index()
    {
      return view('content.nurse.manage-setting');
    }
}
