@extends('layouts.dashboard')
<style>
    [class*=col-] {
        position: relative
    }

    .row-conformity .to-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0
    }

    .row-centered {
        text-align: center
    }

    .row-centered [class*=col-] {
        display: inline-block;
        float: none;
        text-align: left;
        margin-right: -4px;
        vertical-align: top
    }
</style>
@section('main')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title">{{$post->title}}</h4>
                    <p class="category">Common information</p>
                </div>
                <div class="card-content">
                    <div class="col_md-12">
                        <div class="col-md-3">
                            <img class="img" class="img-responsive"
                                 src="/posts/{{$post->image??'post.jpg'}}">
                        </div>
                        <div class="col-md-9">
                            <h4>{!! $post->content !!}</h4>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="/profile_page/{{$user->id}}">
                        <img class="img" src="/images/avatars/{{$user->photo??'photo.jpg'}}"/>
                    </a>
                </div>
                <div class="content">

                    <h4 class="card-title">{{$user->name}} {{$user->lname}}</h4>
                    <p class="card-content">
                        {{str_limit($user->about_me,150)}}
                    </p>
                    <a href="/profile_page/{{$user->id}}" class="btn btn-primary btn-round">View profile
                        <div class="ripple-container"></div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">date_range</i>
                </div>
                <div class="card-content">
                    <p class="category">Created at</p>
                    <h3 class="title">{{$post->created_at->format('Y-m-d')}}
                        <small>{{$post->created_at->format('H:i')}}</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">

                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="card-content">
                    <p class="category">Takes</p>
                    <h3 class="title"> {{$post->takes}} </h3>
                </div>
                <div class="card-footer">
                    <div class="stats"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="material-icons">date_range</i>
                </div>
                <div class="card-content">
                    <p class="category">Interval</p>
                    <h3 class="title">{{$post->interval}}
                        <small></small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">

                    </div>
                </div>
            </div>
        </div>

        @if ($post->category)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="fa fa-bars"></i>
                    </div>
                    <div class="card-content">
                        <p class="category">Categoy</p>
                        <h3 class="title"> {{$post->category ? App\Category::find($post->category)->name : 'Not selected'}} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"></div>
                    </div>
                </div>
            </div>
        @endif

        @if ($post->age_from) @foreach ($post->age_from as  $key => $age_from)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">face</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Age for participating</p>
                        <h3 class="title">
                            <small>From</small>
                            {{$post->age_from[0]>0 ?$post->age_from[$key] : 'any'}}
                            <small>To</small>
                            {{$post->age_to[0]>0 ?$post->age_to[$key] : 'any'}}
                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
        @if ($post->accent)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">explore</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Accent </p>
                        <h3 class="title">{{$post->accent>0 ? App\Accent::find($post->accent)->name:'Not selected'}}

                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"></div>
                    </div>
                </div>
            </div>
        @endif
        @if ($post->language)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">explore</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Language </p>
                        <h3 class="title">{{$post->language>20 ? App\Language::find($post->language)->name:'Not selected'}}

                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        @if ($post->hearing_disorder or $post->sight_disorde)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">accessible</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Applicability
                        <h3 class="title">
                            @if ($post->hearing_disorder)
                                <small>Hearing disorder</small>
                            {{$post->hearing_disorder>0 ?'Applicable' : 'Not Applicable'}}<br>
                             @endif
                                @if ($post->sight_disorde)
                                <small>Sight disorder</small>
                            {{$post->sight_disorder>0 ?'Applicable' : 'Not Applicable'}}@endif

                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">


                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($post->voices)
            <div class="col-lg-8 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">accessible</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Familiarity with synthetic voices:
                            how often do you use GPS speech / Siri / screenreaders</p>
                        <h3 class="title">{{config('constants.voices')[$post->voices]}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">

                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($post->renumeration)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">money</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Renumeration </p>
                        <h3 class="title"><br>{{$post->renumeration or 'Not provided'}}

                        </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats"></div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    <div class="row">

        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="card-content">
                    <p class="category">Left free places for participating</p>
                    <h3 class="title">{{$post->number_of_participants>0?$post->number_of_participants-App\Record::where('post_id',$post->id)->where('status',1)->count():'Unlimited'}}</h3>

                </div>
                <div class="card-content">

                    @if(
                    $post->user_id!=Auth::id() and
                    App\Record::where('post_id',$post->id)->where('user_id',Auth::id())->count()==0 and
                    ($post->number_of_participants==0 or
                    $post->number_of_participants>App\Record::where('post_id',$post->id)->where('status',1)->count())
                    )

                        <form action="/post/record" method="POST" style="display: inline-block;">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" class="form-control datetimepicker"
                                       value="{{date('Y-m-d H:i')}}"
                                       name="new_slot">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <button class="btn btn-round btn-primary" onclick="return confirm('Please confirm!')">
                                    Participate
                                </button>
                            </div>
                        </form>
                    @endif


                </div>
            </div>
        </div>
<div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="blue">
                    <i class="fa fa-edit"></i>
                </div>
                <div class="card-content">
                    <p class="category">Left free places for participating</p>
                    <h3 class="title">{{$post->number_of_participants>0?$post->number_of_participants-App\Record::where('post_id',$post->id)->where('status',1)->count():'Unlimited'}}</h3>

                </div>
                <div class="card-content">

                    @if(
                    $post->user_id!=Auth::id() and
                    App\Record::where('post_id',$post->id)->where('user_id',Auth::id())->count()==0 and
                    ($post->number_of_participants==0 or
                    $post->number_of_participants>App\Record::where('post_id',$post->id)->where('status',1)->count())
                    )

                        <form action="/post/record" method="POST" style="display: inline-block;">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <input type="text" class="form-control datetimepicker"
                                       value="{{date('Y-m-d H:i')}}"
                                       name="new_slot">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <button class="btn btn-round btn-primary" onclick="return confirm('Please confirm!')">
                                    Participate
                                </button>
                            </div>
                        </form>
                    @endif


                </div>
            </div>
        </div>

    </div>
    <div class="row row-centered">


        <div class="col-lg-2">
            <form action="/post/favorite" method="POST" style="display: inline-block;">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{$post->id}}">
                <button class="btn btn-warning btn-round">
                    <i class="material-icons">favorite</i>
                    {{!empty(Auth::user()->favorites) && in_array($post->id,Auth::user()->favorites)?'Remove from favorites':'Add to favorites'}}
                </button>
            </form>
            @if ($post->file)
                <a href="/docs/{{$post->file}}" class="btn  btn-success" download>Download consent form</a>
            @endif
        </div>
    </div>


@endsection
