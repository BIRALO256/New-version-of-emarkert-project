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
        </li>
        <li class="mr-2">
            <a href="{{ route('profile.index') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Pofile</a>
        </li>
        <li class="mr-2">
            <a href="{{ route('profile.create') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Shop Information</a>
        </li>

        <li class="mr-2">
            <a href="{{ route('businessInfo') }}" class="inline-block p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500" aria-current="page">Business Information</a>
        </li>
        <li class="mr-2">
            <a href="{{ route('payment') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Payment Information</a>
        </li>
         
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
  {!! Form::open(array('route' => ['createOrUpdateVendorBusiness',Auth::user()->id], 'method' => 'POST','class'=>'flex flex-col')) !!}
  @csrf
  @method('PATCH')

        <div class="p-5">
            <h1 class="text-4xl">Legal Business Owner Details</h3>
                <p class="my-3 text-gray-500 text-2xl">Please provide the following details of the owner / legal representative of your business. These details should be same as those in the supporting documents attached.</p>
                <div class="grid grid-cols-2">
                    <div class="form-group my-5 w-full px-5">
                        <label for="shopName">Full Name</label>
                        <input type="text" class="w-full h-16 rounded-lg text-2xl" name="owner_name" value="{{ $vendor_business ? $vendor_business->owner_name : '' }}" placeholder="Name as on the ID" >
                    </div>
    
                    <div class="form-group my-5 w-full px-5">
                        <label for="shopName">Identification Type</label>
                        <select name="identification" id="selection" class="w-full h-16 rounded-lg text-2xl">
                            <option value="{{ $vendor_business ? $vendor_business->id_type : '' }}" >{{ $vendor_business ? $vendor_business->id_type : '' }}</option>
                            <option value="National ID" id="national_id_">National/State ID</option>
                            <option value="Driving Lisence"  id="lisence">Driving Lisence</option>
                            <option value="Passport" id="passport">Passport</option>
                        </select>        
                    </div>
                    {{-- forms to display based on the selection id --}}
                     {{-- display form below if national id  is selected --}}
                    <div id="national_id_form" style="display: none;">
                        <div class="form-group my-5 w-full px-5">
                            <label for="nin">National/State ID</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="nin_number" value="{{ $vendor_business ? $vendor_business->id_number : '' }}" placeholder="National/State ID Number" >
            
                        </div>
        
                        <div class="form-group my-5 w-full px-5">
                            <label for="national_id_file">Attach ID</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="national_id_file" placeholder="Both front and back sides on same page">
                        </div>
                    </div>

                    {{-- display form below if passport is selected --}}
                    <div id="passport_form" style="display: none;">
                        <div class="form-group my-5 w-full px-5">
                            <label for="passport_number">Passport</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="passport_number" value="{{ $vendor_business ? $vendor_business->id_number : '' }}" placeholder="Passport Number" >
            
                        </div>
        
                        <div class="form-group my-5 w-full px-5">
                            <label for="passport_file">Attach Passport</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="passport_file" placeholder="Both front and back sides on same page">
                        </div>
                    </div>

                    {{-- display form below if driving lisence is selected --}}
                    <div id="driving_lisence_form" style="display: none;">
                        <div class="form-group my-5 w-full px-5">
                            <label for="lisence_number">Driving Lisence</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="lisence_number" value="{{ $vendor_business ? $vendor_business->id_number : '' }}" placeholder="Driving Lisence Number" >
                        </div>
        
                        <div class="form-group my-5 w-full px-5">
                            <label for="lisence_file">Attach Driving Lsence</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="lisence_file" placeholder="Both front and back sides on same page">
                        </div>
                    </div>
                </div>
        </div>


        {{-- provide customer care details section --}}
        <div class="p-5">
            <h1 class="text-4xl">Legal Business Address</h3>
            <p class="my-3 text-gray-500 text-2xl">Please provide the registered address of your business.</p>

            <div class="grid grid-cols-2">
                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Address Line 1</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="address1" value="{{ $vendor_business ? $vendor_business->address1 : '' }}" placeholder="Address Line" >
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Address Line 2</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="address2" value="{{ $vendor_business ? $vendor_business->address2 : '' }}" placeholder="Address Line">
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">City/Town</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="city_town" value="{{ $vendor_business ? $vendor_business->city_town : '' }}" placeholder="City/Town" >
    
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">State/Region</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="state_region" value="{{ $vendor_business ? $vendor_business->state_region : '' }}" placeholder="State/Region" >
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Country</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="country" value="{{ $vendor_business ? $vendor_business->country : '' }}" placeholder="Country" >
                </div>

                <div class="form-group my-5 w-full px-5">
                    <label for="shopName">Postal Code</label>
                    <input type="text" class="w-full h-16 rounded-lg text-2xl" name="postal_code" value="{{ $vendor_business ? $vendor_business->postal_code : '' }}" placeholder="Postal Code" >
                </div>

            </div>

        </div>

        {{-- button for saving details --}}
        <div class="mt-3 block w-full m-auto pull-right p-7">
            <button class="bg-green-700 hover:bg-green-600 w-full md:w-1/5 float-right h-10 rounded-lg text-white text-2xl h-16">
                Save Details
            </button>
        </div>
     



    </form>

</div>

<script>
    setTimeout(function() {
           document.getElementById('success-message').remove();
       }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

       setTimeout(function() {
           document.getElementById('error-message').remove();
       }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

  
       // Function to show the selected form and hide others
    function showForm(formId) {
        const forms = ['national_id_form', 'passport_form', 'driving_lisence_form'];
        forms.forEach(form => {
            const formElement = document.getElementById(form);
            if (form === formId) {
                formElement.style.display = 'block';
            } else {
                formElement.style.display = 'none';
            }
        });
    }

    // Get the selection element
    const selection = document.getElementById("selection");

    // Add an event listener to handle form display
    selection.addEventListener("change", function () {
        const selectedOption = this.value;
        showForm(selectedOption.toLowerCase().replace(/ /g, '_') + '_form');
    });

    // On page load, check the initial selected option and show the corresponding form
    showForm(selection.value.toLowerCase().replace(/ /g, '_') + '_form');

</script>
@stop