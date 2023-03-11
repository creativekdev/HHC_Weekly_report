<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Agency;
use App\Models\VisitCode;
use App\Models\Setting;
use App\Models\TodaySchedule;
use App\Models\TodayVisit;

class CreateSchedule extends Controller
{
    public function index()
    {
      $patients = Patient::all();
      $patientName =  [];
      foreach($patients as $patient) {
        $patientName[$patient->id] = $patient->name;
      }
      $agencis = Agency::all();
      $visitcodes = VisitCode::all();
      $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();
      $setting = Setting::where('date', date("Y-m-d"))->first();
      // echo json_encode($setting);
      // die();
      if(is_null($setting)) {
        $setting = (object)array('date'=> date("Y-m-d"), 'start_time'=>"06:30", "end_time"=>"18:30", "average_travel_time"=>"15");
      }
      // echo json_encode($setting);
      // die();
      
      return view('content.nurse.create-schedule',  compact('patients', 'agencis', 'visitcodes', 'setting','todaySchedule','patientName'));
    }

    public function applySetting(Request $request) {
      $param = $request->except('_token');
      // Validation for required fields (and using some regex to validate our numeric value)
      $request->validate([
          'start_time'=>'required',
          'end_time'=>'required',
          'average_travel_time'=>'required'
      ]);
      $setting = Setting::where('date', date("Y-m-d"))->first();
      // echo json_encode($setting);
      // return;
      if(isset($setting->id)) {
        $setting->start_time = $param['start_time'];
        $setting->end_time = $param['end_time'];
        $setting->average_travel_time = $param['average_travel_time'];
        $setting->save();
      } else {
        $param['date'] = date("Y-m-d");
        Setting::create($param);
      }
      
      
      session()->flash("success", "applied successfully.");
      return redirect()->back();
    }

