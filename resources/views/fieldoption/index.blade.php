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

      @if($data12)
        <button class="btn btn-secondary btn-lg" style="background-color: #343a40; border-color: #6c757d; color:white;  margin-bottom:12px; " >{{$data12->name}}</button>
        @else
            <p>subcategoryfield not found.</p>
        @endif 
 <div class="box box-success">

        <div class="box-header">
            <h3 class="box-title">List</h3>
        </div>

        <div class="box-header">
            <a  href="{{route('storeFieldOptionpage', ['id' => Crypt::encrypt($data12->id),'id2' => Crypt::encrypt($data14->id)]) }}" class="btn btn-success" ><i class="fa fa-plus"></i> Add field option</a>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
           
        <table id="user-table" class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th>Number</th>
                    <th>Field Option Name</th>
                    <th scope="col" colspan="3" width="1%">Action</th> 
                </tr>
                </thead>

                <tbody>
                @foreach($data1 as $data)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{$data->name}}</td>
                            <td><button class="btn btn-primary edit-button" data-target="#editModal"><i class="fa fa-edit"></i></button></td>
                            <td><a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td>  
                        </tr>
                @endforeach        
                  </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>



{{$data1->onEachSide(1)->links()}}
<a href="{{ route('display_Subcategoryfield' , ['id' => Crypt::encrypt($data14->id), 'id2' => Crypt::encrypt($data12->id)]) }}"><button type="button" class="btn btn-dark" style="color:white; background-color: #343a40;">Go Back</button></a>

@endsection
