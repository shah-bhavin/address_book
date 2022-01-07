@extends('layouts.admin')
 
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="float-start">
                <h2>Diseases List</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('diseases.create') }}"> Create New disease</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="" id="sample">
        <thead>    
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Disease Name</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($diseases as $disease)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $disease->disease_name }}</td>
            <td class="text-center">
                <form action="{{ route('diseases.destroy',$disease->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('diseases.edit',$disease->id) }}"><i class="bi bi-pencil"></i></a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
     
@endsection