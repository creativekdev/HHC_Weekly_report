<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->except('_token');
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'agency_name'=>'required',
            'employee_id'=>'required',
            // 'avatar' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        // echo json_encode($request->avatar->getClientOriginalName());
        // die();
        if(!is_null($request->avatar)){
            $imageName = time().'.'.$request->avatar->extension();    
            // var_dump($imageName);
            $request->avatar->move(public_path('images'), $imageName);
            $param['avatar']  = $imageName;
            // var_dump($param);
            // die();
                
        }
        Agency::create($param);
        session()->flash("success", "added successfully.");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'agency_name'=>'required',
            'employee_id'=>'required'        
        ]);         
        $stock = Agency::find($id);
        // Getting values from the blade template form
        $stock->agency_name =  $request->get('agency_name');
        $stock->employee_id =  $request->get('employee_id');
        if(!is_null($request->avatar)){
            if($stock->avatar != null) {
                unlink(public_path('images').'/'.$stock->avatar);
            }
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('images'), $imageName);
            $stock->avatar  = $imageName;
        }
        $stock->save();
        session()->flash("success", "updated successfully.");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Agency::find($id);
        $patient->delete();
        session()->flash("success", "deleted successfully.");
        return redirect()->back();
    }
}
