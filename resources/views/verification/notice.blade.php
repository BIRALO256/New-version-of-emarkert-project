<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify Your Email</title>
@vite('resources/css/app.css')
    
</head>
<body>
    <div class="w-full md:w-2/3 m-auto justify-center mt-20 bg-slate-50 px-5">
        <div class="w-full bg-green-700 ">
        <h1 class="text-white mx-3 py-4">Email Verification</h1>


        </div>
        
        @if (session('resent'))
            <div class="bg-green-300 py-4 px-3" role="alert" id="success-message">
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        <p class="py-4 mx-5 font-bold">
            Your email is not verified
    
            </p>


        <p class="py-4 mx-5">
        Before proceeding, please check your email for a verification link. If you did not receive the email,

        </p>
    
        <form action="{{ route('verification.resend') }}" method="POST" class="d-inline mx-5 text-green-700">
            @csrf
            <button type="submit" class="font-bold text-xl">
                click here to request another
            </button>.
        </form>
        <span class="mx-5 py-4">Still haven't recieved a verification link? Make sure you submitted a correct email.</span>
    </div>


    <script>
         setTimeout(function() {
                document.getElementById('success-message').remove();
            }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

    </script>
    
</body>
</html>
