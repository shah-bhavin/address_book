@extends('layouts.admin')
 
@section('content')
    @csrf

    <!-- <div class="offset-md-3 col-md-6 mt-3">
        <div class="mb-3">            
            <input type="text" onchange="datatable();" name="searchKey" id="searchKey" class="form-control" placeholder="Search Here">
        </div>           
    </div>

    <div class="container viewResult">
      
    </div> -->
    

<!-- <script type="text/javascript">
    window.onload = function() {
        document.getElementById("searchKey").focus();
    };
</script> -->

<!-- <script type="text/javascript">
  $( function() {
    
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#searchKey" ).autocomplete({
        source: function( request, response ) {
             $.getJSON( "view", {
            term: extractLast( request.term )
          }, response );
        },
        search: function() {
          var term = extractLast( this.value );
          if ( term.length < 1 ) {
            return false;
          }
        },
        focus: function() {
          return false;
        },
      });

    jQuery.ui.autocomplete.prototype._resizeMenu = function () {
      var ul = this.menu.element;
      ul.outerWidth(this.element.outerWidth());
    }
});


function datatable(){
  var text_val = $("#searchKey").val();

  $.ajax({
        url: "showData",
        type: "post",
        data: {'term' : text_val, "_token":"{{ csrf_token() }}"} ,
        success: function (data) {
          $(".viewResult").html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

</script> -->
<div class="container">
  <div class="row">
    <div class="col-md-12">
    <nav class="mt-5">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-disease" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Disease</button>
        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-diet" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Diet</button>
        <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-treatment" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Treatment</button>
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active " id="nav-disease" role="tabpanel" aria-labelledby="nav-home-tab">
        @foreach($diseases as $disease)
          <div class="accordion accordion-flush" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne{{ $disease->id }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $disease->id }}" aria-expanded="true" aria-controls="collapseOne{{ $disease->id }}">
                  {{ $disease->disease_ref }}
                </button>
              </h2>
              <div id="collapseOne{{ $disease->id }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{ $disease->id }}" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <p>Diet : {{ $disease->diet_ref }}</p>
                  <p>Treatment : {{ $disease->treatment_ref }}</p>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="tab-pane fade" id="nav-diet" role="tabpanel" aria-labelledby="nav-profile-tab">
      @foreach($diet_list_finals as $key => $value) 
        @if($value != '') 
        <div class="accordion accordion-flush" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne{{ $key }}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne{{ $key }}">
                {{ $value }}
              </button>
            </h2>
            @php $diets = App\Http\Controllers\MappingController::viewDiet($value)  @endphp
            <div id="collapseOne{{ $key }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{ $key }}" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                @foreach($diets as $diet)  
                  <div class="data-box">
                    <p>Disease : {{ $diet->disease_ref }}</p>  
                    <p>Diet : {{ $diet->diet_ref }}</p>
                    <p>Treatment : {{ $diet->treatment_ref }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        @endif
      @endforeach
      </div>

      <div class="tab-pane fade" id="nav-treatment" role="tabpanel" aria-labelledby="nav-profile-tab">
      @foreach($treatment_list_finals as $key => $value) 
        @if($value != '') 
        <div class="accordion accordion-flush" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne{{ $key }}">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne{{ $key }}">
                {{ $value }}
              </button>
            </h2>
            @php $treatments = App\Http\Controllers\MappingController::viewTreatment($value)  @endphp
            <div id="collapseOne{{ $key }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{ $key }}" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                @foreach($treatments as $treatment)  
                  <div class="data-box">
                    <p>Disease : {{ $treatment->disease_ref }}</p>  
                    <p>Diet : {{ $treatment->diet_ref }}</p>
                    <p>Treatment : {{ $treatment->treatment_ref }}</p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        @endif
      @endforeach
      </div>  




    </div>
    </div>
  </div>
</div> 


@endsection