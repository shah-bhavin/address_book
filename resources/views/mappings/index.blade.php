@extends('layouts.admin')
 
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="float-start">
                <h2>Mappings List</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('mappings.create') }}"> Create New mapping</a>
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
                <th class="text-center">Diet List</th>
                <th class="text-center">Treatment List</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($mappings as $mapping)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $mapping->disease_ref }}</td>
            <td class="text-center">{{ $mapping->diet_ref }}</td>
            <td class="text-center">{{ $mapping->treatment_ref }}</td>
            <td class="text-center">
                <form action="{{ route('mappings.destroy',$mapping->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('mappings.edit',$mapping->id) }}"><i class="bi bi-pencil"></i></a>
   
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