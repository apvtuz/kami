@extends('layouts.home')
@section('body_open')
    <body class="signup-page">
    @endsection
    @section('header_open')
        <div class="header header-filter"
         style="background-image: url('/kit/assets/img/city.jpg'); background-size: cover; background-position: top center;">
    @endsection
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                <div class="card card-signup">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="header header-primary text-center">
                            <h4>Sign In</h4>
                            <div class="social-line">
                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                    <i class="fa fa-facebook-square"></i>
                                </a>
                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#pablo" class="btn btn-simple btn-just-icon">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                        <p class="text-divider">Or Be Classical</p>
                        <div class="content">
                            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<span class="input-group-addon">
							<i class="material-icons">email</i>
                        </span>
                                <input type="text" name="email" class="form-control" placeholder="Email...">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
						        <span class="input-group-addon">
							        <i class="material-icons">lock_outline</i>
						        </span>
                                <input type="password" name="password" placeholder="Password..." class="form-control"/>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                    Remember Me

                                </label>
                            </div>
                            <div class="footer text-center">
                                <button class="btn btn-simple btn-primary btn-lg">Log in</button>
                            </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

