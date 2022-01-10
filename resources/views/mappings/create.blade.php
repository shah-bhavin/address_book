@extends('layouts.admin')
  
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-start">
            @if(@$mapping->id)
                <h2>Edit - {{ @$mapping->mapping_name }}</h2>
            @else
                <h2>Add New mapping</h2>
            @endif
        </div>
        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('mappings.index') }}"> Back</a>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
@if(@$mapping->id)
    <form action="{{ route('mappings.update',@$mapping->id) }}" method="POST">
    @csrf
    @method('PUT')
@else
    <form action="{{ route('mappings.store') }}" method="POST">
    @csrf
@endif

    
      
    <div class="row">
        <div class="mb-3">
            <label for="disease_ref" class="form-label">Disease:</label>
            <!-- <input type="text" name="disease_ref"  value="{{ @$mapping->disease_ref }}" id="disease_ref" class="form-control"> -->
            <select class="form-control" name="disease_ref" id="disease_ref">
                <option selected>Please Select Disease</option>
                @foreach(App\Models\Disease::all() as $disease)
                <option value="{{ $disease->id }}">{{ $disease->disease_name }}</option>
                @endforeach

            </select>
        </div>           

        <div class="mb-3 col-md-6">
            <label for="short_code" class="form-label">Diet:</label>
            <select class="form-select" name="diet_ref_from" id="diet_ref_from">
                <option selected>Please Select Diet</option>
                @foreach(App\Models\Diet::all() as $diet)
                <option value="{{ $diet->id }}">{{ $diet->diet_name }}</option>
                @endforeach
            </select>
        </div>           

        <div class="mb-3 col-md-6">
            <label for="short_code" class="form-label">Treatment:</label>
            <select class="form-select" name="treatment_ref_from" id="treatment_ref_from">
                <option selected>Please Select Treatment</option>
                @foreach(App\Models\Treatment::all() as $treatment)
                <option value="{{ $treatment->id }}">{{ $treatment->treatment_name }}</option>
                @endforeach
            </select>
        </div>    
        
        
        <div class="mb-3 col-md-6">
            <label for="short_code" class="form-label">Selected Diet:</label>
            <select multiple="multiple" class="form-select diet" name="diet_ref[]">
                
            </select>
        </div>           

        <div class="mb-3 col-md-6">
            <label for="short_code" class="form-label">Selected Treatment:</label>
            <select multiple="multiple" class="form-select treatment" name="treatment_ref[]">
                
            </select>
        </div>           


        <div class="text-center">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </div>
   
</form>

<script>
    $('#treatment_ref_from').on('change', function() {
       var treatment_name = $("#treatment_ref_from :selected").text();
       var treatment_id = $("#treatment_ref_from :selected").val();

       $('.treatment').append('<option value="'+treatment_id+'" selected>'+treatment_name+'</option>');
    });

    $('#diet_ref_from').on('change', function() {
       var diet_name = $("#diet_ref_from :selected").text();
       var diet_id = $("#diet_ref_from :selected").val();

       $('.diet').append('<option value="'+diet_id+'" selected>'+diet_name+'</option>');
    });
</script>
@endsection