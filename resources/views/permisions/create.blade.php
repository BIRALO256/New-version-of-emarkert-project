@extends('layouts.master')
@section('top')

@vite('resources/css/app.css')

@stop
@section('content')

<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">Add New Permission</h3>
  </div>
    <form action="{{ route('permissions.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        {{-- field for inputing permission name --}}
      <div class="form-group">
        <label class="block text-gray-700 text font-bold mb-2" for="permission_name">
          Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-16 text-2xl"
         id="permission_name" type="text" placeholder="Enter permission name" name="name">
      </div>
      {{-- field for inputing permission description --}}
      <div class="mb-4">
        <label class="block text-gray-700 font-bold mb-2" for="description">
          Permission Description
        </label>
        <textarea rows="7" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-2xl"
         name="description" placeholder="Please enter a description for the permission" required></textarea>
    </div>

      <button class="bg-green-700 hover:bg-green-600 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded float-right my-10 w-full md:w-1/5 h-16 text-2xl uppercase">
        Save Permission
      </button>
    </div>
    </form>
      
</div>
@stop





    




   





       
