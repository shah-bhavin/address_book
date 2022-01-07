@extends('layouts.admin')
  
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-start">
            @if(@$disease->id)
                <h2>Edit - {{ @$disease->disease_name }}</h2>
            @else
                <h2>Add New disease</h2>
            @endif
        </div>
        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('diseases.index') }}"> Back</a>
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
   
@if(@$disease->id)
    <form action="{{ route('diseases.update',@$disease->id) }}" method="POST">
    @csrf
    @method('PUT')
@else
    <form action="{{ route('diseases.store') }}" method="POST">
    @csrf
@endif

    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Disease Name:</label>
                <input type="text" name="disease_name"  value="{{ @$disease->disease_name }}" id="disease_name" class="form-control" placeholder="Disease Name">
            </div>           
        </div>
    
        <div class="offset-md-3 col-md-6 text-center">
            <button type="submit" class="btn btn-primary float-end">Submit</button>
        </div>
    </div>
   
</form>
@endsection