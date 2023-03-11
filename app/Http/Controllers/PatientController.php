<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
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
            'name'=>'required',
            'address'=>'required',
            'clinical_record'=>'required',
            'agency_id'=>'required',

        ]);         
        Patient::create($param);
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
        return redirect()->route('manager-setting');
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
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'clinical_record'=>'required',
            'agency_id'=>'required',            
        ]);         
        $stock = Patient::find($id);
        // Getting values from the blade template form
        $stock->name =  $request->get('name');
        $stock->address =  $request->get('address');
        $stock->clinical_record =  $request->get('clinical_record');
        $stock->agency_id =  $request->get('agency_id');
        $stock->save();
        session()->flash("success", "saved successfully.");
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
        $patient = Patient::find($id);
        $patient->delete();
        session()->flash("success", "deleted successfully.");
        return redirect()->back();
    }
}
