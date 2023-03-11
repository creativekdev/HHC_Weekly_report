<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Agency;
use App\Models\VisitCode;
use App\Models\Setting;
use App\Models\TodaySchedule;
use App\Models\TodayVisit;

class TodaySigning extends Controller
{
    public function index()
    {
      $patients = Patient::all();
      $agencis = Agency::all();
      $visitcodes = VisitCode::all();
      $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();
      $todayVisits = TodayVisit::where('date', date("Y-m-d"))->get();
      $patientName =  [];
      
      foreach($patients as $patient) {
        $patientName[$patient->id] = $patient->name;
      }

      $setting = Setting::where('date', date("Y-m-d"))->first();
      return view('content.nurse.today-signing', compact('patients', 'agencis', 'visitcodes', 'setting','todaySchedule','todayVisits', 'patientName'));
    }
}
