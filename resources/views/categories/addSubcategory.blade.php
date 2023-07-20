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
<form action="{{ route('store_subcatergory') }}" method="POST">  
    @csrf
    <div class="form-group">
        <label for="category">Category</label>
        
        <select class="form-control" id="subcategory" name="categoryID" required>
            <option value="{{$data5->id}}">{{$data5->name}}</option>
        </select>
       
    </div>

    <div class="form-group">
        <label for="name">Subcategory Name</label>
        <input type="text" class="form-control" id="name" name="subcatergory" placeholder="Enter subcategory name" required>
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('display_Subcategory',   ['id' => Crypt::encrypt($data5->id )]) }}"><button type="button" class="btn btn-dark" style="color:white; background-color: #343a40;">Go Back</button></a>

</form>

   

@endsection
