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
        // echo json_encode($request);
        // die();

        $param = $request->except('_token');
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'agency_name'=>'required',
            'employee_id'=>'required'
        ]);         
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
        $patient = Agency::find($id);
        $patient->delete();
        session()->flash("success", "deleted successfully.");
        return redirect()->back();
    }
}
