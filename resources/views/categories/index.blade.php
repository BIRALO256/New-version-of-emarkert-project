@extends('layouts.master')


@section('top')
    <!-- Log on to codeastro.com for more projects! -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

@php
    $counter = 1;
 @endphp

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

        <div >
            
        <button class="btn btn-secondary btn-lg" style="background-color: #343a40; border-color: #6c757d; color:white; margin-bottom:16px;" ><i class="fa fa-plus"></i>
Catergory</button>

            <form  action="{{ route('AddCatergory') }}" methode="POST">
                @csrf
              <input type="text" name="name" class="form-control" placeholder="Add Category" style="margin-bottom:20px;" required>
              <input  class="btn btn-success delete-button" type="submit" name="submit"  style="margin-bottom:12px;" value="Submit">
            </form>
        </div>


<div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">List</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
           
        <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>category Name</th>
                    <th scope="col" colspan="3" width="1%">Action</th> 
                </tr>
                </thead>

                <tbody>
                @foreach($data1 as $data)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{$data->name}}</td>
                            <td><a href="{{ route('display_Subcategory', ['id' => Crypt::encrypt($data->id)]) }}" class="btn btn-success">Subcategory</a></td>
                            <td><button class="btn btn-primary edit-button" data-target="#editModal"><i class="fa fa-edit"></i></button></td>
                            <td> <a onclick="return confirm('Are you sure you want to delete')" href="{{route('delete_category', $data->id)}}" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>  
                        </tr>
                @endforeach        
                  </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
{{$data1->onEachSide(1)->links()}}
@endsection



