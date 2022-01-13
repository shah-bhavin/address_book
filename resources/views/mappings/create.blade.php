@extends('layouts.admin')
  
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-start">
            @if(@$mapping->id)
                <h2>Edit - {{ @$mapping->disease_ref }}</h2>
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
            <input type="text" name="disease_ref"  value="{{ @$mapping->disease_ref }}" id="disease_ref" class="form-control">
        </div>           

        <div class="mb-3 col-md-6">
            <label for="short_code" class="form-label">Diet:</label>
            <input type="text" name="diet_ref"  value="{{ @$mapping->diet_ref }}" id="diet_ref" class="form-control">
        </div>           

        <div class="mb-3 col-md-6">
            <label for="short_code" class="form-label">Treatment:</label>
            <input type="text" name="treatment_ref"  value="{{ @$mapping->treatment_ref }}" id="treatment_ref" class="form-control">

        </div>    
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </div>
   
</form>

@endsection