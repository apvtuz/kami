@extends('layouts.dashboard')

@section('main')

<div class="col-md-12">
    <a href="/post/create" class="btn btn-primary"><i class="fa fa-plus"></i> Add post</a>
<hr>
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">List of my projects</h4>
            <p class="category"></p>
        </div>
        <div class="card-content table-responsive">
            @if ($posts->count()>0)
                <table id="datatable" class="table " cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created at</th>


                        <th></th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Created at</th>


                        <th></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{!! $post->title !!}</td>
                            <td>{{$post->created_at}}</td>


                            <td class="text-right">
                                @php
                                    if ($post->published==1) {$icon='visibility';$color='btn-success';$p='Published';}
                                    else {$icon='visibility_off';$color='btn-warning';$p='Unpublished. Click to publish';}
                                @endphp
                                <a href="/post/{{$post->id}}/publish" class="btn btn-xs {{$color}}" title="{{$p}}" >
                                    <i class="material-icons">{{$icon}}</i>
                                </a>
                                <a href="/post/{{$post->id}}/slots" class="btn btn-xs btn-primary" title="Time slots" >
                                    <i class="material-icons">av_timer</i>
                                </a>
                                <a href="/post/{{$post->id}}/people" class="btn btn-xs btn-info" title="Change " >
                                    <i class="material-icons">people</i>
                                </a>
                                <a href="/post/{{$post->id}}/edit" title="Edit" data-toggle="tooltip" class="btn btn-xs btn-primary" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                <form action="/post/delete" method="POST" style="display: inline-block;">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{$post->id}}">
                                    <button title="Delete" data-toggle="tooltip" class="btn btn-xs btn-danger btn-delete"  onclick="return confirm('Please confirm deleting!')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h3>No posts</h3>
            @endif
        </div>
    </div>

    </div>
@endsection
