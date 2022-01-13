@extends('layouts.admin')
 
@section('content')
    @csrf

    <div class="offset-md-3 col-md-6 mt-3">
        <div class="mb-3">            
            <input type="text" onchange="datatable();" name="searchKey" id="searchKey" class="form-control" placeholder="Search Here">
        </div>           
    </div>

    <div class="container viewResult">
      
    </div>
    

<script type="text/javascript">
    window.onload = function() {
        document.getElementById("searchKey").focus();
    };
</script>

<script type="text/javascript">
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

</script>
    
@endsection