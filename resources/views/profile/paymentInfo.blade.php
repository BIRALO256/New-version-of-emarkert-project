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
            <a href="{{ route('businessInfo') }}" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Business Information</a>
        </li>
        <li class="mr-2">
            <a href="{{ route('payment') }}" class="inline-block p-4 text-green-600 border-b-2 border-green-600 rounded-t-lg active dark:text-green-500 dark:border-green-500" aria-current="page">Payment Information</a>
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
    {!! Form::open(array('route' => ['paymentInfo',Auth::user()->id], 'method' => 'POST','class'=>'flex flex-col')) !!}
    @csrf
    @method('PATCH')
    {{-- provide communication details section --}}
        <div class="p-5">
            <h1 class="text-4xl">Your prefered payment option</h3>
            <p class="my-3 text-gray-500 text-2xl">Please choose one of your prefered payment options and provide all required information. Incase of uploads, Market Place will verify the validity of your provided documents as soon as possible.</p>
            <div class="py-5">

                {{-- displaying a radio button for bank payment option --}}

                <div class="form-group my-5 w-full px-5 block bank-payment">
                    <input type="radio" id="bank_payment" class="w-8 h-8 border-gray-300 focus:ring-2 focus:ring-green-300 dark:focus:ring-green-600 dark:focus:bg-green-600 dark:bg-gray-700 dark:border-gray-600" name="payment_option" value="Bank account" >
                    <label for="shopName" class="font-normal text-3xl mx-5">Bank Account payment</label>
                </div>

                {{-- form fields hidded and only displayed when appropriate payment option is selected --}}

                {{-- display form below if bank account is selected --}}
                <div id="bank_payment_form" style="display: none;">
                    <div class="grid grid-cols-2">
                        <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Bank Name</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="bank_name"
                            value="{{$payment_method ? $payment_method->bank_name : ''}}"
                             placeholder="Name of bank where account exists" >
            
                        </div>
        
                        <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Account Name</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="account_name"
                            value="{{$payment_method ? $payment_method->bank_account_name : ''}}"
                             placeholder="Name in which account is registered">
            
                        </div>

                        <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Account Type</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="account_type"
                            value="{{$payment_method ? $payment_method->bank_account_type : ''}}"
                             placeholder="Type of account e.g Current Account">
                        </div>
        
                        <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Account Number</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="account_number"
                            value="{{$payment_method ? $payment_method->bank_account_number : ''}}"
                             placeholder="Bank Account Number" >
            
                        </div>
        
                        {{-- <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Attach Bank Document</label>
                            <input type="file" class="w-full h-16 rounded-lg text-2xl" name="bank_doc" placeholder="Upload bank document for veification" >
                        </div> --}}
        
                    </div>
        
                </div>

                {{-- displaying a radio button for mobile money option --}}

                <div class="form-group my-5 w-full px-5 mm-payment">
                    <input type="radio" id="mobile_money" class="w-8 h-8 border-gray-300 focus:ring-2 focus:ring-green-300 dark:focus:ring-green-600 dark:focus:bg-green-600 dark:bg-gray-700 dark:border-gray-600"   name="payment_option" value="Mobile Money">
                    <label for="shopName" class="font-normal text-3xl mx-5" >Mobile Money payment</label>
    
                </div>


                {{-- display the below form if mobile money is selected --}}
                 {{-- display form below if bank account is selected --}}
                 <div id="mobile_money_form" style="display: none;">
                    <div class="grid grid-cols-2">
                        <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Registered Mobile Money Name</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="mobile_name" value="{{$payment_method ? $payment_method->mmoney_name : ''}}" placeholder="Name in which mobile money number is registered" >
            
                        </div>
        
                        <div class="form-group my-5 w-full px-5">
                            <label for="shopName">Registered Mobile Money Number</label>
                            <input type="text" class="w-full h-16 rounded-lg text-2xl" name="mobile_number" value="{{$payment_method ? $payment_method->mmoney_number : ''}}" placeholder="Provide the registered mobile money number">
            
                        </div>
                    </div>
        
                </div>

            </div>
        </div>

        {{-- button for saving details --}}
        <div class="mt-3 block w-full m-auto pull-right p-7">
            <button class="bg-green-700 hover:bg-green-600 w-full md:w-1/5 float-right rounded-lg text-white text-2xl h-16">
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


var bankButton = document.getElementById("bank_payment");
var mobileMoneyButton = document.getElementById("mobile_money");
var mobileMoneyDiv = document.querySelector('.mm-payment');
var bankPaymentDiv = document.querySelector('.bank-payment');


        
function showForm(formId) {
//   bankButton.style.display = "none";
//   mobileMoneyButton.style.display = "none";

  form = document.getElementById(formId);
  form.style.display = "block";
}
document.getElementById("bank_payment").addEventListener("change", function() {
  showForm("bank_payment_form");
  document.getElementById("mobile_money_form").style.display="none";
//   bankPaymentDiv.classList('text-green-500');
});

document.getElementById("mobile_money").addEventListener("change", function() {
  showForm("mobile_money_form");
  document.getElementById("bank_payment_form").style.display="none";
//   mobileMoneyDiv.style.color="green";
});
    





</script>
@stop