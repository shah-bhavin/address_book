@extends('layouts.admin')
 
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="float-start">
                <h2>Treatments List</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('treatments.create') }}"> Create New treatment</a>
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
                <th class="text-center">Treatment Name</th>
                <th class="text-center">Short Code</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($treatments as $treatment)
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $treatment->treatment_name }}</td>
            <td class="text-center">{{ $treatment->short_code }}</td>
            <td class="text-center">
                <form action="{{ route('treatments.destroy',$treatment->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('treatments.edit',$treatment->id) }}"><i class="bi bi-pencil"></i></a>
   
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