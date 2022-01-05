@extends('layouts.admin')
  
@section('content')
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-start">
            <h2>Add New addressee</h2>
        </div>
        <div class="float-end">
            <a class="btn btn-primary" href="{{ route('addressees.index') }}"> Back</a>
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
   
<form action="{{ route('addressees.store') }}" method="POST">
    @csrf
  
    <div class="row">
        <div class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Name">
            </div>

            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date:</label>
                <input type="text" name="birth_date" id="birth_date" class="form-control datepicker" placeholder="Birth Date">
            </div>

            <div class="mb-3">
                <label for="phone1" class="form-label">Contact No:</label>
                <input type="text" name="phone1" id="phone1" class="form-control" placeholder="Contact No">
            </div>

            <div class="mb-3">
                <label for="phone2" class="form-label">Alternate Contact No:</label>
                <input type="text" name="phone2" id="phone2" class="form-control" placeholder="Alternate Contact No">
            </div>

            <div class="mb-3">
                <label for="whatsapp_no" class="form-label">Whatsapp Number:</label>
                <input type="text" name="whatsapp_no" id="whatsapp_no" class="form-control" placeholder="Whatsapp Number">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
            </div>

            <div class="mb-3">
                <label for="email2" class="form-label">Email:</label>
                <input type="text" name="email2" id="email2" class="form-control" placeholder="Alternate Email">
            </div>

            <div class="mb-3">
                <label for="b_no" class="form-label">Block No:</label>
                <input type="text" name="b_no" id="b_no" class="form-control" placeholder="Block No">
            </div>

            <div class="mb-3">
                <label for="street" class="form-label">Street:</label>
                <input type="text" name="street" id="street" class="form-control" placeholder="Street">
            </div>

            <div class="mb-3">
                <label for="landmark" class="form-label">Landmark:</label>
                <input type="text" name="landmark" id="landmark" class="form-control" placeholder="Landmark">
            </div>

            <div class="mb-3">
                <label for="village" class="form-label">Village:</label>
                <input type="text" name="village" id="village" class="form-control" placeholder="Village">
            </div>

            <div class="mb-3">
                <label for="taluka" class="form-label">Taluka:</label>
                <input type="text" name="taluka" id="taluka" class="form-control" placeholder="Taluka">
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="City">
            </div>

            <div class="mb-3">
                <label for="state" class="form-label">State:</label>
                <input type="text" name="state" id="state" class="form-control" placeholder="State">
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Country:</label>
                <input type="text" name="country" id="country" class="form-control" placeholder="Country">
            </div>
        </div>
    </div>
    <div class="col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
   
</form>
@endsection