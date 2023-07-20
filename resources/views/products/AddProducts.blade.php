@extends('layouts.master')


@section('top')
    <!-- Log on to codeastro.com for more projects! -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data">  
    @csrf
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" class="form-control" id="name" name="ProductName" placeholder="Enter product name" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter product description" required></textarea>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        
        <select class="form-control" id="category" name="category" required>
            <option value="">Select a category</option>
            @foreach($data1 as $dataa)
            <option value="{{$dataa->id}}">{{$dataa->name}}</option>
            @endforeach
        </select>
       
    </div>
    <div class="form-group">
        <label for="price">Reward Points</label>
        <input type="number" class="form-control" id="price" name="rewardPoints" step="0.01" placeholder="Enter reward points">
    </div>
    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

 @endsection


