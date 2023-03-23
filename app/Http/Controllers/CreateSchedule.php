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
      $setting = Setting::where('date', date("1994-4-12"))->first();
      // echo json_encode($setting);
      // die();
      if(is_null($setting)) {
        $setting = (object)array('date'=> date("Y-m-d"), 'start_time'=>"06:30", "end_time"=>"18:30", "average_travel_time"=>"15");
      }
      // echo json_encode($setting);
      // die();
      $havetoSave =  false;
      if(count($todaySchedule) == 0) {
        $lastDate = TodaySchedule::max('date');
        $lastSchedule = TodaySchedule::where('date', $lastDate)->get();
        $issaved = true;
        foreach($lastSchedule as $schedule) {
          if(!$schedule->issaved) $issaved = false;
        }
        if(!$issaved){
          session()->flash("error", "Please save previouse schedule.(".$lastDate.")");
          $todaySchedule = $lastSchedule;
          $havetoSave = true;
        }
      }
      return view('content.nurse.create-schedule',  compact('patients', 'agencis', 'visitcodes', 'setting','todaySchedule','patientName','havetoSave'));
    }

    public function applySetting(Request $request) {
      $param = $request->except('_token');
      // Validation for required fields (and using some regex to validate our numeric value)
      $request->validate([
          'start_time'=>'required',
          'end_time'=>'required',
          'average_travel_time'=>'required'
      ]);
      $setting = Setting::where('date', date("1994-4-12"))->first();
      // echo json_encode($setting);
      // return;
      if(isset($setting->id)) {
        $setting->start_time = $param['start_time'];
        $setting->end_time = $param['end_time'];
        $setting->average_travel_time = $param['average_travel_time'];
        $setting->save();
      } else {
        $param['date'] = date("1994-4-12");
        Setting::create($param);
      }
      
      $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();

      $date = date("Y-m-d");
      $havetoSave =  false;
      if(count($todaySchedule) == 0) {
        $lastDate = TodaySchedule::max('date');
        $lastSchedule = TodaySchedule::where('date', $lastDate)->get();
        $issaved = true;
        foreach($lastSchedule as $schedule) {
          if(!$schedule->issaved) $issaved = false;
        }
        if(!$issaved){
          $havetoSave = true;
          $date = $lastDate;
        }
      }


      $res  = $this->alignment($date);
      $isok = $res['isok'];
      $result_box = $res['result_box'];

      if($isok){
        session()->flash("success", "applied successfully.");
        return redirect()->back()->with('box', $result_box );
      }
      else{
        session()->flash("error", "Applied successfully.But can not Schedule! Please control params.");  
        return redirect()->back();
      }
      
    }

    public function addPatient(Request $request) {
      // echo json_encode($request->id);

      $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();
      $date = date("Y-m-d");
      $havetoSave =  false;
      if(count($todaySchedule) == 0) {
        $lastDate = TodaySchedule::max('date');
        $lastSchedule = TodaySchedule::where('date', $lastDate)->get();
        $issaved = true;
        foreach($lastSchedule as $schedule) {
          if(!$schedule->issaved) $issaved = false;
        }
        if(!$issaved){
          $havetoSave = true;
          $date = $lastDate;
        }
      }
      // die();
      $request->validate([
        'id'=>'required'
      ]); 
      $param = $request->except('_token');
      // Validation for required fields (and using some regex to validate our numeric value)
      // $patient = Patient::find('id');
      // $visitcode = VisitCode::all();
      $visitcodes = VisitCode::all();
      $visitcode = "";
      foreach($visitcodes as $v) {
        $visitcode = $v->visit_code;
        break;
      }
      $patientForSchedule = [
        "patient_id"=>$request->id, 
        "date"=>$date,
        "root"=>-1,
        "visit_times"=>1, 
        "visit_code"=>$visitcode, 
        "visit_interval"=>15,
        "specific_time"=>"06:30", 
        "is_signed"=>"0",
        "issaved"=>"0", 
        "isrepeated"=>"0", 
        "isspecific_time"=>false
      ];
      // echo json_encode($setting);
      // return;
      TodaySchedule::create($patientForSchedule);

      $res  = $this->alignment($date);
      $isok = $res['isok'];
      $result_box = $res['result_box'];

      if($isok){
        session()->flash("success", "Added Success fully");
        return redirect()->back()->with('box', $result_box );
      }
      else{
        session()->flash("error", "Can not Schedule! Please control params.");  
        return redirect()->back();
      }

      // return redirect()->back();
    }

    public function alignment($date) {
      $setting = Setting::where('date', date("1994-4-12"))->first();
      if(is_null($setting)){
        session()->flash("error", "Please apply setting for today.");
        return redirect()->back();
      }
      $schedules = TodaySchedule::where('date', $date)->get();

      $start_time =  round(strtotime($setting->start_time) / 60);
      $end_time = round(strtotime($setting->end_time) / 60);
      $average_travel_time = $setting->average_travel_time;
      $scheduleByID = [];
      for($k = 0; $k < count($schedules); $k++) {
        $scheduleByID[$schedules[$k]->id] = $schedules[$k];
      }

      $box = [];
      $isok = true;
      for($time = $start_time - $average_travel_time; $time <= $end_time + $average_travel_time; $time +=1) $box[$time] = -1;
      $vst = [];
      for($k = 0; $k < count($schedules); $k++) 
      {
        $vst[$schedules[$k]->id] = false;
      }
      //////////////////specific time placement///////////////////////////////
      $prev_patient_id = null;
      for($k = 0; $k < count($schedules); $k++) {        
        if($vst[$schedules[$k]->id]) continue;
        if($schedules[$k]->root != -1) continue;
        if($schedules[$k]->isspecific_time){
          $specific_time = round(strtotime($schedules[$k]->specific_time) / 60);
          $kk = $k;
          $interval = 0;
          for($kk = $k; $kk<count($schedules); $kk++) {
            if($schedules[$kk]->patient_id != $schedules[$k]->patient_id) break;
            $vst[$schedules[$kk]->id] = true;
            $interval += $schedules[$kk]->visit_interval;
          }
          
          for($i = -$average_travel_time; $i < $interval + $average_travel_time; $i++) {
            $ii = $specific_time + $i;
            if(!array_key_exists($ii, $box)){
              $isok = false;
              break;
            }
            if($box[$ii] >= 0) $isok = false;
            if($i>=0 && $i < $interval )
            {
              $subinterval = 0;
              for($selK = $k; $selK < count($schedules) && $subinterval + $schedules[$selK]->visit_interval  < $i; $selK++) $subinterval += $schedules[$selK]->visit_interval;
              $box[$ii] = $schedules[$selK]->id;
            }
            else  $box[$ii] = 0;
          }
        }

        $prev_patient_id = $schedules[$k]->id;

      }
      //place several visit times
      $prev_patient_id = null;
      for($k = 0; $k < count($schedules); $k++) {
        if($vst[$schedules[$k]->id]) continue;
        if($schedules[$k]->root != -1) continue;
        if($schedules[$k]->visit_times > 1) {

          $childs = [];
          $child_cnt = 0;
          for($kk = 0; $kk < count($schedules); $kk++) {
            if($schedules[$kk]->root == $schedules[$k]->id) $childs[$child_cnt++] = $schedules[$kk];
          }

          $delta = round(24 / $schedules[$k]->visit_times);
          $vst[$schedules[$k]->id] = true;
          
          $interval = $schedules[$k]->visit_interval;
  
          $findedPos = -1;
          for($time = $start_time; $time + $delta*60 <= $end_time; $time +=1){

            if($box[$time] >= 0) continue;
            // if(!array_key_exists($time - 8*60*60, $box)) continue;

            if($box[$time +  $delta*60] >= 0) continue;
            
            $cnt = 0;
            while($cnt < $interval) {
              $ii = $time + $cnt;
              $jj = $time + $delta*60 + $cnt;
              if(!array_key_exists($ii, $box)) break;
              if(!array_key_exists($jj, $box)) break;
              if($box[$ii] >= 0) break;
              if($box[$jj] >= 0) break;

              $cnt++;
            }
    
            if($cnt >= $interval){
              $findedPos = $time;
              break;
            }

          };
          if($findedPos > 0) {
  
            // for($time = $findedPos - 10; $time<$findedPos + $schedule->visit_interval +10; $time++) {
            //   if($time >=$findedPos && $time < $findedPos + $schedule->visit_interval) $box[$time] = $schedule->id;
            //   else $box[$time] = 0;
            // }
            for($i = -$average_travel_time; $i < $interval + $average_travel_time; $i++) {
              $ii = $findedPos + $i;
              $jj = $findedPos + $i +  $delta*60;
              if(!array_key_exists($ii, $box)){
                $isok = false;
                break;
              }
              if(!array_key_exists($jj, $box)){
                $isok = false;
                break;
              }
  
  
              if($i>=0 && $i < $interval )
              {
                if($box[$ii] >= 0) $isok = false;
                if($box[$jj] >= 0) $isok = false;
                $box[$ii] = $schedules[$k]->id;
                $box[$jj] = $childs[0]->id;
              }
              else  $box[$ii] = 0;
            }
            
          }
          else{
            $isok = false;
          }
        }
      }
      //placement
      for($k = 0; $k < count($schedules); $k++) {

        if($vst[$schedules[$k]->id]) continue;

  
        if($schedules[$k]->root != -1) continue;

        $interval = 0;
        for($kk = $k; $kk < count($schedules); $kk++) {
          if($schedules[$kk]->root != -1) continue;
          if($schedules[$kk]->patient_id != $schedules[$k]->patient_id) break;
          $vst[$schedules[$kk]->id] = true;
          $interval += $schedules[$kk]->visit_interval;

        }

        $findedPos = -1;
        for($time = $start_time; $time <= $end_time; $time +=1){
          if($box[$time] >= 0) continue;
                      
          $cnt = 0;
          while($cnt < $interval) {
            $ii = $time + $cnt;
            if(!array_key_exists($ii, $box)){
              break;
            }  
            if($box[$ii] >= 0) break;
            $cnt++;
          }
  
          if($cnt >= $interval){
            $findedPos = $time;
            break;
          }
        };
        if($findedPos > 0) {

          // for($time = $findedPos - 10; $time<$findedPos + $schedule->visit_interval +10; $time++) {
          //   if($time >=$findedPos && $time < $findedPos + $schedule->visit_interval) $box[$time] = $schedule->id;
          //   else $box[$time] = 0;
          // }
          for($i = -$average_travel_time; $i < $interval + $average_travel_time; $i++) {
            $ii = $findedPos + $i;
            if(!array_key_exists($ii, $box)){
              $isok = false;
              break;
            }


            if($i>=0 && $i < $interval )
            {
              if($box[$ii] >= 0)
              {
                $isok = false;
              }              
              $subinterval = 0;
              for($selK = $k; $selK < count($schedules) && $subinterval + $schedules[$selK]->visit_interval  < $i; $selK++)
              {
                if($schedules[$selK]->root != -1) continue;
                $subinterval += $schedules[$selK]->visit_interval;
              }
              while($selK < count($schedules) && $schedules[$selK]->root != -1) $selK++;
              $box[$ii] = $schedules[$selK]->id;
            }
            else  $box[$ii] = 0;
          }
          
        }
        else{
          $isok = false;
        }
      }
      // echo json_encode($isok);
      // die();

      $result_box = [];
      for($time = $start_time; $time <= $end_time; $time +=1) $result_box[$time] = $box[$time];

      return ['isok'=>$isok, 'result_box'=>$result_box];
    }

    public function saveSchedule(Request $request) {
      $date = date("Y-m-d");
      $schedules = TodaySchedule::where('date', date("Y-m-d"))->get();      

      $havetoSave =  false;
      if(count($schedules) == 0) {
        $lastDate = TodaySchedule::max('date');
        $lastSchedule = TodaySchedule::where('date', $lastDate)->get();
        $issaved = true;
        foreach($lastSchedule as $schedule) {
          if(!$schedule->issaved) $issaved = false;
        }
        if(!$issaved){
          $schedules = $lastSchedule;
          $havetoSave = true;
          $date = $lastDate;
        }
      }
      
      foreach($schedules as $sche){
        if(!$sche->is_signed) {
          session()->flash("error", "Please sign missed visits.");  
          return redirect()->back();
        }
      }

      $res  = $this->alignment($date);
      $isok = $res['isok'];
      $result_box = $res['result_box'];
      // $box = [];
      // for($time = $start_time - 10; $time <= $end_time + 10; $time +=1) $box[$time] = -1;
      $setting = Setting::where('date', date("1994-4-12"))->first();

      $start_time =  round(strtotime($setting->start_time) / 60);
      $end_time = round(strtotime($setting->end_time) / 60);
      // $schedules = TodaySchedule::where('date', $date)->get();
      $scheduleByID = [];
      for($k = 0; $k < count($schedules); $k++) {
        $scheduleByID[$schedules[$k]->id] = $schedules[$k];
      }



      if($isok){
        $setting = TodaySchedule::where('date', $date)->update(['issaved'=>"1"]);

        // $visits = TodayVisit::where('date', $today)->get();

        // foreach($visits as $visit)
        // {
        //   if($visit->is_signed) {
        //     unlink($visit->sign_url);
        //   }
        // }

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

        TodayVisit::where('date', $date)->delete();

        foreach($todaySchedule as $sche) {
          TodayVisit::create([
            'date'=>$date, 
            'patient_id'=>$sche->patient_id, 
            'schedule_id'=>$sche->id, 
            'visit_code'=>$sche->visit_code,
            'visit_interval'=>$sche->visit_interval,               
            'is_signed'=>$sche->is_signed,
            'sign_time'=>$sche['end_time'],
            'sign_url'=>$sche->sign_url
          ]);

        }

        $res  = $this->alignment(date("Y-m-d"));
        $isok = $res['isok'];
        $result_box = $res['result_box'];
        session()->flash("success", "Saved Success fully");
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



      $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();
      $date = date("Y-m-d");
      $havetoSave =  false;
      if(count($todaySchedule) == 0) {
        $lastDate = TodaySchedule::max('date');
        $lastSchedule = TodaySchedule::where('date', $lastDate)->get();
        $issaved = true;
        foreach($lastSchedule as $schedule) {
          if(!$schedule->issaved) $issaved = false;
        }
        if(!$issaved){
          $todaySchedule = $lastSchedule;
          $havetoSave = true;
          $date = $lastDate;
        }
      }

      $cnt = 0;
      foreach($todaySchedule as $sched){
        if($sched->root == $request->id) $cnt++;
        if($cnt > 0 && $cnt > $stock->visit_times - 1) TodaySchedule::where('id', $sched->id)->delete();
      }
      for(;$cnt < $stock->visit_times - 1;$cnt++) {
        $patientForSchedule = [
          "patient_id"=>$request->get('patient_id'), 
          "date"=> $request->get('date'),
          "root"=>$request->id,
          "visit_times"=>$request->get('visit_times'), 
          "visit_code"=>$request->get('visit_code'), 
          "visit_interval"=>$request->get('visit_interval'),
          "specific_time"=>"06:30", 
          "is_signed"=>"0",
          "issaved"=>"0", 
          "isrepeated"=>"0", 
          "isspecific_time"=>false
        ];
        // echo json_encode($setting);
        // return;
        TodaySchedule::create($patientForSchedule);
      }

      $res  = $this->alignment($date);
      $isok = $res['isok'];
      $result_box = $res['result_box'];

      if($isok){
        $today = date("Y-m-d");
        // $setting = TodaySchedule::where('date', $today)->update(['issaved'=>"1"]);

        session()->flash("success", "appied successfully.");
        return redirect()->back()->with('box', $result_box );
      }
      else{
        session()->flash("error", "Can not Schedule! Please control params.");  
        return redirect()->back();
      }

    }

    public function destroySchedule(Request $request)
    {
        $patient = TodaySchedule::find($request->id);
        $patient->delete();
        // session()->flash("success", "deleted successfully.");
        $todaySchedule = TodaySchedule::where('date', date("Y-m-d"))->get();
        $date = date("Y-m-d");
        $havetoSave =  false;
        if(count($todaySchedule) == 0) {
          $lastDate = TodaySchedule::max('date');
          $lastSchedule = TodaySchedule::where('date', $lastDate)->get();
          $issaved = true;
          foreach($lastSchedule as $schedule) {
            if(!$schedule->issaved) $issaved = false;
          }
          if(!$issaved){
            $havetoSave = true;
            $date = $lastDate;
          }
        }

        $res  = $this->alignment($date);
        $isok = $res['isok'];
        $result_box = $res['result_box'];
  
        if($isok){
          session()->flash("success", "Deleted Successfully");
          return redirect()->back()->with('box', $result_box );
        }
        else{
          session()->flash("error", "Can not Schedule! Please control params.");  
          return redirect()->back();
        }
  
        return redirect()->back();
    }

}
