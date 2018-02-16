@extends('layouts.dashboard')

@section('main')

    @foreach($posts as $post)
        <div class="card">
            <div class="card-header " data-background-color="purple">
                <h4>{{$post->title}}</h4>

            </div>
            <div class="card-content">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <img class="img" style="width: 150px;height: 150px;" src="/posts/{{$post->image??'post.jpg'}}">
                    </div>
                    <div class="col-md-10">
                        <h4>{!! str_limit($post->content,250) !!}</h4>
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <div class="col-md-2">
                </div>
                <div class="col-md-10 stats">
                        <div class="col-md-3">
                            <i class="material-icons">date_range</i> {{$post->created_at}}
                        </div>
                        <div class="col-md-3">
                            <i class="material-icons">person</i> {{App\User::find($post->user_id)->name}} {{App\User::find($post->user_id)->lname}}
                        </div>
                        <div class="col-md-3">
                            <i class="material-icons">edit</i> Left free places:
                            {{$post->number_of_participants>0?$post->number_of_participants-App\Record::where('post_id',$post->id)->where('status',1)->count():'Unlimited'}}
                        </div>
<div class="col-md-3 text-right">
    <a href="">Read more...</a>
</div>

                </div>

            </div>
        </div>
        <div class="card card-testimonial" style="min-height: 170px;">
            <div class="card-content">
                <div class="card-avatar" style="margin: -50px 0 0 -25px;">
                    <a href="/profile_page/{{$post->user_id}}">
                        <img class="img" src="/images/avatars/{{App\User::find($post->user_id)->photo??'photo.jpg'}}">
                        <div class="ripple-container">{{$post->title}}

                        </div>
                        <div style="position: absolute;width: 130px;">
                            <b>{{App\User::find($post->user_id)->name}} <br>
                                {{App\User::find($post->user_id)->lname}}<br>
                                <br> <i>{{$post->created_at}}</i></b>

                        </div>
                    </a>
                </div>

            </div>

            <h5 class="card-description" style="    margin-left: 100px;">
                {!! $post->content !!}
            </h5>
            @if (App\Record::where('post_id',$post->id)->count()>0)
                <h5>Participates</h5>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <th>Name</th>
                            <th>Status</th>

                            @foreach (App\Record::where('post_id',$post->id)->get() as $record)
                                <tr>
                                    <td>{{App\User::find($record->user_id)->name}} {{App\User::find($record->user_id)->lname}}</td>
                                    <td>{{config('constants.status')[$record->status]}}</td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif
            <hr>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <table class="table table-bordered">
                        <tr>

                            <td>Total
                                places: {{$post->number_of_participants>0?$post->number_of_participants:'Unlimited'}}</td>
                            <td>Left free
                                places: {{$post->number_of_participants>0?$post->number_of_participants-App\Record::where('post_id',$post->id)->where('status',1)->count():'Unlimited'}}</td>

                        </tr>

                    </table>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                @if($post->number_of_participants==0 or $post->number_of_participants>App\Record::where('post_id',$post->id)->where('status',1)->count())

                    <form action="/post/record" method="POST" style="display: inline-block;">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <button class="btn btn-xs btn-primary" onclick="return confirm('Please confirm!')">
                            Participate
                        </button>
                    </form>
                @endif

                <form action="/post/favorite" method="POST" style="display: inline-block;">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$post->id}}">
                    <button class="btn btn-xs btn-warning">
                        {{!empty(Auth::user()->favorites) && in_array($post->id,Auth::user()->favorites)?'Remove from favorites':'Add to favorites'}}
                    </button>
                </form>
                @if ($post->file)
                    <a href="/docs/{{$post->file}}" class="btn btn-xs btn-success" download>Download consent form</a>
                @endif
            </div>

        </div>
    @endforeach

@endsection