    public function addPatient(Request $request) {
      $request->validate([
        'id'=>'required'
      ]);
      $param = $request->except('_token');
      // Validation for required fields (and using some regex to validate our numeric value)
      // $patient = Patient::find('id');
      // $visitcode = VisitCode::all();
      
      $patientForSchedule = [
        "patient_id"=>$request->id, 
        "date"=>date("Y-m-d"),
        "visit_times"=>1, 
        "visit_code"=>"", 
        "visit_interval"=>15,
        "specific_time"=>"06:30", 
        "issaved"=>"0", 
        "isrepeated"=>"0", 
        "isspecific_time"=>false
      ];
      // echo json_encode($setting);
      // return;
      TodaySchedule::create($patientForSchedule);
      return redirect()->back();
    }
    public function saveSchedule(Request $request) {
      
      // $interval = $setting->end_time - $setting->start_time;
      
      // $isfirst = true;
      // foreach($schedules as $schedule) {
      //   $sum_interval += $schedule->visit_interval;
      //   (!$isfirst) $sum_interval += $setting->
      //   $isfirst = false;
      // }
      $setting = Setting::where('date', date("Y-m-d"))->first();
      if(is_null($setting)){
        session()->flash("error", "Please apply setting for today.");  
        return redirect()->back();
      }
      $schedules = TodaySchedule::where('date', date("Y-m-d"))->orderBy('visit_interval','DESC')->get();      
      $start_time =  round(strtotime($setting->start_time) / 60);
      $end_time = round(strtotime($setting->end_time) / 60);
      $scheduleByID = [];
      foreach($schedules as $schedule) {
        $scheduleByID[$schedule->id] = $schedule;
      }
      $box = [];
      $isok = true;
      for($time = $start_time - 10; $time <= $end_time + 10; $time +=1) $box[$time] = -1;
      // $vst = [];
      // foreach($schedules as $schedule) $vst[$schedule->id] = false;
      foreach($schedules as $schedule) {
        if($schedule->isspecific_time){
          $vst[$schedule->id] = true;
          $specific_time = round(strtotime($schedule->specific_time) / 60);
          for($i = -10; $i < $schedule->visit_interval + 10; $i++) {
            $ii = $specific_time + $i;
            if(!array_key_exists($ii, $box)){
              $isok = false;
              break;
            }
            if($box[$ii] >= 0) $isok = false;
            if($i>=0 && $i <$schedule->visit_interval ) $box[$ii] = $schedule->id;
            else  $box[$ii] = 0;
          }
        }
      }
      //placement
      foreach($schedules as $schedule) {
        if(!$schedule->isspecific_time){
          $findedPos = -1;
          for($time = $start_time; $time <= $end_time; $time +=1){
            if($box[$time] >= 0) continue;
            $cnt = 0;
            while($cnt < $schedule->visit_interval) {
              $ii = $time + $cnt;
              if(!array_key_exists($ii, $box)){
                break;
              }  
              if($box[$ii] >= 0) break;
              $cnt++;
            }
            if($cnt >= $schedule->visit_interval){
              $findedPos = $time;
              break;
            }
          };
          if($findedPos > 0) {
            for($time = $findedPos - 10; $time<$findedPos + $schedule->visit_interval +10; $time++) {
              if($time >=$findedPos && $time < $findedPos + $schedule->visit_interval) $box[$time] = $schedule->id;
              else $box[$time] = 0;
            }            
          }
          else{
            $isok = false;
          }
        }
      }
      $result_box = [];
      for($time = $start_time; $time <= $end_time; $time +=1) $result_box[$time] = $box[$time];
      // echo json_encode($box);
      // die();
      if($isok){
        $today = date("Y-m-d");
        $setting = TodaySchedule::where('date', $today)->update(['issaved'=>"1"]);

        $visits = TodayVisit::where('date', $today)->get();

        foreach($visits as $visit)
        {
          if($visit->is_signed) {
            unlink($visit->sign_url);
          }
        }
        TodayVisit::where('date', $today)->delete();


        $isfirst = true;      
        for($time = $start_time; $time <= $end_time; ){
          if($box[$time]>0) {
            $schedule = $scheduleByID[$box[$time]];
            // echo json_encode($schedule->patient_id);
            // die();

            TodayVisit::create([
              'date'=>$today, 
              'patient_id'=>$schedule->patient_id, 
              'schedule_id'=>$schedule->id, 
              'visit_code'=>$schedule->visit_code,
              'visit_interval'=>$schedule->visit_interval,      
              'is_signed'=>'0'
            ]);
            $cur = $box[$time];
            while($time <= $end_time && $box[$time] == $cur) $time++;
          }
          else{
            $time++;
          }
        }

        session()->flash("success", "saved successfully.");
        return redirect()->back()->with('box', $result_box );
      }
      else{
        session()->flash("error", "Can not Schedule! Please control params.");  
        return redirect()->back();
      }
    }
    public function updateSchedule(Request $request){
      $request->validate([
        'id'=>'required'
      ]);
      // echo json_encode($request->input());
      // die();
      $stock = TodaySchedule::find($request->id);
      // Getting values from the blade template form
      $stock->date =  $request->get('date');
      $stock->patient_id =  $request->get('patient_id');
      $stock->visit_times =  $request->get('visit_times');
      $stock->visit_code =  $request->get('visit_code');
      $stock->visit_interval =  $request->get('visit_interval');
      $stock->specific_time =  $request->get('specific_time');
      $stock->issaved =  "0";
      $stock->isrepeated =  $request->get('isrepeated');
      $stock->isspecific_time =  $request->get('isspecific_time');
      if(is_null($stock->isspecific_time)) $stock->isspecific_time = "0";

      $stock->save();
      session()->flash("success", "appied successfully.");
      return redirect()->back();
    }

    public function destroySchedule(Request $request)
    {
        $patient = TodaySchedule::find($request->id);
        $patient->delete();
        session()->flash("success", "deleted successfully.");
        return redirect()->back();
    }

}
