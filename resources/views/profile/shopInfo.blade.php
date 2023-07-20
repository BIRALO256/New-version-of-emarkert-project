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
            <a href="{{ route('profile.index') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Pofile</a>
        </li>
        <li class="mr-2">
            <a href="{{ route('profile.create')}}" class="inline-block p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500" aria-current="page">Shop Information
        </li>

        <li class="mr-2">
            <a href="{{ route('businessInfo') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Business Information</a>
        </li>
        <li class="mr-2">
            <a href="{{ route('payment') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Payment Information</a>
        </li>
    
    </ul>
</div>
{{-- tabbed interface ends here --}}

 {{-- printing the success message --}}
 @if (session('success'))
 <div id="success-message" class="alert alert-success bg-green-500">
{{ session('success') }}
</div>
@endif

<div class="w-full p-5">
  {!! Form::open(array('route' => ['shopInfo',Auth::user()->id], 'method' => 'POST','class'=>'flex flex-col')) !!}
        @csrf
        @method('PATCH')
        <div class="p-5">
            <h1 class="text-4xl">Shop Details</h3>
            <div class="form-group my-5 w-full px-5">
                <label for="shopName">Shop Name</label>
                <input type="text" class="w-full h-16 rounded-lg text-2xl" name="shop_name" value="{{ $vendor_shop ? $vendor_shop->shop_name : '' }}" placeholder="Shop Name" required >
            </div>
        </div>

{{-- provide communication details section --}}
        <div class="p-5">
            <h1 class="text-4xl">Communication Details</h3>
            <p class="my-3 text-gray-500 text-2xl">Choose the contact preference for communications from Market Place. We'll send communications and contact you on the details you povide below</p>
            <div class="grid grid-cols-2">
                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Contact Name</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="contact_name" value="{{ $vendor_shop ? $vendor_shop->contact_name : '' }}" placeholder="Contact Name" required >
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Email Address</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="email_address" value="{{ $vendor_shop ? $vendor_shop->email_address : '' }}" placeholder="Email Address" required>
    
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Contact Phone 1</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="phone1" value="{{ $vendor_shop ? $vendor_shop->contact_phone1 : '' }}" placeholder="Phone Contact" required >
    
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Contact Phone 2</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="phone2" value="{{ $vendor_shop ? $vendor_shop->contact_phone2: '' }}" placeholder="Phone Contact" >
    
                </div>
            </div>
        </div>

        {{-- provide customer care details section --}}
        <div class="p-5">
            <h1 class="text-4xl">Customer Care Details</h3>
            <p class="my-3 text-gray-500 text-2xl">Please provide details of your customer support. These details will be used to adrress product issues by customers</p>

            <div class="grid grid-cols-2">
                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Address Line 1</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="address1" value="{{ $vendor_shop ? $vendor_shop->address_line1 : '' }}" placeholder="Address Line" required >
    
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Address Line 2</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="address2" value="{{ $vendor_shop ? $vendor_shop->address_line2 : '' }}" placeholder="Address Line">
    
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">City/Town</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="city_town" value="{{ $vendor_shop ? $vendor_shop->city_town : '' }}" placeholder="City/Town" required >
    
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">State/Region</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="state_region" value="{{ $vendor_shop ? $vendor_shop->state_region : '' }}" placeholder="State/Region" required>
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Country</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="country" value="{{ $vendor_shop ? $vendor_shop->country : '' }}" placeholder="Country" required>
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Postal Code</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="postal_code" value="{{ $vendor_shop ? $vendor_shop->postal_code : '' }}" placeholder="Postal Code" required >
                </div>

            </div>

        </div>

        {{-- button for saving details --}}
        <div class="mt-3 block w-full m-auto pull-right p-7">
            <button class="bg-green-700 hover:bg-green-600 w-full md:w-1/5 float-right  rounded-lg text-white text-2xl h-16">
                Save Details
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