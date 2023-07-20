@extends('buyer_layouts.master')
@section('top')

@vite('resources/css/app.css')

{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


@stop
@section('content')
<div class="box box-success">
    <div class="box-header">
        <a href="{{ route('account.create') }}"><i class="fas fa-arrow-left px-5 text-3xl"></i></a><h3 class="box-title">Edit Address</h3>
    </div>
    

    {{-- printing the success message --}}
    @if (session('error'))
    <div id="error-message" class="alert alert-success bg-red-500 w-4/5 m-auto py-2 px-2 rounded-lg text-white h-14">
        {{ session('error') }}
    </div>
    @endif


            {{-- printing the success message --}}
         {{-- printing the success message --}}
         @if (session('success'))
         <div id="success-message" class="alert alert-success bg-green-500">
             {{ session('success') }}
         </div>
        @endif

    {!! Form::open(array('route' => ['account.update',$address->id], 'method' => 'POST','class'=>'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4')) !!}
    @csrf
    @method('PATCH')

     

    <div class="w-full py-3 rounded-lg pb-20">
        
        <hr class="my-5 mt-5">
        <div class="form-group my-5 w-full px-5">
            <label for="address">Address</label>
            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="address" value="{{ $address->address }}" placeholder="Your address" required >
        </div>

        <div class="form-group my-5 w-full px-5">
            <label for="shopName">Additional Information</label>
            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="information" value="{{ $address->add_information }}" placeholder="Additional information" required>

        </div>

        <div class="grid grid-cols-2">

            <div class="form-group my-5 w-full px-5">
                <label for="shopName">Country</label>
                <input type="text" class="w-full h-16 rounded-lg text-2xl" name="country" value="{{ $address->country }}" placeholder="Country" required >

            </div>
            <div class="form-group my-5 w-full px-5">
                <label for="shopName">Region</label>
                <input type="text" class="w-full h-16 rounded-lg text-2xl" name="region" value="{{ $address->region }}" placeholder="Region" required >

            </div>

            <div class="form-group my-5 w-full px-5">
                <label for="shopName">City/Town</label>
                <input type="text" class="w-full h-16 rounded-lg text-2xl" name="city_town" value="{{ $address->city_town }}" placeholder="City/Town" >

            </div>
        </div>


            <div class="mt-3 block w-4/5 m-auto pull-right mr-5">
                <button class=" bg-purple-900 hover:bg-purple-800 w-full md:w-1/3 float-right rounded-lg text-white text-2xl h-16">
                    Save Address
                </button>
            </div>

    {!! Form::close() !!}
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