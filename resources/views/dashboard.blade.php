@extends('layouts.dashboard')

@section('main')

    @foreach($posts as $post)
        <div class="card">
            <div class="col-md-12">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card-header " data-background-color="purple" style="padding: 1px 30px;">

                        <h4>  <a href="/post/{{$post->id}}/view"> {{str_limit($post->title,100)}} </a></h4>

                    </div>
                </div>
</div>
                <div class="card-content">

                    <div class="col-md-12">
                        <div class="col-md-2">
                            <img class="img" style="width: 150px;height: 150px;"
                                 src="/posts/{{$post->image??'post.jpg'}}">
                        </div>
                        <div class="col-md-10">
                            <h4>{!! str_limit(strip_tags($post->content),500) !!}<a href="/post/{{$post->id}}/view">Read more...</a></h4>
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
                            <a href="/post/{{$post->id}}/view">Read more...</a>
                        </div>

                    </div>

                </div>
            </div>

    @endforeach

@endsection
