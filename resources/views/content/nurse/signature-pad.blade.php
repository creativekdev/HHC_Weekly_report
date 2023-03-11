@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Setting')

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
@endsection

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
        <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
        <link type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet"> 
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <style>
        .kbw-signature { width: 100%; height: 180px;}
            #signaturePad canvas{
            width: 100% !important;
            height: auto;
        }
        </style>
<!-- Examples -->
<div class="row mb-5">
    <form method="POST" action="{{ url('signaturepad') }}">
        <input type="hidden" name = "id" value = "{{$visit->id}}" />
        @csrf
        <div class = "row">
            <div class="col-md-12 col-lg-12">
                <label class="" for="">Name:</label>
                <input type="text" name="name" class="form-group" value=" <?php  if(array_key_exists($visit->patient_id, $patientName)) echo $patientName[$visit->patient_id] ?>" readonly>
            </div>                    
        </div>
        <div class="row" >
            <div class="col-md-12 col-lg-12">
                <label class="" for="">Signature:</label>
                <br/>
                <div id="signaturePad" style="height:500px;"></div>
                <br/>
                <div class="d-flex mt-3 flex-row-reverse">
                <button class="btn btn-success me-3" style="float: right;">Save</button>                    
                    <button id="clear" class="btn btn-danger me-3">Clear Signature</button>
                </div>            
                <textarea id="signature64" name="signed" style="display: none"></textarea>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
            <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
            <script type="text/javascript">
            var signaturePad = $('#signaturePad').signature({syncField: '#signature64', syncFormat: 'PNG'});
            $('#clear').click(function(e) {
            e.preventDefault();
            signaturePad.signature('clear');
            $("#signature64").val('');
            });
        </script>
@endsection
