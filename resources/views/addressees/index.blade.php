@extends('layouts.admin')
 
@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="float-start">
                <h2>Address Book</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-success" href="{{ route('addressees.create') }}"> Create New addressee</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($addressees as $addressee)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $addressee->name }}</td>
            <td>{{ $addressee->detail }}</td>
            <td>
                <form action="{{ route('addressees.destroy',$addressee->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('addressees.show',$addressee->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('addressees.edit',$addressee->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $addressees->links() !!}
      
@endsection