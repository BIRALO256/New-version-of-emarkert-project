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
<form action="{{ route('store_subcatergoryfield') }}" method="POST">  
    @csrf
    <div class="form-group">
        <label for="category">Sub Category</label>
        
        <select class="form-control" id="subcategoryfield" name="subcategoryID" required>
            <option value="{{$data8->id}}">{{$data8->name}}</option>
        </select>
       
    </div>

    <div class="form-group">
        <label for="name">Subcategory field Name</label>
        <input type="text" class="form-control" id="name" name="subcatergoryfield" placeholder="Enter subcategory field name" required>
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('display_Subcategoryfield',   ['id' => Crypt::encrypt($data8->id ),'id2' => Crypt::encrypt($data11->id)]) }}"><button type="button" class="btn btn-dark" style="color:white; background-color: #343a40;">Go Back</button></a>

</form>

   

@endsection