@extends('layouts.admin')
  
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-start">
            @if(@$diet->id)
                <h2>Edit - {{ @$diet->diet_name }}</h2>
            @else
                <h2>Add New diet</h2>
            @endif
        </div>
        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('diets.index') }}"> Back</a>
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
   
@if(@$diet->id)
    <form action="{{ route('diets.update',@$diet->id) }}" method="POST">
    @csrf
    @method('PUT')
@else
    <form action="{{ route('diets.store') }}" method="POST">
    @csrf
@endif

    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Diet Name:</label>
                <input type="text" name="diet_name"  value="{{ @$diet->diet_name }}" id="diet_name" class="form-control" placeholder="Diet Name">
            </div>           
        </div>

        <div class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="short_code" class="form-label">Short Code:</label>
                <input type="text" name="short_code"  value="{{ @$diet->short_code }}" id="short_code" class="form-control" placeholder="Short Code">
            </div>           
        </div>
    
        <div class="offset-md-3 col-md-6 text-center">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </div>
   
</form>
@endsection