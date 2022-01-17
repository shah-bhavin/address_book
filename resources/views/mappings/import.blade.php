@extends('layouts.admin')
  
@section('content')

<div class="container">
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }} mt-3">{{ Session::get('message') }}</p>
    @endif

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
            <div class="mt-3 mb-3 align-self-center">
                <input type="file" name="file" id="file" class="form-control">
            </div>           

            <div class="text-center">
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection