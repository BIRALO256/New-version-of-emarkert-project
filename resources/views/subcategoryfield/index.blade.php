@extends('layouts.master')


@section('top')
    <!-- Log on to codeastro.com for more projects! -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

@section('content')
 @php
    $counter = 1;
 @endphp
      @if($data7)
        <button class="btn btn-secondary btn-lg" style="background-color: #343a40; border-color: #6c757d; color:white;  margin-bott om:12px; " >{{$data7->name}}</button>
        @else
            <p>subcategoryfield not found.</p>
        @endif 
<div>
 <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">List</h3>
        </div>

        <div class="box-header">
        <a  href="{{route('add_Subcategoryfield', ['id' => Crypt::encrypt($data7->id) ,'id2' => Crypt::encrypt($data9->id)]) }}" style="margin-top:40px;" class="btn btn-success">Add Subcategory Field</a>     
        </div>


        <!-- /.box-header -->
        <div class="box-body">
           
        <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Subcategory Name</th>
                    <th scope="col" colspan="3" width="1%">Action</th> 
                </tr>
                </thead>

                <tbody>
                @foreach($subcategoryfields as $data)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{$data->name}}</td>
                            <td><a href="{{ route('displayFieldOption' , ['id' => Crypt::encrypt($data->id), 'id2' => Crypt::encrypt($data7->id)]) }}" class="btn btn-success">Field Option</a></td>
                            <td><button class="btn btn-primary edit-button" data-target="#editModal"><i class="fa fa-edit"></i></button></td>
                            <td><a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>  
                        </tr>
                @endforeach        
                  </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



{{$subcategoryfields->onEachSide(1)->links()}}
<a href="{{ route('display_Subcategory',   ['id' => Crypt::encrypt($data9->id )]) }}"><button type="button" class="btn btn-dark" style="color:white; background-color: #343a40;">Go Back</button></a>
@endsection
