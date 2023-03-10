<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Agency;
use App\Models\VisitCode;
use App\Models\TodayVisit;
use View;

class ManagerSetting extends Controller
{
    public function index()
    {
      $patients = Patient::all();
      $agencis = Agency::all();
      $visitcodes = VisitCode::all();
      $todayvisits = TodayVisit::select('date')->distinct()->get();
      $patient_array = [];
      foreach($agencis as $agency) {
        $patient_array[$agency->id] = $agency;
      }
      $weeks = [];
      foreach($todayvisits as $visit) {
        if(date('w', strtotime($visit->date)) == '6') {
          array_push($weeks, date('m/d/Y',strtotime($visit->date)));
        }
      }

      if(date('w') != '6') {
        array_push($weeks, date("m/d/Y"));
      }

      return view('content.nurse.manage-setting', compact('patients', 'agencis', 'visitcodes', 'weeks', 'patient_array'));
    }

    // public function savePatient(Request $request) 
    // {
    //   $param = $request->except('_token');
    //   // echo gettype($request->all());
    //   // die();
    //   // $this->validate($param, [
    //   //   'name' => 'required'
    //   // ]);      
    //   Patient::create($param);
    //   session()->flash("success", "saved successfully.");
    //   return redirect()->route('manager-setting');
    // }
    public function getDoc(Request $request){
      // echo json_encode($request->get('patient_id'));
      $patient_id = $request->get('patient_id');
      $week = $request->get('week');
      // echo json_encode($week);
      // die();
      if(!is_null($week)){
        $sunday = date('Y-m-d',strtotime($week) + ( 0 - date('w', strtotime($week)))*24*3600);
        $saturday = date('Y-m-d',strtotime($week) + ( 6 - date('w', strtotime($week)))*24*3600);
      }
      else{
        $sunday = date('Y-m-d', time() +  0 - date('w')*24*3600);
        $saturday = date('Y-m-d',time() + ( 6 - date('w'))*24*3600);
      }
      
      $todayvisits = TodayVisit::all();
      $patients = Patient::all();
      $patient_array = [];
      foreach($patients as $patient) {
        $patient_array[$patient->id] = $patient;
        // array_push($patient_array, [$patient->id => $patient]);
      }
      $data = [];
      foreach($todayvisits as $visit) {
        if(!is_null($patient_id) && $patient_id != $visit->patient_id ) continue;
        $date = date('Y-m-d',strtotime($visit->date));
        if($date < $sunday || $saturday < $date) continue;
        if(!$visit->is_signed) continue;
        // echo json_encode($patient_array[$patient->id]);
        // die();
        $visit->day = strtoupper(substr(date('l',strtotime($visit->date))."",0, 3));
        $visit->date = date('n/d',strtotime($visit->date));
        $visit->time_in = date('g:i a',strtotime($visit->sign_time) - $visit->visit_interval * 60);
        $visit->time_out = date('g:i a',strtotime($visit->sign_time));
        array_push($data, $visit);
      }

      $view = View::make('content.nurse.report',['visits'=>$data, 'patient_array'=>$patient_array])->render();
      // $file_name = strtotime(date('Y-m-d H:i:s')) . '_advertisement_template.docx';
      $headers = array(
          "Content-type"=>"text/html",
          "Content-Disposition"=>"attachment;Filename=".date("Y-m-d").".doc"
      );

      return response()->make($view, 200, $headers);    
    }
}
