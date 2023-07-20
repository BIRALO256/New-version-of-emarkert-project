<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Market Place | Reset password</title>
    {{-- linking the tailwind css using vite directive --}}
    @vite('resources/css/app.css')
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
  
    
  
                        <form action="{{ route('reset.password.post') }}" method="POST">
  
                            @csrf
  
                            <input type="hidden" name="token" value="{{ $token }}">
  
    
  
                            <div class="form-group row my-3">
  
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
  
                                <div class="col-md-6">
  
                                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
  
                                    @if ($errors->has('email'))
  
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
  
                                    @endif
  
                                </div>
  
                            </div>
  
    
  
                            <div class="form-group row my-3">
  
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
  
                                <div class="col-md-6">
  
                                    <input type="password" id="password" class="form-control" name="password" required autofocus>
  
                                    @if ($errors->has('password'))
  
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
  
                                    @endif
  
                                </div>
  
                            </div>
  
    
  
                            <div class="form-group row my-3">
  
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
  
                                <div class="col-md-6">
  
                                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autofocus>
  
                                    @if ($errors->has('password_confirmation'))
  
                                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
  
                                    @endif
  
                                </div>
  
                            </div>
  
    
  
                            <div class="col-md-6 offset-md-4 my-3">
  
                                <button type="submit" class="btn btn-success">
  
                                    Reset Password
  
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