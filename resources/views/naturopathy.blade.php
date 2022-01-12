@extends('layouts.admin')
 
@section('content')
    @csrf

    <div class="offset-md-3 col-md-6 mt-3">
        <div class="mb-3">            
            <input type="text" name="disease_name" id="disease_name" class="form-control" placeholder="Search Here">
        </div>           
    </div>
    

<script type="text/javascript">
    window.onload = function() {
        document.getElementById("disease_name").focus();
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
 
    $( "#disease_name" ).autocomplete({
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
        select: function( event, ui ) {
          var terms = split( this.value );
          terms.pop();
          terms.push( ui.item.value );
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });

    jQuery.ui.autocomplete.prototype._resizeMenu = function () {
      var ul = this.menu.element;
      ul.outerWidth(this.element.outerWidth());
    }
});

</script>
    
@endsection