@extends('layouts.master')
@section('top')
{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style type="text/css">
    .row-centered
    {
        text-align: center;
    }
    .col-centered
    {
        display: inline-block;
        float: none;
        text-align: left;
        margin-right: -4px;
    }
</style>
@vite('resources/css/app.css')

@stop
@section('content')
<div class="box box-success">
  <div class="box-header">
    <a href="{{ route('user.index') }}"><i class="fas fa-arrow-left px-5 text-3xl"></i></a><h3 class="box-title">Edit {{ $user->name }}</h3>
  </div>
  

  <div class="mt-20">
    {!! Form::open(array('route' => ['user.update',$user->id], 'method' => 'POST','class'=>'bg-white shadow-md rounded px-8 mt-6 pb-8 mb-4 w-4/5 m-auto mt-15')) !!}
    @csrf

  @method('PATCH')
      {{-- User name field --}}
      <div class="mb-4">
        <label class="block text-gray-700  font-bold mb-2" for="role_name">
          User Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
        id="name" type="text" name="name" value="{{ $user->name }}" required >
      </div>

        {{-- User email field --}}
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2" for="role_name">
            User Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
            id="name" type="text" name="email" value="{{ $user->email }}" required >
        </div>

     {{-- User phone number field --}}
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="role_name">
          User Phone Number
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
        id="name" type="text" name="phone" value="{{ $user->phone_number }}">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700  font-bold mb-2" for="role">
          User Role
        </label>
        <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
        id="role" type="text" name="role" required >
            <option value="{{ $userRole }}">{{ $userRole}}</option> 

            @foreach ($roles as $role )
            <option value="{{ $role->name }}">{{ $role->name }}</option> 
            @endforeach

        </select>
      </div>
       

      <button class="bg-green-700 hover:bg-green-600 w-1/5 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded float-right my-10 h-16 text-2xl">
        Save User Changes
      </button>
    </div>
    {!! Form::close() !!}

  </div>
</div>
@stop





    