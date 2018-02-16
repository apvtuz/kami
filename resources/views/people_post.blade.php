@extends('layouts.dashboard')

@section('main')


    @if (!empty(session('success')))
        <div class="alert alert-success">
            <span>
                <b> Success - </b> {{session('success')}}</span>
        </div>
    @endif
    <div class="col-md-2"></div>
    <div class="col-md-8">

        @if ($records->count()>0)
            <table id="datatable" class="table " cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Save</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($records as $record)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>
                            {{App\User::find($record->user_id)->name}}
                            {{App\User::find($record->user_id)->lname}}
                        </td>
                        <form enctype="multipart/form-data" method="POST" action="/post/{{$record->id}}/people">
                            {{ csrf_field() }}
                            <td>
                                <select name="status">
                                    <option value="0" {{$record->status==0?'selected':''}}>waiting</option>
                                    <option value="1" {{$record->status==1?'selected':''}}>approved</option>
                                    <option value="2" {{$record->status==2?'selected':''}}>declined</option>
                                    <option value="3" {{$record->status==3?'selected':''}}>banned</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit"  class="btn btn-success">
                                    <i class="material-icons">save</i> Save</button>

                               </td>
                        </form>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif


        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">


                <a href="/posts" class="btn btn-warning"> <i class="material-icons">navigate_before</i> Back to list </a>

            </div>


        </div>


    </div>
@endsection
