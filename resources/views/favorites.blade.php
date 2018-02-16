@extends('layouts.dashboard')

@section('main')

<div class="col-md-12">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">List of projects</h4>
            <p class="category">marked as favorite</p>
        </div>
        <div class="card-content table-responsive">
            @if ($posts)
                <table class="table ">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created at</th>
                        <th>Conducted from</th>
                        <th>Conducted to</th>
                        <th>Status</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{!! $post->title !!}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->conducted_from}}</td>
                            <td>{{$post->conducted_to}}</td>
                            <td>{{$post->conducted_from<date('Y-m-d H:i:s') && $post->conducted_to>date('Y-m-d H:i:s') ?'Active':'Expired'}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <h3>No favorites</h3>
            @endif
        </div>
    </div>
<hr>

    </div>
@endsection
