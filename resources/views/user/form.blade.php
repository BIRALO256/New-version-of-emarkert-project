@extends('layouts.master')
@section('top')
{{-- linking the font awesome css to use icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style type="text/css">
    .row-centered
    {
        text-align: center;
    }
    .col-centered
    {
        display: inline-block;
        float: none;
        text-align: left;
        margin-right: -4px;
    }
</style>
@vite('resources/css/app.css')

@stop
@section('content')
<!-- Log on to codeastro.com for more projects! -->
<div class="box box-success">
    <div class="box-header">
        <a href="{{ route('user.index') }}"><i class="fas fa-arrow-left px-5 text-3xl"></i></a><h3 class="box-title">Add New User</h3>
    </div>
    <div class="box-body">
        <div class="row row-centered">
            <div class="col-md-8 col-centered">
                <form class="form-auth-small" method="POST" action="{{ route('add_user') }}">
                    @csrf

                    {{-- PRINTING SUCCESS MESSAGE --}}
                    @if (session('success'))
                    <div id="success-message" class="alert alert-success bg-green-500">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="signup-name" class="control-label sr-only">Name</label>
                        <input type="text" class="w-full h-16 text-2xl rounded-lg"{{ $errors->has('name') ? ' is-invalid' : '' }}" id="signup-email"name="name" value="{{ old('name') }}" autofocus placeholder="Name">
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-red-500">{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="signup-email" class="control-label sr-only">Email</label>
                        <input type="email" class="w-full h-16 text-2xl rounded-lg"{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-red-500">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="signup-phone" class="control-label sr-only">Phone Number</label>
                        <input type="text" class="w-full h-16 text-2xl rounded-lg"{{ $errors->has('email') ? ' is-invalid' : '' }}" name="phone" value="{{ old('email') }}" placeholder="Phone Number">
                        @if ($errors->has('phone'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-red-500">{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="signup-password" class="control-label sr-only">Password</label>
                        <input type="password" class="w-full h-16 text-2xl rounded-lg" {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password">
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-red-500">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="signup-password" class="control-label sr-only">Confirm Password</label>
                        <input id="password-confirm" type="password" class="w-full h-16 text-2xl rounded-lg"" placeholder="Confirm Password" name="password_confirmation">
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-red-500">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class=" w-full h-16 text-2xl rounded-lg" name="role">
                            <option value="">Assign a permission to user</option>
                           @foreach ($roles as $role )
                           <option value="{{ $role->name }}">{{ $role->name }}</option>
                               
                           @endforeach
                          </select>

                          @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-red-500">{{ $errors->first('role') }}</strong>
                        </span>
                        @endif

                    </div>
                    <br>
                    <button type="submit" class="bg-green-600 hover:bg-green-500 w-full text-white h-14">REGISTER</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
     setTimeout(function() {
                document.getElementById('success-message').remove();
            }, 5000); // Remove the success message after 5 seconds (5000 milliseconds)

</script>
@stop