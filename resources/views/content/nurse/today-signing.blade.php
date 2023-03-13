@extends('layouts/contentNavbarLayout')

@section('title', 'Today patient signing visit')

@section('content')
<h4 class="fw-bold py-3 mb-4">
Today patient signing visit interface
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">{{date("Y-m-d")}}</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($todaySchedule as $visit) 
            <tr>
                <td>
                  <?php  if(array_key_exists($visit->patient_id, $patientName)) echo $patientName[$visit->patient_id] ?>
                </td>
                
                @if($visit->is_signed)
                  <td><a href = "{{route('getImageBySchedule', ['id'=>$visit->id])}}" type="button" class="btn btn-secondary" style="float:right;">{{$visit->sign_time}} Signed</a></td> 
                @else
                  <td><a href = "{{route('signature-pad', ['id'=>$visit->id])}}" type="button" class="btn btn-primary" style="float:right;">Sign</a></td> 
                @endif              
            </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<hr class="my-5">

@endsection
