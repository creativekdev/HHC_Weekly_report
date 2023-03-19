<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Agency;
use App\Models\VisitCode;
use App\Models\Setting;
use App\Models\TodaySchedule;
use App\Models\TodayVisit;
use App\Http\Controllers\CreateSchedule;


class TodaySigning extends Controller
{
    public function index()
    {
      $patients = Patient::all();
      $agencis = Agency::all();
      $visitcodes = VisitCode::all();
      // $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();
      $todayVisits = TodayVisit::where('date', date("Y-m-d"))->get();
      $patientName =  [];
      
      $res  = (new CreateSchedule)->alignment();
      $isok = $res['isok'];
      $result_box = $res['result_box'];
      // $box = [];
      // for($time = $start_time - 10; $time <= $end_time + 10; $time +=1) $box[$time] = -1;
      $setting = Setting::where('date', date("1994-4-12"))->first();

      $start_time =  round(strtotime($setting->start_time) / 60);
      $end_time = round(strtotime($setting->end_time) / 60);
      $org_schedules = TodaySchedule::where('date', date("Y-m-d"))->get();
      $scheduleByID = [];
      for($k = 0; $k < count($org_schedules); $k++) {
        $scheduleByID[$org_schedules[$k]->id] = $org_schedules[$k];
      }
      $todaySchedule = [];
      for($time = $start_time; $time <= $end_time; ){
        if($result_box[$time]>0) {
          $sche = $scheduleByID[$result_box[$time]];
          $sche["start_time"] = date('H:i', $time * 60);
          array_push($todaySchedule, $sche);
          $cur = $result_box[$time];
          while($time <= $end_time && $result_box[$time] == $cur) $time++;
          $sche["end_time"] = date('H:i', $time * 60);;
        }
        else{
          $time++;
        }
    }

      foreach($patients as $patient) {
        $patientName[$patient->id] = $patient->name;
      }

      $setting = Setting::where('date', date("Y-m-d"))->first();
      return view('content.nurse.today-signing', compact('patients', 'agencis', 'visitcodes', 'setting','todaySchedule','todayVisits', 'patientName'));
    }
}
