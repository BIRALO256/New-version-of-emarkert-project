@extends('layouts.master')
@section('top')

@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')

<div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">View and Edit your Account Info</h3>
    </div>

    {{-- adding a tabbed interface for the profile and other user information --}}
    <div class="text-2xl font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px">  
            <li class="mr-2">
                <a href="{{ route('profile.index') }}" class="inline-block p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500" aria-current="page">Profile</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('profile.create') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Shop Information</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('businessInfo') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Business Information</a>
            </li>
            <li class="mr-2">
                <a href="{{ route('payment') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Payment Information</a>
            </li>
            
            </li>
        </ul>
    </div>


    <div class="w-full py-3 rounded-lg pb-16">

         {{-- printing the success message --}}
         @if (session('success'))
         <div id="success-message" class="alert alert-success text-center w-4/5 m-auto py-2 rounded-lg text-white h-14">
             {{ session('success') }}
         </div>
        @endif

         {{-- printing the error message --}}
     @if (session('error'))
     <div id="error-message" class="alert alert-danger text-center w-4/5 m-auto py-2 px-2 rounded-lg text-white h-14">
         {{ session('error') }}
     </div>
     @endif
            {{-- profile image --}}
            

            {{-- edit form --}}
            <div class="w-full py-3 rounded-lg pb-20">
                {!! Form::open(array('route' => ['profile.update',$user->id], 'method' => 'POST','enctype'=>'multipart/form-data')) !!}
                @csrf
                @method('PATCH')

                    {{-- update the image --}}
                    <div class="flex flex-grow w-4/5 m-auto">
                        <div>
                            @if ($user->profile_photo_path)
                            <img src="{{ asset('storage/images/profiles/'.$user->profile_photo_path) }} " class="img-circle w-60" alt="User Image">

                            @else
                            <img src="{{ asset('user-profile.png') }} " class="img-circle w-60" alt="User Image">
                            @endif
                            {{-- <a href="{{ route('profile_photo.edit', Crypt::encrypt($user->id)) }}" class="py-3 bg-green-700 hover:bg-green-600 mx-10 rounded-lg text-white text-center w-1/4">
                                <i class="fas fa-edit mr-3"></i>Edit photo
                            </a> --}}
                            <label>
                                Choose a picture
                                <input type="file" class="text-grey-500
                                file:mr-5 file:py-3 file:px-10
                                file:rounded-full file:border-0
                                file:text-md file:font-semibold  file:text-white
                                file:bg-gradient-to-r file:from-blue-600 file:to-amber-600
                                hover:file:cursor-pointer hover:file:opacity-80"  name="profile_pic"/>
                            </label>
                            @if ($errors->has('profile_pic'))
                            <span class="invalid-feedback" role="alert">
                                <strong class="text-red-500">{{ $errors->first('profile_pic') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{-- <div class="my-24 mx-24">
                            <h2>{{ $user->name }}</h2>
                            <p class="text-gray- text-gray-500">{{ $user->email }}</p>
                        </div> --}}
        
        
                    </div>
        
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

        setTimeout(function() {
            document.getElementById('error-message').remove();
        }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)


</script>
@stop