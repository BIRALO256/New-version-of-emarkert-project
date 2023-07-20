@extends('layouts.master')
@section('top')

@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Change your Profile Picture</h3>
    </div>

    <form action="{{ route('profile_photo.update',$user->id) }}" method="POST">
        @csrf
    @method('PATCH')
    <div class="mt-3 block w-4/5 m-auto">
        <label for="name">Select your photo</label>
        <input type="file" class="w-full rounded-l text-2xl h-16" name="profile_image">
        @if ($errors->has('profile_image'))
        <span class="invalid-feedback" role="alert">
            <strong class="text-red-500">{{ $errors->first('profile_image') }}</strong>
        </span>
        @endif
    </div>


    <div class="mt-3 block w-4/5 m-auto">
        <button class="py-3 bg-green-700 hover:bg-green-600 w-full md:w-1/3 float-right rounded-lg text-white text-center">
            Update Photo
        </button>
    </div>
    </form>

    
         


            


    </div>

   
</div>
@stop