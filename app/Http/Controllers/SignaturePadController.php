<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Agency;
use App\Models\VisitCode;
use App\Models\Setting;
use App\Models\TodaySchedule;
use App\Models\TodayVisit;

class SignaturePadController extends Controller
{
    public function index($id)
    {
        // $visit_id = $request->visit_id;
        $patients = Patient::all();
        $patientName =  [];
        
        foreach($patients as $patient) {
          $patientName[$patient->id] = $patient->name;
        }
  

        $visit = TodayVisit::find($id);
        // $visit =
        return view('content.nurse.signature-pad', compact('visit', 'patientName'));
    }
    public function getImage($id)
    {
        // $visit_id = $request->visit_id;

        $visit = TodayVisit::find($id);
        return response()->file($visit->sign_url);
        // $visit =
    }

    public function upload(Request $request)
    {
        $folderPath = public_path('upload/');
        
        $image_parts = explode(";base64,", $request->signed);
        
        $image_type_aux = explode("image/", $image_parts[0]);
        
        $image_type = $image_type_aux[1];
        
        $image_base64 = base64_decode($image_parts[1]);
 
        $signature = uniqid() . '.'.$image_type;
        
        $file = $folderPath . $signature;
 
        file_put_contents($file, $image_base64);
 
        // $save = new Signature;
        // $save->name = $request->name;
        // $save->signature = $signature;
        // $save->save();
        $visit = TodayVisit::find($request->id);
        if($visit->is_signed) {
            unlink($visit->sign_url);
        }
        TodayVisit::find($request->id)->update([
            'is_signed'=>'1', 
            'sign_time'=>date('Y-m-d H:i:s'), 
            'sign_url'=>$file
        ]);
        session()->flash("success", "added successfully.");
        return redirect()->route('today-signing');

    }
}
