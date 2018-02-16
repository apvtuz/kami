@extends('layouts.dashboard')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <h4 class="title" id="post_id" data-id="{{$post->id}}">{{$post->title}}</h4>
                    <p class="category">Select date</p>
                </div>
                <div class="card-content">
                    <div class="col_md-12">
                        @if (!empty($post->conducted_at_array))
                            <select class="selectpicker" data-style="select-with-transition" id="slots_date">
                                <option>Select date</option>
                                @foreach ($post->conducted_at_array as $date)
                                    <option value="{{$date}}">{{$date}}</option>
                                @endforeach
                            </select>
                        @else
                            <h3>No dates selected</h3>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row" id="slots_cont">

    </div>


@endsection
