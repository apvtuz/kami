@extends('layouts.dashboard')

@section('main')

    @if (!empty(session('success')))
        <div class="alert alert-success">
            <span>
                <b> Success - </b> {{session('success')}}</span>
        </div>
    @endif
    <div class="col-md-12">
        <form enctype="multipart/form-data" method="POST" action="{{$action}}">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-text" data-background-color="purple">
                    <h4 class="card-title">Project information</h4>
                </div>
                <div class="card-content">
                    <div class="row">

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label>
                                Title
                                <span class="text-danger">*
                                    @if ($errors->has('title'))
                                        <strong>{{ $errors->first('title') }}</strong>
                                    @endif
                                </span>
                            </label>
                            <input type="text" name="title" value="{{$post->title}}" class="form-control">

                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label>Content
                                <span class="text-danger">*
                                    @if ($errors->has('content'))<strong>{{ $errors->first('content') }}</strong>@endif
                    </span></label>
                            <textarea id="summernote" name="content">{{$post->content}}</textarea>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Experiment information</label>
                                    <input type="text" name="exp_info" value="{{$post->exp_info}}" class="form-control">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">today</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Conducted at</h4>
                            <div class="date" id="date"></div>
                            <input type="hidden" name="conducted_at" id="conducted_at">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>
                </div>
            <!--   <div class="col-md-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">today</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Conducted from</h4>
                            <div class="form-group">
                                <label class="label-control">Select date and time</label>
                                <input type="text" class="form-control datetimepicker"
                                       value="{{$post->conducted_from or date('Y-m-d H:i')}}"
                                       name="conducted_from">
                                <span class="material-input"></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">today</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Conducted to</h4>
                            <div class="form-group">
                                <label class="label-control">Select date and time</label>
                                <input type="text" class="form-control datetimepicker"
                                       value="{{$post->conducted_to or date('Y-m-d H:i')}}" name="conducted_to">
                                <span class="material-input"></span></div>
                        </div>
                    </div>
                </div>!-->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">av_timer</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Select time</h4>
                            <div class="form-group">
                                <label class="label-control">that takes experiment</label>
                                <select name="takes" class="selectpicker" data-style="select-with-transition">
                                    <option value="10 min">10 min</option>
                                    <option value="20 min" {{$post->takes=='20 min'?'selected':''}}>20 min</option>
                                    <option value="30 min" {{$post->takes=='30 min'?'selected':''}}>30 min</option>
                                    <option value="1 h" {{$post->takes=='1 h'?'selected':''}}>1 h</option>
                                    <option value="1.5 h" {{$post->takes=='1.5 h'?'selected':''}}>1.5 h</option>
                                </select>
                                <span class="material-input"></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">av_timer</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Interval (in minutes)</h4>
                            <div class="form-group">
                                <label class="label-control">between experiments</label>
                                <input type="number" min=1 max=100 name="interval" value="{{$post->interval}}"
                                       class="form-control">
                                <span class="material-input"></span></div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-3 col-sm-3">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">image</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Select project image</h4>

                            <div class="fileinput fileinput-new text-center" data-provides="fildata-dismisseinput">
                                <div class="fileinput-new thumbnail">
                                    <img src="/posts/{{$post->image??'post.jpg'}}" alt="project image">
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                <div>
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="image">
                                                    <div class="ripple-container"></div></span>
                                    <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                       data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-5">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">accessible</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Mark if is necessary</h4>
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" name="hearing_disorder"
                                           @if($post->hearing_disorder) checked @endif >
                                    <span class="toggle"></span> Hearing disorder
                                </label>
                            </div>
                            <div class="togglebutton">
                                <label>
                                    <input type="checkbox" name="sight_disorder"
                                           @if($post->sight_disorder) checked @endif >
                                    <span class="toggle"></span> Sight disorder
                                </label>
                            </div>
                            <h4 class="card-title"> Familiarity with synthetic voices:<br>
                                how often do you use GPS speech / Siri / screenreaders</h4>

                            <div class="radio">

                                <label>
                                    <input type="radio" name="voices" value="1" @if($post->voices==1) checked @endif>
                                    Never
                                </label></div>
                            <div class="radio">
                                <label><input type="radio" name="voices" value="2"
                                              @if($post->voices==2) checked @endif>Rarely</label></div>
                            <div class="radio">
                                <label><input type="radio" name="voices" value="3"
                                              @if($post->voices==3) checked @endif>Sometimes</label></div>
                            <div class="radio">
                                <label><input type="radio" name="voices" value="4"
                                              @if($post->voices==4) checked @endif>Often</label></div>
                            <div class="radio">
                                <label><input type="radio" name="voices" value="5" @if($post->voices==5) checked @endif>Very
                                    often</label>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">reorder</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Category</h4>
                            <div class="form-group label-floating">

                                <select class="selectpicker" data-style="select-with-transition" name="category">
                                    <option value="0">Not in use</option>
                                    @foreach ($categories    as $category)
                                        <option {{$post->category==$category->id?'selected':''}}  value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <h4 class="card-title">Number of participants (0 - unlimited)</h4>

                                <input class="form-control" type="number" min="0" max=99
                                       value="{{$post->number_of_participants or 0}}"
                                       name="number_of_participants"/>
                            </div>
                            <div class="form-group label-floating">
                                <h4 class="card-title">Renumeration</h4>

                                <input class="form-control" type="text" min="0" max=99
                                       value="{{$post->renumeration or ''}}"
                                       name="renumeration"/>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <hr>
            <div class="row" id="age_cont">
                <div class="col-md-3">
                    <div class="card card-profile">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            Add age range
                        </div>
                        <div class="card-content">
                            <div class="icon icon-purple">
                                <a id="add_age" href=""> <i class="material-icons"
                                                            style="font-size: 80px;color: #e91e63;font-weight: 800;">add</i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($post->age_from as $key => $age_from)
                    <div class="col-md-3" id="age{{$key}}">
                        <div class="card">
                            <div class="card-header card-header-icon" data-background-color="purple">
                                <i class="material-icons">face</i>
                                <button type="button" aria-hidden="true" class="close" onclick="close_age({{$key}})">
                                    <i class="material-icons">close</i>
                                </button>
                            </div>
                            <div class="card-content">
                                <h4 class="card-title">Age From (0 - no matter)</h4>
                                <div class="form-group label-floating">
                                    <label></label>
                                    <input class="form-control" type="number" min="0" max=99
                                           value="{{$post->age_from[$key] or ''}}"
                                           name="age_from[]"/>
                                </div>
                                <div class="form-group label-floating">
                                    <h4 class="card-title">Age To (0 - no matter)</h4>
                                    <input class="form-control" type="number" min="0" max=99
                                           value="{{$post->age_to[$key] or ''}}"
                                           name="age_to[]"/>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">explore</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Accent</h4>
                            <div class="form-group label-floating">
                                <label></label>
                                <select class="selectpicker" data-style="select-with-transition" name="accent">
                                    <option value="0">Not in use</option>
                                    @foreach ($accents as $accent)
                                        <option {{$accent->id==$post->accent ? ' selected' : '' }} value="{{$accent->id}}">
                                            {{$accent->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group label-floating">
                                <h4 class="card-title">Language</h4>
                                <select class="selectpicker" data-style="select-with-transition" name="language">
                                    <option value="0">Not in use</option>
                                    @foreach ($languages as $language)
                                        <option {{$language->id==$post->language ? ' selected' : '' }} value="{{$language->id}}">
                                            {{$language->name}}
                                        </option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-icon" data-background-color="purple">
                            <i class="material-icons">note</i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Append document</h4>
                            <div class="form-group label-floating">
                                <label></label>
                                <div class="fileinput fileinput-new text-center" data-provides="fildata-dismisseinput">

                                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                    <div>
                                                    <span class="btn btn-rose btn-round btn-file">
                                                        <span class="fileinput-new">Select file</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="file">
                                                    <div class="ripple-container"></div></span>
                                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                           data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <hr>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    @if($post->id)
                        <a href="/post/{{$post->id}}/publish" class="btn btn-{{$post->color}}">
                            <i class="material-icons">{{$post->icon}}</i> {{$post->btn_text}}
                        </a>
                    @endif
                    <a href="/posts" class="btn btn-warning"><i class="fa fa-ban"></i> Cancel </a>

                </div>


            </div>

        </form>
    </div>
@endsection
