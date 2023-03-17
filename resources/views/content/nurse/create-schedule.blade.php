@extends('layouts/contentNavbarLayout')

@section('title', 'Create a Schedule')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
<script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery(function ($) {        
            $('form').bind('submit', function () {
                $(this).find(':input').prop('disabled', false);
            });
        });        
        function save(){
            $.ajax({
                type:'POST',
                url:"{{route('create-schedule.saveSchedule')}}",
                data:{},
                success:function(data){
                    location.reload();
                }
            });
        }

        function changeselect() {
            var isrepeat = document.getElementById("is_repeat");
            var selectpatient = document.getElementById("select_patient");
            if(isrepeat.checked) {
                @if(count($todaySchedule)>0)
                last_patientid = {{$todaySchedule[count($todaySchedule) - 1]->patient_id}};
                @endif
                selectpatient.value = last_patientid;
                // selectpatient.style.visibility = 'hidden';
                $('#select_patient').prop('disabled','true');
                // $('#select_patient').val(last_patientid);
                // document.getElementById("select").selectedIndex = 0;

            }else {
                $('#select_patient').prop('disabled','false');
                // selectpatient.style.visibility = 'visible';                
                selectpatient.selectedIndex = 0;
            }
        }
    </script>
@endsection

@section('content')
<h4 class="fw-bold py-3 mb-4">Create a schedule for visits for today</h4>

<!-- Examples -->
<div class="row mb-5">
    <div class = "card">
        <form action="{{route('create-schedule.applySetting')}}" method="POST">
            @csrf
            <div class="mb-3 mt-3 row">
                <div class="col-lg-4 col-md-6 row">
                    <label for="html5-time-input" class="col-md-7 col-form-label text-right" style="text-align:right;">Schedule start time today:</label>
                    <div class="col-md-5">
                        <input class="form-control" name="start_time" type="time" value="{{$setting->start_time}}" id="html5-time-input" required/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 row">
                    <label for="html5-time-input" class="col-md-7 col-form-label" style="text-align:right;">Schedule end time today:</label>
                    <div class="col-md-5">
                        <input class="form-control" name = "end_time" type="time" value="{{$setting->end_time}}" id="html5-time-input" required/>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 row">
                    <label for="html5-time-input" class="col-md-8 col-form-label" style="text-align:right;">Average travel time:</label>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="average_travel_time" min="10" max="1440" placeholder="min" aria-describedby="defaultFormControlHelp" value="{{$setting->average_travel_time}}"required/>
                    </div>

                    
                </div>
                <div class="col-lg-6 col-md-6">
                    @include('content.nurse.flash-message')  
                </div>
                <div class="col-lg-6 col-md-6 mt-3" style="text-align: right;">
                    <button type="submit" class="btn btn-primary">Apply</button>
                </div>
                <div class="col-lg-12 col-md-12 mt-3">
                    @if($box = Session::get('box'))
                        <div class = "d-flex">
                            <?php
                                $cnt = count($box);
                                $p = 100 / $cnt;
                            ?>
                            
                            @foreach($box as $bx)
                                @if($bx < 0)
                                    <div style="width: {{$p}}%;    
                                    background-color: grey; height: 20px;"></div>
                                @elseif($bx == 0)
                                    <div style="width: {{$p}}%;    
                                        background-color: grey; height: 20px;"></div>
                                @else
                                    <div style="width: {{$p}}%;    
                                        background-color: green; height: 20px;"></div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </form>
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
                            <?php
                                $prev = "";
                            ?>
    
                            @foreach($todaySchedule as $schedule)                                 
                                <form action="{{route('create-schedule.updateSchedule')}}" method="POST">
                                    <input type="hidden" name="id" value="{{$schedule->id}}">
                                    <input type="hidden" name="date" value="{{$schedule->date}}">
                                    <input type="hidden" name="patient_id" value="{{$schedule->patient_id}}">
                                    <!-- <input type="hidden" name="issaved" value="{{$schedule->issaved}}"> -->
                                    <input type="hidden" name="isrepeated" value="{{$schedule->isrepeated}}">

                                    @csrf
                                    <tr 
                                        @if(!$schedule->issaved) 
                                            style="background-color: #f1d4d4;"
                                        @endif
                                        >
                                        <td>@if(array_key_exists($schedule->patient_id, $patientName))
                                            {{$patientName[$schedule->patient_id]}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($schedule->patient_id != $prev)
                                            <div class="mt-2 mb-3">
                                                <select name="visit_times" class="form-select form-select-lg" >
                                                    @for($i = 1; $i <=3; $i++)
                                                    <option value="{{$i}}" 
                                                    <?php 
                                                            if($schedule->visit_times == $i) echo "selected";
                                                        ?>
                                                        >{{$i}}</option>

                                                    @endfor
                                                </select>
                                            </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="mt-2 mb-3">
                                                <select name="visit_code" class="form-select form-select-lg">
                                                    @foreach($visitcodes as $visitcode)
                                                        <option value="{{$visitcode->visit_code}}" 
                                                        <?php 
                                                            if($schedule->visit_code == $visitcode->visit_code) echo "selected";
                                                        ?>
                                                        >{{$visitcode->visit_code}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mt-2 mb-3">
                                                <select name="visit_interval" class="form-select form-select-lg"> 
                                                    @for($i=15; $i <= 180; $i+=15)                                               
                                                        <option value="{{$i}}"
                                                        <?php 
                                                            if($schedule->visit_interval == $i) echo "selected";
                                                        ?>
                                                        >{{$i}} mins</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            @if($schedule->patient_id != $prev)
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <input class="form-check-input mt-0" name="isspecific_time" value="1" type="checkbox" <?php if($schedule->isspecific_time) echo "checked"?> aria-label="Checkbox for following text input">
                                                </div>
                                                <input class="form-control" name="specific_time" type="time" value="{{$schedule->specific_time}}" />
                                            </div>
                                            @endif
                                        </td>
                                        <td >
                                            <button type="submit" class = "btn btn-primary">Apply</button>
                                            <button type="button" class = "btn btn-primary" data-bs-toggle="modal" data-bs-target="#deleteModal{{$schedule->id}}">Delete</button>                                        </td>
                                    </tr>
                                    <?php
                                        $prev = $schedule->patient_id;
                                    ?>
                                </form>

                                <div class="modal fade" id="deleteModal{{$schedule->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Agency</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('create-schedule.destroySchedule')}}" method="POST">
                                                    @csrf
                                                    <!-- @method('DELETE') -->
                                                    <input type="hidden" name="id" value="{{$schedule->id}}">
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
                <form action="{{route('create-schedule.saveSchedule')}}" method="POST">
                    @csrf
                    <div class = "d-flex flex-row-reverse">                     
                        <button type="submit" class="btn btn-primary" >Save</button>
                        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createModal">Add Patient</button>
                    </div>
                </form>
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
                <form action="{{route('create-schedule.addPatient')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nameBasic" class="form-label">Patient Name</label>

                            <select name="id" class="select2 form-select" id = "select_patient">
                                @foreach($patients as $patient)
                                    <option value="{{$patient->id}}">{{$patient->name}}</option>
                                @endforeach
                            </select>
                            @if(count($todaySchedule)>0)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="" id = "is_repeat" onclick="changeselect()">
                                    <label class="form-check-label" for="defaultCheck3">
                                        Is repeat.
                                    </label>
                                </div>
                            @endif
                            <!-- <input type="text" id="agencyName" class="form-control" placeholder="Search and select Patient Name"> -->
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
            </div>
        </div>
    </div>
    
<!--/ Card layout -->
@endsection
