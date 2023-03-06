@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Setting')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">Manager setting interface</h4>

<!-- Examples -->
<div class="row mb-5">


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
                        @for($i = 0; $i < 10; $i++) 
                            <tr>
                                <td>John Smith</td>
                                <td>88 street</td>
                                <td>Covid</td>
                                <td>agency1</td>
                                <td style="text-align: right;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor    
                    </tbody>
                </table>
            </div>      
            
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientsListModal">Add</button>
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
                        @for($i = 0; $i < 10; $i++) 
                            <tr>
                                <td>Angency Name</td>
                                <td>103</td>
                                <td style="text-align: right;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor                
                    </tbody>
                </table>
            </div>      
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agencyModal">Add</button>
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
                        @for($i = 0; $i < 10; $i++) 
                            <tr>
                                <td>HT - WC</td>
                                <td style="text-align: right;">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu" >
                                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" ><i class="bx bx-trash me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor    
                    </tbody>
                </table>
            </div>      
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#visitCodeModal">Add</button>
        </div>
    </div>



    <div class="col-md-12 col-lg-12 mb-4">
        <div class = "card">
            <h5 class="card-header">Export a weely report</h5>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="row">
                    <div class = "col-lg-10"><span>Last week(all Patients)</span></div>
                    <div class = "col-lg-2">
                        <button type="button" class="btn btn-primary">Export</button>
                    </div>                    
                </div>
                <div class="row">                    
                    <div class = "col-lg-10 col-md-10">
                        <span>Last week specific patient</span>
                        <select id="largeSelect" class="form-select form-select-lg">
                            <option>Large select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class = "col-lg-2 col-md-2">
                        <button type="button" class="btn btn-primary">Export</button>
                    </div>                    
                </div>
                <div class="row">
                    <div class = "col-lg-10 col-md-10">
                        <span>A specific week(all Patients)</span>
                        <select id="largeSelect" class="form-select form-select-lg">
                            <option>Large select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>                        
                    </div>
                    <div class = "col-lg-2 col-md-2">
                        <button type="button" class="btn btn-primary">Export</button>
                    </div>                    
                </div>                
                <div class="row">
                    <div class = "col-lg-5 col-md-5">
                        <span>Pick a patient</span>
                        <select id="largeSelect" class="form-select form-select-lg">
                            <option>Large select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>                        
                    </div>
                    <div class = "col-lg-5 col-md-5">
                        <span>Specific week</span>
                        <select id="largeSelect" class="form-select form-select-lg">
                            <option>Large select</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>                        
                    </div>
                    <div class = "col-lg-2  col-md-2 " style="text-align: bottom;">
                        <button type="button" class="btn btn-primary">Export</button>
                    </div>                    
                </div>                
                                
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
                <h5 class="modal-title" id="exampleModalLabel1">Add new Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Name</label>
                        <input type="text" id="patientName" class="form-control" placeholder="Enter Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Address</label>
                        <input type="text" id="patientAddress" class="form-control" placeholder="Enter Address">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Clinical Record</label>
                        <input type="text" id="patientClinicalRecord" class="form-control" placeholder="Enter Clinical Record">
                    </div>
                </div>                
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Agency name</label>
                        <input type="text" id="patientAgencyName" class="form-control" placeholder="Enter Agency Name">
                    </div>
                </div>                
                                
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
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Agency Name</label>
                        <input type="text" id="agencyName" class="form-control" placeholder="Enter Agency Name">
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">employeeID</label>
                        <input type="text" id="employeeID" class="form-control" placeholder="Enter employID">
                    </div>
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
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
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Code</label>
                        <input type="text" id="visitCode" class="form-control" placeholder="Enter Code">
                    </div>
                </div>
    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

<!--/ Card layout -->
@endsection
