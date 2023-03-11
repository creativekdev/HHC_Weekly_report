@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Setting')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">Manager setting interface</h4>

<!-- Examples -->
<div class="row mb-5">
<!-- @include('content.nurse.flash-message')   -->
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="col-md-12 col-lg-12 mb-4">
        <div class = "card">
            <h5 class="card-header">Patients List</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Clinical Record</th>
                            <th>Agency name</th>
                            <th style="text-align: right;">Action</th>     
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if(count($patients) == 0)
                            <tr><td>No recordes</td></tr>
                        @endif
                        @foreach($patients as $patient) 
                            <tr>
                                <td>{{$patient->name}}</td>
                                <td>{{$patient->address}}</td>
                                <td>{{$patient->clinical_record}}</td>
                                <td>{{$patient->agency_name}}</td>
                                <td style="text-align: right;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#patientsListEditModal{{$patient->id}}" ><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#patientsListDeleteModal{{$patient->id}}" ><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                            <div class="modal fade" id="patientsListEditModal{{$patient->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit new Patient</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('patient.update', $patient->id)}}" method="POST">
                                                @method('PATCH')                                                 
                                                @csrf
                                                <div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$patient->name}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" name="address" class="form-control" placeholder="Enter Address" value="{{$patient->address}}" required/>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="clinical_record" class="form-label">Clinical Record</label>
                                                            <input type="text" name="clinical_record" class="form-control" placeholder="Enter Clinical Record" value="{{$patient->clinical_record}}" required/>
                                                        </div>
                                                    </div>                
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="agency_name" class="form-label">Agency name</label>

                                                            <select name="agency_name" class="form-select form-select-lg" required>
                                                                @foreach($agencis as $agency)
                                                                <option value="{{$agency->agency_name}}">{{$agency->agency_name}}</option>
                                                                @endforeach
                                                            </select>                                                        </div>
                                                    </div>                                  
                                                </div>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>

                                            </form>
                            
                                                            
                                            <!-- <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="emailBasic" class="form-label">Email</label>
                                                    <input type="text" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx">
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="dobBasic" class="form-label">DOB</label>
                                                    <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY">
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>         
                               
                            <div class="modal fade" id="patientsListDeleteModal{{$patient->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Patient</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('patient.destroy', $patient->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$patient->id}}">
                                                <h2>Are you sure to delete?</h2>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>
                            
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                 
                        @endforeach    
                    </tbody>
                </table>
            </div>                  
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientsListModal">Add Patient</button>
        </div>
    </div>

    <div class="col-md-6 col-lg-6 mb-3">
        <div class = "card">
            <h5 class="card-header">Agency</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Agency name</th>
                            <th>EployeeID</th>     
                            <th style="text-align: right;">Action</th>     
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if(count($agencis) == 0)
                            <tr><td>No recordes</td></tr>
                        @endif
                        @foreach($agencis as $agency) 
                            <tr>
                                <td>{{$agency->agency_name}}</td>
                                <td>{{$agency->employee_id}}</td>
                                <td style="text-align: right;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agencyListEditModal{{$agency->id}}" ><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#agencyListDeleteModal{{$agency->id}}" ><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>

                                </td>
                            </tr>


                            <div class="modal fade" id="agencyListEditModal{{$agency->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Agency</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('agency.update', $agency->id)}}" method="POST">
                                                @method('PATCH')                                                 
                                                @csrf
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameBasic" class="form-label">Agency Name</label>
                                                        <input type="text" name="agency_name" class="form-control" placeholder="Enter Agency Name" value="{{$agency->agency_name}}" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameBasic" class="form-label">employeeID</label>
                                                        <input type="text" name="employee_id" class="form-control" placeholder="Enter employID" value="{{$agency->employee_id}}" required>
                                                    </div>
                                                </div> 
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>

                                            </form>
                            
                                                            
                                            <!-- <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="emailBasic" class="form-label">Email</label>
                                                    <input type="text" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx">
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="dobBasic" class="form-label">DOB</label>
                                                    <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY">
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>         
                               
                            <div class="modal fade" id="agencyListDeleteModal{{$agency->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Agency</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('agency.destroy', $agency->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$agency->id}}">
                                                <h2>Are you sure to delete?</h2>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>
                            
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>               

                        @endforeach                
                    </tbody>
                </table>
            </div>      
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agencyModal">Add Agency</button>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 mb-4">
        <div class = "card">
            <h5 class="card-header">Visit Code</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Visit Code</th>
                            <th style="text-align: right;">Action</th>     
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if(count($visitcodes) == 0)
                        <tr><td>No recordes</td></tr>
                        @endif
                        @foreach($visitcodes as $visitcode) 
                            <tr>
                                <td>{{$visitcode->visit_code}}</td>
                                <td style="text-align: right;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visitcodeListEditModal{{$visitcode->id}}"  ><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visitcodeListDeleteModal{{$visitcode->id}}"  ><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>



                            <div class="modal fade" id="visitcodeListEditModal{{$visitcode->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Visit Code</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('visitcode.update', $visitcode->id)}}" method="POST">
                                                @method('PATCH')                                                 
                                                @csrf
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameBasic" class="form-label">Visit Code</label>
                                                        <input type="text" name="visit_code" class="form-control" placeholder="Enter Visit Code" value="{{$visitcode->visit_code}}" required>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>

                                            </form>
                            
                                                            
                                            <!-- <div class="row g-2">
                                                <div class="col mb-0">
                                                    <label for="emailBasic" class="form-label">Email</label>
                                                    <input type="text" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx">
                                                </div>
                                                <div class="col mb-0">
                                                    <label for="dobBasic" class="form-label">DOB</label>
                                                    <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY">
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>         
                               
                            <div class="modal fade" id="visitcodeListDeleteModal{{$visitcode->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete Visit Code</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('visitcode.destroy', $visitcode->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{$visitcode->id}}">
                                                <h2>Are you sure to delete?</h2>
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>
                            
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>               

                        @endforeach    
                    </tbody>
                </table>
            </div>      
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#visitCodeModal">Add Visit Code</button>
        </div>
    </div>



    <div class="col-md-12 col-lg-12 mb-4">
        <div class = "card">
            <h5 class="card-header">Export a weely report</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <form action="{{route('getDoc')}}" method="GET">                
                    <div class="row">
                        <div class = "col-lg-10"><span>Last week(all Patients)</span></div>
                        <div class = "col-lg-2">
                            <button type="submit" class="btn btn-primary">Export</button>
                        </div>                    
                    </div>
                </form>
                <form action="{{route('getDoc')}}" method="GET">                
                    <div class="row">                
                        <div class = "col-lg-10 col-md-10">
                            <span>Last week specific patient</span>
                            <select name="patient_id" class="form-select form-select-lg">
                                @foreach($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class = "col-lg-2 col-md-2">
                            <button type="submit" class="btn btn-primary">Export</button>
                        </div>                    
                    </div>
                </form>
                <form action="{{route('getDoc')}}" method="GET">                
                    <div class="row">
                        <div class = "col-lg-10 col-md-10">
                            <span>A specific week(all Patients)</span>
                            <select name="week" class="form-select form-select-lg">
                                @foreach($weeks as $week)
                                <option value="{{$week}}">{{$week}}(Saturday)</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class = "col-lg-2 col-md-2">
                            <button type="submit" class="btn btn-primary">Export</button>
                        </div>                    
                    </div>                
                </form>
                <form action="{{route('getDoc')}}" method="GET">                
                    <div class="row">
                        <div class = "col-lg-5 col-md-5">
                            <span>Pick a patient</span>
                            <select name="patient_id" class="form-select form-select-lg">
                                @foreach($patients as $patient)
                                <option value="{{$patient->id}}">{{$patient->name}}</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class = "col-lg-5 col-md-5">
                            <span>Specific week</span>
                            <select name="week" class="form-select form-select-lg">
                                @foreach($weeks as $week)
                                <option value="{{$week}}">{{$week}}(Saturday)</option>
                                @endforeach
                            </select>                        
                        </div>
                        <div class = "col-lg-2 col-md-2">
                            <button type="submit" class="btn btn-primary">Export</button>
                        </div>                    
                    </div>                
                </form>
            </div>

        </div>
    </div>

</div>
<!-- Examples -->
    <!-- Button trigger modal -->

    <!-- Add Patient -->
    <div class="modal fade" id="patientsListModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('patient.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Enter Address" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="clinical_record" class="form-label">Clinical Record</label>
                            <input type="text" name="clinical_record" class="form-control" placeholder="Enter Clinical Record" required />
                        </div>
                    </div>                
                    <div class="row">
                        <div class="col mb-3">
                            <label for="agency_name" class="form-label">Agency name</label>

                            <select name="agency_name" class="form-select form-select-lg" required>
                                @foreach($agencis as $agency)
                                <option value="{{$agency->agency_name}}">{{$agency->agency_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>                                  
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>

                </form>                                    
                <!-- <div class="row g-2">
                    <div class="col mb-0">
                        <label for="emailBasic" class="form-label">Email</label>
                        <input type="text" id="emailBasic" class="form-control" placeholder="xxxx@xxx.xx">
                    </div>
                    <div class="col mb-0">
                        <label for="dobBasic" class="form-label">DOB</label>
                        <input type="text" id="dobBasic" class="form-control" placeholder="DD / MM / YY">
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>


    <!-- Add Agency -->
    <div class="modal fade" id="agencyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add new Agency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('agency.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Agency Name</label>
                            <input type="text" name="agency_name" class="form-control" placeholder="Enter Agency Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">employeeID</label>
                            <input type="text" name="employee_id" class="form-control" placeholder="Enter employID" required>
                        </div>
                    </div> 
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>   
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>


  <!-- Add Visit Code -->
  <div class="modal fade" id="visitCodeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add a new Visit Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('visitcode.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Code</label>
                            <input type="text" name="visit_code" class="form-control" placeholder="Enter Code">
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>   

            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>

<!--/ Card layout -->
@endsection
