@extends('layouts.master')


@section('top')
    <!-- Log on to codeastro.com for more projects! -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<script>
     setTimeout(function() {
                document.getElementById('success-message').remove();
            }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

</script>
@if(session('message'))
    <div  id="success-message"class="alert alert-success">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<form action="{{ route('storeFieldOption') }}" method="POST">  
    @csrf
    <div class="form-group">
        <label for="category">Subcategory field</label>
        
        <select class="form-control" id="subcategoryfield" name="subcategoryFieldID" required>
            <option value="{{$data13->id}}">{{$data13->name}}</option>
        </select>
       
    </div>

    <div class="form-group">
        <label for="name">Field option name</label>
        <input type="text" class="form-control" id="name" name="fieldOption" placeholder="Enter field option name" required>
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
    

</form>

   

@endsection