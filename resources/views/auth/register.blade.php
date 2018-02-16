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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="header header-primary text-center">
                            <h4>Sign Up</h4>
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

                            <div class="input-group{{ $errors->has('name') ? ' has-error' : '' }}">
										<span class="input-group-addon">
											<i class="material-icons">face</i>
										</span>
                                <input type="text" name="name" class="form-control" placeholder="First Name...">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

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
                            <div class="input-group">
						<span class="input-group-addon">
							<i class="material-icons">lock_outline</i>
						</span>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password..."
                                       class="form-control"/>

                            </div>


                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="author">
                                    I want to be researches author
                                </label>
                            </div>
                            <div class="footer text-center">
                                <button class="btn btn-simple btn-primary btn-lg">Get Started</button>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    <!--
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
            </div>
        </div>



        <div class="form-group">
            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>
        <div class="form-group">
            <label for="author" class="col-md-4 control-label">I want to be researches author</label>

            <div class="col-md-1">
                <input id="author" type="checkbox" class="form-control" name="author">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Register
                </button>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
</div>
!-->
@endsection
