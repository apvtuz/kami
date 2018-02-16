<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="_token" content="<?php echo csrf_token(); ?>">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>{{config('app.name', '')}} - {{$header}}</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('assets/css/material-dashboard.css?v=1.2.0')}}" rel="stylesheet"/>

<!--  <link href="{{asset('assets/css/datapicker.css')}}" rel="stylesheet"/>!-->
    <!--     Fonts and icons     -->

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet'
          type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <link href=" https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <link href="/css/pickmeup.css" rel="stylesheet"/>
    !-->
    <!--<link href="/kit/assets/css/material-kit.css" rel="stylesheet"/>!-->
</head>
<style>
    html {
        overflow: hidden;

    }

    .pickmeup {
        background: #9c27b0;
    }
</style>
<body>
<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="/assets/img/sidebar-1.jpg">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

    Tip 2: you can also add an image using data-image tag
-->
        <div class="logo">
            <a href="/" class="simple-text">
                {{ Auth::user()->name }}
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="{{ Request::is('profile') ? 'active' : '' }}">
                    <a href="/profile">
                        <i class="material-icons">person</i>
                        <p>User Profile</p>
                    </a>
                </li>
                @if(!Auth::user()->author)
                    <li class="{{ Request::is('preference') ? 'active' : '' }}">
                        <a href="/preference">
                            <i class="material-icons">settings</i>
                            <p>Filter preference</p>
                        </a>
                    </li>
                @endif
                <li class="{{ Request::is('favorites') ? 'act   ive' : '' }}">
                    <a href="/favorites">
                        <i class="material-icons">favorite_border</i>
                        Favorites
                    </a>
                </li>
                @if(Auth::user()->author)
                    <li class="{{ Request::is('post*') ? 'active' : '' }}">
                        <a href="/posts">
                            <i class="material-icons">content_paste</i>
                            <p>Posts</p>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="/projects">
                        <i class="material-icons">notes</i>
                        Projects
                    </a>
                </li>
                <li class="active-pro">
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">directions_run</i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <nav class="navbar navbar-transparent navbar-absolute">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> {{$header}} </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="/dashboard">
                                <i class="material-icons">dashboard</i>
                                <p class="hidden-lg hidden-md">Dashboard</p>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">notifications</i>
                                @if ($notifications->count()>0)
                                    <span class="notification">{{$notifications->count()}}</span>
                                @endif
                                <p class="hidden-lg hidden-md">Notifications</p>
                            </a>

                            @if ($notifications->count()>0)

                                <ul class="dropdown-menu">
                                    @foreach ($notifications as $notification)

                                        <li>
                                            <a href="/post/{{$notification->post_id}}/people">User {{$users->find($notification->user_id)->name}} {{$users->find($notification->user_id)->lname}} </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="material-icons">person</i>
                                <p class="hidden-lg hidden-md">Profile</p>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/profile">
                                        <i class="material-icons">person</i>
                                        User Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="/preference">
                                        <i class="material-icons">settings</i>
                                        Filter preference
                                    </a>
                                </li>
                                <li>
                                    <a href="/favorites">
                                        <i class="material-icons">favorite_border</i>
                                        Favorites
                                    </a>
                                </li>
                                @if(Auth::user()->author)
                                    <li>
                                        <a href="/posts">
                                            <i class="material-icons">content_paste</i>
                                            Posts
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="/projects">
                                        <i class="material-icons">notes</i>
                                        Projects
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons">directions_run</i>
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </li>

                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group  is-empty">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container-fluid">
                @section('main')


                @show
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>

                </p>
            </div>
        </footer>
    </div>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="{{asset('assets/js/material.min.js')}}" type="text/javascript"></script>
!
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="{{asset('assets/js/moment.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datetimepicker.js')}}"></script>
<!--  Dynamic Elements plugin -->
<script src="{{asset('assets/js/arrive.min.js')}}"></script>
<!--  PerfectScrollbar Library -->
<script src="{{asset('assets/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/bootstrap-notify.js')}}"></script>
<!--  Google Maps Plugin    -->
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="{{asset('assets/js/jasny-bootstrap.min.js')}}"></script>
<!-- Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="{{asset('assets/js/jquery.tagsinput.js')}}"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('assets/js/material-dashboard.js?v=1.2.1')}}"></script>

<script src="{{asset('js/pickmeup.min.js')}}"></script>
<!--<script src="{{asset('js/jquery.pickmeup.twitter-bootstrap.js')}}"></script>!-->
<!--<script src="{{asset('assets/js/demo.js')}}"></script>!-->
<script src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if ($('.date').length > 0) {
            pickmeup('.date').set_date({!! $post->conducted_at or null !!});
            // console.log(pickmeup('.date').get_date('Y-m-d'));

        }

    });

</script>

</html>




