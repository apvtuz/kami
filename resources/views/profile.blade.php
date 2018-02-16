@extends('layouts.dashboard')

@section('main')
    @if (!empty(session('success')))
        <div class="alert alert-success col-md-8">
            <span>
                <b> Success - </b> {{session('success')}}</span>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Edit Profile</h4>
                    <p class="category">Complete your profile</p>
                </div>
                <div class="card-content">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('/profile') }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Fist Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                           required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Last name</label>
                                    <input id="lname" type="text" class="form-control" name="lname"
                                           value="{{ $user->lname }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email address</label>

                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ $user->email }}" required>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group label-floating">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender" id="gender">
                                        <option value="1"{{ $user->gender==1 ? ' selected' : '' }}>Male</option>
                                        <option value="2"{{ $user->gender==2 ? ' selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="fileinput fileinput-new text-center" data-provides="fildata-dismisseinput">
                                 <label>Profile image</label><br>
                                <div class="fileinput-new thumbnail">
                                    <img src="/images/avatars/{{$user->photo??'photo.jpg'}}" alt="project image">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="photo">
                                                    <div class="ripple-container"></div></span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                       data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>How do you prefer to be contacted</label>
                                    <label><input type="checkbox" name="contact_mail"
                                                  @if($user->contact_mail) checked @endif>E-mail</label>
                                    <label><input type="checkbox" name="contact_phone"
                                                  @if($user->contact_phone) checked @endif>Phone</label>

                                </div>


                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Phone</label>

                                    <input type="text" class="form-control" name="phone"
                                           value="{{ $user->phone }}" >

                                </div>
                            </div>




                        </div>

                        @if ($user->author<1)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="author">
                                                I want to be researches author
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About Me</label>
                                    <div class="form-group label-floating">
                                        <textarea class="form-control" rows="5"
                                                  name="about_me">{{$user->about_me}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>


                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="/images/avatars/{{$user->photo??'photo.jpg'}}"/>
                    </a>
                </div>
                <div class="content">

                    <h4 class="card-title">{{$user->name}} {{$user->lname}}</h4>
                    <p class="card-content">
                        {{str_limit($user->about_me,150)}}
                    </p>

                </div>
            </div>
        </div>

        <style>
            .select2-container--default .select2-selection--multiple {
                border: 0;
            }

            .select2-container--default .select2-selection--single {
                border: 0;
            }

            .select2-container--default.select2-container--open .select2-selection--single {
                background-color: #fff;
                border: 1px solid #aaa;
                border-radius: 4px;
            }
        </style>
    </div>
@endsection
