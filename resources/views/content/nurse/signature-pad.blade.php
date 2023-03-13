@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Setting')

@section('vendor-script')
<link rel="stylesheet" href="{{asset('assets/css/signature-pad.css')}}">

<script src="{{asset('assets/js/signature_pad.umd.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>

<script src="{{asset('assets/vendor/libs/masonry/masonry.js')}}"></script>
<script>    
    savePNGButton.addEventListener("click", () => {
      if (signaturePad.isEmpty()) {
        alert("Please provide a signature first.");
      } else {
        const dataURL = signaturePad.toDataURL();
        // download(dataURL, "signature.png");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:"{{ url('signaturepad') }}",
            data:{dataURL: dataURL, id:{{$visit->id}}},
            success:function(data){
              // alert("success");
              var loc = window.location;
              window.location = loc.protocol+"//"+loc.hostname+"/";
            }
        });

      }

    });
  </script>
@endsection

@section('content')
<div id="signature-pad" class="signature-pad">
    <div class="signature-pad--body">
      <canvas></canvas>
    </div>
    <div class="signature-pad--footer">
      <div class="description">Sign above</div>

      <div class="signature-pad--actions">
        <div class="column">
          <button type="button" class="btn btn-primary clear" data-action="clear">Clear</button>
          <!-- <button type="button" class="btn btn-primary" data-action="change-background-color">Change background color</button>
          <button type="button" class="btn btn-primary" data-action="change-color">Change color</button> -->

        </div>
        <div class="column">
            <!-- <button type="button" class="btn btn-primary" data-action="change-width">Change width</button>
            <button type="button" class="btn btn-primary" data-action="undo">Undo</button> -->

            <button type="button" class="btn btn-primary save" style="" data-action="save-png">Save</button>
          <!-- <button type="button" class="button save" data-action="save-jpg">Save as JPG</button>
          <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
          <button type="button" class="button save" data-action="save-svg-with-background">Save as SVG with background</button> -->
        </div>
      </div>
    </div>
  </div>

@endsection

