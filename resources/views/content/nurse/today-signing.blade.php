@extends('layouts/contentNavbarLayout')

@section('title', 'Today patient signing visit')

@section('content')
<h4 class="fw-bold py-3 mb-4">
Today patient signing visit interface
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header"></h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @for($i = 0; $i < 10; $i++) 
            <tr>
                <td>John Smith</td>
                <td><a href = "/signaturepad" type="button" class="btn btn-primary" style="float:right;">Sign</a></td>
            </tr>
        @endfor
  
      </tbody>
    </table>
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<hr class="my-5">

@endsection
