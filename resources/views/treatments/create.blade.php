@extends('layouts.admin')
  
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-start">
            @if(@$treatment->id)
                <h2>Edit - {{ @$treatment->treatment_name }}</h2>
            @else
                <h2>Add New treatment</h2>
            @endif
        </div>
        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('treatments.index') }}"> Back</a>
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
   
@if(@$treatment->id)
    <form action="{{ route('treatments.update',@$treatment->id) }}" method="POST">
    @csrf
    @method('PUT')
@else
    <form action="{{ route('treatments.store') }}" method="POST">
    @csrf
@endif

    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Treatment Name:</label>
                <input type="text" name="treatment_name"  value="{{ @$treatment->treatment_name }}" id="treatment_name" class="form-control" placeholder="Treatment Name">
            </div>           
        </div>

        <div class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="short_code" class="form-label">Short Code:</label>
                <input type="text" name="short_code"  value="{{ @$treatment->short_code }}" id="short_code" class="form-control" placeholder="Short Code">
            </div>           
        </div>
    
        <div class="offset-md-3 col-md-6 text-center">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </div>
   
</form>
@endsection