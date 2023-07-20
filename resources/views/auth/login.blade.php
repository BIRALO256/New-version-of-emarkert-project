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
                                <p class="lead">Login to your account</p>
                                {{-- printing the success message --}}
                                @if (session('success'))
                                <div id="success-message" class="alert alert-success bg-green-500">
                                    {{ session('success') }}
                                </div>
                                @endif
                                
                            </div>
                            <form class="form-auth-small" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" name="email" class="w-full h-16 text-3xl rounded-lg {{ $errors->has('email') ? ' is-invalid' : '' }} text-xl h-16" id="signin-email" value="{{ old('email') }}" required placeholder="Email">
                                    @if ($errors->has('email'))
                                    <br>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <strong><i class="icon fa fa-ban"></i> Alert!</strong> &nbsp; {{ $errors->first('email') }}
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" class="h-16 text-xl w-full rounded-lg" name="password" id="signin-password" value="{{ old('password') }}" placeholder="Password">
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <button type="submit" class="w-full h-16 bg-green-500 text-white hover:bg-green-400">LOGIN</button>
                                <div class="bottom">
                                    {{-- @if (Route::has('password.request')) --}}
                                    <span class="helper-text"><i class="fa fa-lock"></i> <a href="{{ route('forget.password.get') }}">Forgot password?</a></span>
                                    {{-- @endif --}}
                                </div> 
                                <div class="py-5 font-bold text-left ">Have no account? <a class="text-green-600" href="{{ route('create-account') }}">Create Account</a></div>
                                
                            </form>
                        </div>
                    </div>
                    <div class="right ">
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




