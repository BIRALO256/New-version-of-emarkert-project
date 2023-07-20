@extends('buyer_layouts.master')
@section('top')

@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')


<div class="box box-success">
   
    <div class="box-header">
        <h3 class="box-title">Total Addresses: <strong>({{ count($user_addresses) }})</strong></h3>
    </div>


    <div class="box-header">
        @can('user-create')
        <a href="{{ route('addAddress') }}" class="btn bg-purple-600 pull-right text-white hover:bg-purple-500 hover:text-white" ><i class="fa fa-plus"></i> Add Address</a> 
        @endcan
    </div>

       {{-- printing the success message --}}
         {{-- printing the success message --}}
         @if (session('success'))
         <div id="success-message" class="alert alert-success bg-green-500">
             {{ session('success') }}
         </div>
        @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 text-3xl">
        
        @foreach ($user_addresses as $user_address )
            
        <div class="w-11/12 text-2xl m-auto p-5 rounded overflow-hidden shadow-lg mb-10 bg-gray-100 hover:bg-purple-300">
            <div class="px-6 py-4">
              <div class="font-bold mb-2">Address</div>
              <p class="text-gray-700">
                {{ $user_address->address }}
              </p>
            </div>
            <div class="px-6 pt-4 pb-2">
              <span class="inline-block bg-gray-200 rounded-full px-3 py-1 font-semibold text-gray-700 mr-2 mb-2">{{ $user_address->user->name }}</span>
              <span class="inline-block bg-gray-200 rounded-full px-3 py-1 font-semibold text-gray-700 mr-2 mb-2">{{ $user_address->user->phone_number }}</span>
              
            </div>
            <div class="px-6 pt-4 pb-2">
                <a href="{{ route('account.edit',Crypt::encrypt($user_address->id)) }}"><span class="inline-block bg-blue-400 rounded-lg px-3 py-1 font-semibold text-white mr-2 mb-2"><i class="fas fa-edit px-1"></i>Edit</span></a>

                @if (count($user_addresses) > 1)
                {!! Form::open(['method' => 'DELETE','route' => ['account.destroy', Crypt::encrypt($user_address->id)],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'inline-block bg-red-400 rounded-lg px-3 py-1 font-semibold text-white mr-2 mb-2']) !!}
                {!! Form::close() !!}
                    
                @endif
               
              </div>
            <div class="block w-full p-5">
                <span><input type="checkbox" value="default" class="pr-5 w-6 h-6"><strong class="mx-5 text-purple-900 uppercase font-normal">Set as default</strong></span>

            </div>
          </div>
            
            
        @endforeach()
       
            
        <div>

        </div>

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