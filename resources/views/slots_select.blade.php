

<div class="col-md-9">
    <button class="btn btn-primary" id="prev">
         <span class="btn-label">
             <i class="material-icons">keyboard_arrow_left</i>
         </span>
        Prev
    </button>
    <button class="btn btn-primary" id="slot_date">

        {{$date}}

    </button>
    <button class="btn btn-primary" id="next">
        Next
        <span class="btn-label">
            <i class="material-icons">keyboard_arrow_right</i>
                                </span>

    </button>
    <div >


        @if (!$slots)
            <h4>No slots for the date</h4>

        @else

            @foreach ($slots as $slot)
                <label class="btn btn-warning"><input type="radio" name="slot" class="slot_r" data-id="{{$slot->id}}"> {{substr($slot->start,11,5)}}
                    - {{substr($slot->finish,11,5)}}
                </label>
            @endforeach
            <div class="row">
                <button class="btn btn-round btn-primary" onclick="select_slot()">
                    Participate
                </button>
            </div>
        @endif

    </div>

</div>


