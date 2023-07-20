@extends('layouts.master')


@section('top')
    <!-- Log on to codeastro.com for more projects! -->
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th>Name</th>
      <th>number</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data2 as $data)
    <tr>
      <td>{{$data->name}}</td>
      <td>{{$data->id}}</td>
    </tr>
    @endforeach
  </tbody>
</table>



 


@endsection