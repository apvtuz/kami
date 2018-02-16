@extends('layouts.dashboard')

@section('main')

<div class="col-md-12">

    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">List of projects</h4>
            <p class="category">I participate in</p>
        </div>
        <div class="card-content table-responsive">
            @if ($slots)
                <table id="datatable" class="table " cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Conducted from</th>
                        <th>Conducted to</th>
                        <th>Status</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($slots as $slot)
                        <tr>
                            <td>{!! Post::find($slot->post_id)->title !!}</td>
                            <td>{{$slot->start}}</td>
                            <td>{{$slot->finish}}</td>
                            <td>{{config('constants.status')[App\Record::where('post_id',$post->id)->where('user_id',Auth::id())->first()->status]}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <h3>No projects</h3>
            @endif
        </div>
    </div>

    </div>
@endsection
