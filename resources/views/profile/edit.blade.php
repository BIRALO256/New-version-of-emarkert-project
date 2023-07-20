@extends('layouts.master')
@section('top')

@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')

<div class="box box-success" >
    <div class="box-header">
        <a href="{{ route('profile.index') }}"><i class="fas fa-arrow-left px-5 text-3xl"></i></a><h3 class="box-title">Edit your Profile</h3>
    </div>

     {{-- printing the success message --}}
     @if (session('error'))
     <div id="error-message" class="alert alert-success bg-red-500 w-4/5 m-auto py-2 px-2 rounded-lg text-white h-14">
         {{ session('error') }}
     </div>
     @endif

    <div class="w-full py-3 rounded-lg pb-20">
        {!! Form::open(array('route' => ['profile.update',$user->id], 'method' => 'POST')) !!}
        @csrf
            @method('PATCH')

            <div class="mt-3 block w-4/5 m-auto">
                <label for="name">Name</label>
                <input type="text" class="w-full rounded-lg text-2xl h-16" value="{{ $user->name }}" name="name" required >
    
            </div>
    
            <div class="mt-3 block w-4/5 m-auto">
                <label for="name">Email</label>
                <input type="text" class="w-full rounded-lg text-2xl h-16 " value="{{ $user->email }}" name="email" required >
    
            </div>
    
            <div class="mt-3 block w-4/5 m-auto">
                <label for="name">Phone Number</label>
                <input type="text" class="w-full rounded-lg text-2xl h-16" value="{{ $user->phone_number }}" name="phone" required>
    
            </div>
    
            <div class="mt-3 block w-4/5 m-auto">
                <label for="name">New password</label>
                <input type="password" class="w-full rounded-lg text-2xl h-16" name="password" >
            </div>
    
            <div class="mt-3 block w-4/5 m-auto">
                <label for="name">Confirm password</label>
                <input type="password" class="w-full rounded-lg text-2xl h-16" name="password">
            </div>

            {{-- printing the success message --}}
         {{-- printing the success message --}}
         @if (session('success'))
         <div id="success-message" class="alert alert-success bg-green-500">
             {{ session('success') }}
         </div>
        @endif

            <div class="mt-3 block w-4/5 m-auto">
                <button class="bg-green-700 hover:bg-green-600 w-full md:w-1/3 float-right h-10 rounded-lg text-white text-2xl h-16">
                    Update Profile
                </button>
            </div>

        {!! Form::close() !!}


    </div>

   
</div>

<script>
     setTimeout(function() {
            document.getElementById('success-message').remove();
        }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)


</script>

@stop



   