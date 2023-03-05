@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Setting')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">Manager setting interface</h4>

<!-- Examples -->
<div class="row mb-5">
    <div class="col-md-6 col-lg-4 mb-3">
        <div class = "card">
            <h5 class="card-header">Agency</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Agency name</th>
                            <th>EployeeID</th>     
                            <th>Action</th>     
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @for($i = 0; $i < 10; $i++) 
                            <tr>
                                <td>Angency Name</td>
                                <td>103</td>
                                <td>
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
            <button type="button" class="btn btn-primary">Add</button>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class = "card">
            <h5 class="card-header">Visit Code</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Visit Code</th>
                            <th>Action</th>     
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @for($i = 0; $i < 10; $i++) 
                            <tr>
                                <td>HT - WC</td>
                                <td>
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
            <button type="button" class="btn btn-primary">Add</button>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class = "card">
            <h5 class="card-header">Patients List</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>     
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @for($i = 0; $i < 10; $i++) 
                            <tr>
                                <td>John Smith</td>
                                <td>
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
            <button type="button" class="btn btn-primary">Add</button>
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
                    <div class = "col-lg-2  col-md-2">
                        <button type="button" class="btn btn-primary">Export</button>
                    </div>                    
                </div>                
                                
            </div>

        </div>
    </div>

</div>
<!-- Examples -->

<!--/ Card layout -->
@endsection
