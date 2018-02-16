<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="/kit/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/kit/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>{{$header}}</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"/>

    <!-- CSS Files -->
    <link href="/kit/assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/kit/assets/css/material-kit.css" rel="stylesheet"/>

</head>
@section('body_open')
<body class="landing-page">
@show
<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/"><i class="material-icons">home</i>Home</a>
        </div>

        <div class="collapse navbar-collapse" id="navigation-example">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/dashboard"><i class="material-icons">dashboard</i>Dashboard</a>
                </li>
                <li>
                    <a href="/login">

                        <i class="material-icons">fingerprint</i>
                        Login
                    </a>
                </li>
                <li>
                    <a href="/register">
                        <i class="material-icons">person_add</i>
                        Sign Up
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/" target="_blank"
                       class="btn btn-simple btn-white btn-just-icon">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/" target="_blank"
                       class="btn btn-simple btn-white btn-just-icon">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/" target="_blank"
                       class="btn btn-simple btn-white btn-just-icon">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="wrapper">
   @section('header_open')
    <div class="header header-filter"
         style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
@show
        @section('container')

        @show
    </div>
        @section('main_raised')

        @show

    <footer class="footer">
        <div class="container">
            <nav class="pull-left">
                <ul>

                    <li>
                        <a href="">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="m">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Licenses
                        </a>
                    </li>
                </ul>
            </nav>
           <!-- <div class="copyright pull-right">
                &copy; 2016, made with <i class="fa fa-heart heart"></i> by <a href=""
                                                                               target="_blank">copyright</a>
            </div>
            !-->
        </div>
    </footer>

</div>


</body>
<!--   Core JS Files   -->
<script src="/kit/assets/js/jquery.min.js" type="text/javascript"></script>
<script src="/kit/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/kit/assets/js/material.min.js"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="/kit/assets/js/nouislider.min.js" type="text/javascript"></script>

<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
<script src="/kit/assets/js/bootstrap-datepicker.js" type="text/javascript"></script>

<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
<script src="/kit/assets/js/material-kit.js" type="text/javascript"></script>

</html>
