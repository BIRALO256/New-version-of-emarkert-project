<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | IMS</title>
    <!-- Log on to codeastro.com for more projects! -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/linearicons/style.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/img/favicon.png')}}">

    {{-- linking the tailwindcss using @vite --}}
    @vite('resources/css/app.css')

    {{-- linking the font awesome css to use icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <!-- <div class="logo text-center"><img src="{{asset('assets/img/logo-dark.png')}}" alt="IMS Logo"></div> -->
                                <p class="lead">Create a new account</p>
                            </div>
                            {{-- display error message --}}
                            @if (session('success'))
                            <div id="success-message" class="alert alert-danger bg-red-500 text-white">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form class="form-auth-small" method="POST" action="{{ route('save-account') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-name" class="control-label sr-only">Name</label>
                                    <input type="text" name="name" class="w-full h-16 text-3xl rounded-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" id="signin-email" value="{{ old('name') }}" required placeholder="Name">
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback float-left" role="alert">
                                        <p class="text-red-500">{{ $errors->first('name') }}</p>
                                    </span>
                                    @endif
                                </div>
                                <!-- Log on to codeastro.com for more projects! -->
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" class="w-full h-16 text-3xl rounded-lg" name="email" id="signin-email" value="{{ old('email') }}" placeholder="Email">
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback float-left" role="alert">
                                        <p class="text-red-500">{{ $errors->first('email') }}</p>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="signin-phone" class="control-label sr-only">Phone Number</label>
                                    <input type="text" class="w-full h-16 text-3xl rounded-lg" name="phone" id="signin-phone" value="{{ old('phone') }}" placeholder="Phone Number">
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback float-left" role="alert">
                                        <p class="text-red-500">{{ $errors->first('phone') }}</p>
                                    </span>
                                    @endif
                                </div><div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="w-full h-16 text-3xl rounded-lg" name="password" id="signin-password" value="{{ old('password') }}" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback float-left" role="alert">
                                        <p class="text-red-500">{{ $errors->first('password') }}</p>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Confirm Password</label>
                                    <input type="password" class="w-full h-16 text-3xl rounded-lg" name="password_confirmation" id="signin-password" value="{{ old('password') }}" placeholder="Confirm Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback float-left" role="alert">
                                        <p class="text-red-500">{{ $errors->first('password') }}</p>
                                    </span>
                                    @endif
                                </div>
                                
                                <button type="submit" class="w-full h-16 bg-green-500 text-white hover:bg-green-400">SIGN UP</button>
                                <div class="py-5 font-bold text-left ">Have account already? <a class="text-green-600" href="{{ route('login') }}">Sign In</a></div>
                                <!-- <div class="bottom">
                                    @if (Route::has('password.request'))
                                    <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('password.request') }}">Forgot password?</a></span>
                                    @endif
                                </div> -->
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <div class="my-4 bg-green-600 p-3 text-center w-1/2 m-auto">
                                <a href="{{ url('auth/google') }}" class="text-white hover:text-white block font-bold"><i class="fab fa-google float-right mx-4 text-4xl"></i>Sign In with Google</a>
                            </div>
                            <div class="my-4 bg-green-600 p-3 text-center w-1/2 m-auto">
                                <a href="{{ url('auth/facebook') }}" class="text-white hover:text-white block font-bold" ><i class="fab fa-facebook float-right mx-4 text-4xl"></i>Sign In with Facebook</a>
                            </div>
                            {{-- <div class="my-4 bg-green-600 p-3 text-center w-1/2 m-auto">
                                <a href="" class="text-white hover:text-white block font-bold"><i class="fab fa-apple float-right mx-4 text-5xl"></i>Sign In with Apple</a>
    
                            </div>                        --}}
                         </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>
<script type="text/javascript">
setTimeout(function() {
                document.getElementById('success-message').remove();
            }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

   $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
</script>

</html>




