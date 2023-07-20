@extends('layouts.master')
@section('top')


@stop
@section('content')
@vite('resources/css/app.css')

<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">Edit Permission</h3>
  </div>
    {!! Form::open(array('route' => ['permissions.update',$permission->id], 'method' => 'POST','class'=>'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4')) !!}
        @method('PATCH')
        @csrf
        {{-- field that contains the permission name --}}
      <div class="form-group">
        <label class="block text-gray-700 h-16 font-bold mb-2" for="name">
          Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
         id="permission_name" name="name" type="text" value="{{ $permission->name }}">
      </div>

      {{-- field that contains the permission description --}}
      <div class="form-group">
        <label class="block text-gray-700 font-bold mb-2" for="description">
          Permission Description
        </label>
        <textarea rows="7" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-2xl"
         name="description"  placeholder="Please enter a description for the oermission" required>{{ $permission->description }}</textarea>
     </div>

      <button class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded float-right my-10 w-full md:w-1/4 h-16 uppercase">
        Update Permission
      </button>
      {!! Form::close() !!}

  </div>


  

@stop





    




   





       





    


       


