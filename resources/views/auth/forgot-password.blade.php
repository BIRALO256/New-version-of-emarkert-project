<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Market Place | Forgot password</title>
     {{-- linking the tailwind css using vite --}}
     @vite('resources/css/app.css')
     {{-- linking the online bootstrap css --}}
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
 
</head>
<body>
    <main class="login-form mt-20">

        <div class="cotainer">
      
            <div class="row justify-content-center">
      
                <div class="col-md-8">
      
                    <div class="card">
      
                        <div class="card-header">Reset Password</div>
      
                        <div class="card-body">
      
                          @if (Session::has('message'))
      
                               <div class="alert alert-success" role="alert">
      
                                  {{ Session::get('message') }}
      
                              </div>
      
                          @endif
                            <form action="{{ route('forget.password.post') }}" method="POST">
      
                                @csrf
      
                                <div class="form-group row">
      
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
      
                                    <div class="col-md-6">
      
                                        <input type="text" id="email_address" class="form-control" name="email" required autofocus>
      
                                        @if ($errors->has('email'))
      
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
      
                                        @endif
      
                                    </div>
      
                                </div>
      
                                <div class="col-md-6 offset-md-4 my-4">
      
                                    <button type="submit" class="btn btn-success">
                                        Send Password Reset Link
                                    </button>
      
                                </div>
      
                            </form>
      
                              
      
                        </div>
      
                    </div>
      
                </div>
      
            </div>
      
        </div>
      
      </main>
</body>
</html>

