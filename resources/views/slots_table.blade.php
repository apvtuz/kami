<div class="col-md-12">
    <div class="card">
        <div class="card-header card-header-icon" data-background-color="purple">
            <i class="material-icons">av_timer</i>
        </div>
        <div class="card-content">
            @if (!$slots)
                <div class="form-group label-floating">
                    <h4 class="card-title">Takes time</h4>
                    <select id="takes" class="selectpicker" data-style="select-with-transition">
                        <option value="10 min">10 min</option>
                        <option value="20 min" {{$post->takes=='20 min'?'selected':''}}>20 min</option>
                        <option value="30 min" {{$post->takes=='30 min'?'selected':''}}>30 min</option>
                        <option value="1 h" {{$post->takes=='1 h'?'selected':''}}>1 h</option>
                        <option value="1.5 h" {{$post->takes=='1.5 h'?'selected':''}}>1.5 h</option>
                    </select>
                </div>
                <div class="form-group label-floating">
                    <h4 class="card-title">Interval</h4>
                    <input type="number" min="0" class="form-control" id="interval" value="{{$post->interval}}">
                </div>
                <div class="form-group label-floating">
                    <h4 class="card-title">Conducts from time</h4>
                    <input type="text" class="form-control timepicker" id="time_from" value="10:00">
                </div>
                <div class="form-group label-floating">
                    <h4 class="card-title">Conducts to time</h4>
                    <input type="text" class="form-control timepicker" id="time_to" value="17:00">
                </div>
                <button class="btn btn-primary" onclick="get_slots()">Set</button>
            @endif

            @if ($slots)
                <h4 class="card-title">Check and remove time slots</h4>
                @foreach ($slots as $slot)
                    <div>
                        <h3> {{substr($slot->start,11,5)}} - {{substr($slot->finish,11,5)}}
                            <button class="btn btn-danger" onclick="remove_slot({{$slot->id}})">
                                <i class="material-icons">close</i> Remove slot
                            </button>
                            @if ($slot->user)
                                {{ App\User::find($slot->user)->name}}
                                {{ App\User::find($slot->user)->lname}}
                                {{config('constants.status')[$slot->status]}}
                                @if ($slot->status!=1)
                                    <button class="btn btn-success" onclick="change_slot({{$slot->id}},'accept')">Accept
                                        user
                                    </button>
                                @endif

                                <button class="btn btn-danger" onclick="change_slot({{$slot->id}},'free')">Remove user
                                    and free slot
                                </button>

                                <!--   <button class="btn btn-warning">Block user</button>!-->
                            @endif
                        </h3>

                    </div>

                @endforeach

                <button class="btn btn-primary" id="remove_all_slots">Remove all slots</button>
            @endif

        </div>
    </div>
</div>
<script>
    $('.timepicker').datetimepicker({
        format: 'HH:mm',    // use this format if you want the 24hours timepicker
        //  format: 'h:mm A', //use this format if you want the 12hours timpiecker with AM/PM toggle
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
    $('.selectpicker').selectpicker();

</script>