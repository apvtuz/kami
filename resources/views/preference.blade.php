@extends('layouts.dashboard')

@section('main')
    @if (!empty(session('success')))
        <div class="alert alert-success col-md-8">
            <span>
                <b> Success - </b> {{session('success')}}</span>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header" data-background-color="purple">
                    <h4 class="title">Edit Preference</h4>
                    <p class="category">Complete your filter preference</p>
                </div>
                <div class="card-content">
                    <form enctype="multipart/form-data" method="POST" action="{{ url('/preference') }}">
                        {{ csrf_field() }}


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Place of birth</label>
                                    <select class="selectpicker" data-style="select-with-transition" name="place_of_birth" >
                                        @foreach ($countries as $country)
                                            <option {{ $country->id==Auth::user()->place_of_birth ? ' selected' : '' }} value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Language</label>
                                    <select  class="selectpicker" data-style="select-with-transition"  name="language[]" multiple>
                                        @foreach ($languages as $language)
                                            <option {{in_array($language->id,$user_languages) ? ' selected' : '' }} value="{{$language->id}}">{{$language->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group label-floating">
                                    <label>Category</label>
                                    <select  class="selectpicker" data-style="select-with-transition"  name="category[]" multiple>
                                        @foreach ($categories as $category)
                                            <option {{in_array($category->id,$user_categories) ? ' selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label>Accent</label>
                                    <select  class="selectpicker" data-style="select-with-transition"  name="accent[]" multiple>
                                        @foreach ($accents as $accent)
                                            <option {{in_array($accent->id,$user_accents) ? ' selected' : '' }} value="{{$accent->id}}">{{$accent->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="hearing_disorder"
                                                   @if(Auth::user()->hearing_disorder) checked @endif>

                                            Hearing disorder
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group label-floating">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sight_disorder"
                                                   @if(Auth::user()->sight_disorder) checked @endif>

                                            Sight disorder
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Familiarity with synthetic voices (how often do you use - - GPS
                                speech / Siri / screen readers)</label>
                            <div class="radio">
                                <label><input type="radio" name="voices" value="0"
                                              @if(Auth::user()->voices==0) checked @endif>Preference is not in
                                    use</label>
                                <label><input type="radio" name="voices" value="1"
                                              @if(Auth::user()->voices==1) checked @endif>Never</label>
                                <label><input type="radio" name="voices" value="2"
                                              @if(Auth::user()->voices==2) checked @endif>Rarely</label>
                                <label><input type="radio" name="voices" value="3"
                                              @if(Auth::user()->voices==3) checked @endif>Sometimes</label>
                                <label><input type="radio" name="voices" value="4"
                                              @if(Auth::user()->voices==4) checked @endif>Often</label>
                                <label><input type="radio" name="voices" value="5"
                                              @if(Auth::user()->voices==5) checked @endif>Very
                                    Often</label>
                            </div>
                        </div>




                        <button type="submit" class="btn btn-primary pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-avatar">
                    <a href="#pablo">
                        <img class="img" src="/images/avatars/{{Auth::user()->photo??'photo.jpg'}}"/>
                    </a>
                </div>
                <div class="content">

                    <h4 class="card-title">{{Auth::user()->name}} {{Auth::user()->lname}}</h4>
                    <p class="card-content">
                        {{str_limit(Auth::user()->about_me,150)}}
                    </p>
                    <a href="/profile" class="btn btn-primary btn-round">Edit</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 0;
        }

        .select2-container--default .select2-selection--single {
            border: 0;
        }

        .select2-container--default.select2-container--open .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
        }
    </style>

@endsection
