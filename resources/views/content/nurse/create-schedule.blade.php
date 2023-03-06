@extends('layouts/contentNavbarLayout')

@section('title', 'Create a Schedule')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">Create a schedule for visits for today</h4>

<!-- Examples -->
<div class="row mb-5">
    <div class = "card">
        <div class="mb-3 mt-3 row">
            <div class="col-lg-4 col-md-6 row">
                <label for="html5-time-input" class="col-md-7 col-form-label text-right" style="text-align:right;">Schedule start time today:</label>
                <div class="col-md-5">
                    <input class="form-control" type="time" value="12:30:00" id="html5-time-input" />
                </div>
            </div>
            <div class="col-lg-4 col-md-6 row">
                <label for="html5-time-input" class="col-md-7 col-form-label" style="text-align:right;">Schedule end time today:</label>
                <div class="col-md-5">
                    <input class="form-control" type="time" value="12:30:00" id="html5-time-input" />
                </div>
            </div>
            <div class="col-lg-4 col-md-6 row">
                <label for="html5-time-input" class="col-md-8 col-form-label" style="text-align:right;">Average travel time:</label>
                <div class="col-md-4">
                    <input type="number" class="form-control" id="defaultFormControlInput" placeholder="min" aria-describedby="defaultFormControlHelp">                
                </div>
            </div>

        </div>
    </div>    

    <div class = "card">
        <div class="mb-3 row">
            <div class = "card">
                <h5 class="card-header"></h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>name</th>
                                <th>visite times</th>     
                                <th>Visit Code</th>     
                                <th>Visit interval</th>     
                                <th>Specific Time</th>     
                                <th>Action</th>     
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @for($i = 0; $i < 10; $i++) 
                                <tr>
                                    <td>Bert Smith</td>
                                    <td>
                                        <div class="mt-2 mb-3">
                                            <select id="largeSelect" class="form-select form-select-lg">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mt-2 mb-3">
                                            <select id="largeSelect" class="form-select form-select-lg">
                                                <option value="1">S/U</option>
                                                <option value="2">ADM</option>
                                                <option value="3">HT-IV</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mt-2 mb-3">
                                            <select id="largeSelect" class="form-select form-select-lg">
                                                <option value="1">15m</option>
                                                <option value="2">20m</option>
                                                <option value="3">1h</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input class="form-check-input mt-0" type="checkbox" value="" aria-label="Checkbox for following text input">
                                            </div>
                                            <input class="form-control" type="time" value="12:30:00" id="html5-time-input" />
                                        </div>
                                    </td>                                    
                                    <td style="text-align: right;">
                                        <div class="dropdown" >
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
                <div class = "d-flex flex-row-reverse"> 
                    <button type="button" class="btn btn-secondary">Save</button>
                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createModal">Add Patient</button>
                </div>
            </div>
        </div>
    </div>        
</div>
<!-- Examples -->


    <!-- Create Schedule -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Add Patient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameBasic" class="form-label">Patient Name</label>
                        <input type="text" id="agencyName" class="form-control" placeholder="Search and select Patient Name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
            </div>
        </div>
    </div>

<!--/ Card layout -->
@endsection
