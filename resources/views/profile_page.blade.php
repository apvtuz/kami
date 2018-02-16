@extends('layouts.home')
@section('body_open')
    <body class="profile-page">
    @endsection
    @section('header_open')
        <div class="header header-filter" style="background-image: url('../assets/img/examples/city.jpg');">
         @endsection
@section('main_raised')
    <div class="main main-raised">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="profile">
                        <div class="avatar">
                            <img src="/images/avatars/{{$user->photo??'photo.jpg'}}" alt="Circle Image" class="img-circle img-responsive img-raised">
                        </div>
                        <div class="name">
                            <h3 class="title">{{$user->name}} {{$user->lname}}</h3>
                            <h6></h6>
                        </div>
                    </div>
                </div>
                <div class="description text-center">
                    <p>{{$user->about_me}}</p>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="profile-tabs">
                            <div class="nav-align-center">
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="active">
                                        <a href="#studio" role="tab" data-toggle="tab">
                                            <i class="material-icons">camera</i>
                                            Studio
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#work" role="tab" data-toggle="tab">
                                            <i class="material-icons">palette</i>
                                            Work
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#shows" role="tab" data-toggle="tab">
                                            <i class="material-icons">favorite</i>
                                            Favorite
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content gallery">
                                    <div class="tab-pane active" id="studio">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="../assets/img/examples/chris1.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris0.jpg" class="img-rounded" />
                                            </div>
                                            <div class="col-md-6">
                                                <img src="../assets/img/examples/chris3.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-center" id="work">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                                            </div>
                                            <div class="col-md-6">
                                                <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris8.jpg" class="img-rounded" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-center" id="shows">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="../assets/img/examples/chris4.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris6.jpg" class="img-rounded" />
                                            </div>
                                            <div class="col-md-6">
                                                <img src="../assets/img/examples/chris7.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris5.jpg" class="img-rounded" />
                                                <img src="../assets/img/examples/chris9.jpg" class="img-rounded" />
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- End Profile Tabs -->
                    </div>
                </div>

            </div>
        </div>
    </div>

        @endsection