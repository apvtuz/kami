var current = 0, slot_id = null;
$(document).ready(function () {


    $('#datatable').DataTable();
    $('#summernote').summernote();


    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm',
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

    $('.fileinput').fileinput();

    if ($('.date').length > 0) {
        pickmeup('.date', {
            flat: true,
            format: 'Y-m-d',
            mode: 'multiple'
        });

        $('#date').on('pickmeup-change', function (e) {
            $('#conducted_at').val(JSON.stringify(pickmeup('.date').get_date('Y-m-d')));
        })


    }

    var total = $('#sl_cont').data('total') - 1;
    show_slots();
    if ($('#date1').length > 0) {
        $(document).on("click", "#prev", function () {
            current > 0 ? current-- : current = total;
            show_slots();
        });
        $(document).on("click", "#next", function () {
            current < total ? current++ : current = 0;

            show_slots();
        });
    }
    $(document).on("click", ".slot_r", function () {
        slot_id = $(this).data('id');
        //console.log(slot_id);
    });

    //Edit post
    $('#add_age').click(function (event) {
        event.preventDefault();
        var csrftoken = $('meta[name=_token]').attr('content');
        $.post('/post/add_age', {'_token': csrftoken}, function (data) {

            $('#age_cont').append(data);
        }).fail(function (data) {
            console.log(data.responseText);
        });
    });

    $('#slots_date').change(function () {
        if (!$('#slots_date').val()) return;
         $('#time_from').val(null),
       $('#time_to').val(null),
        $('#takes').val(null),
        $('#interval').val(null),
        get_slots()
    });



    $(document).on("click", "#remove_all_slots", function () {
        var csrftoken = $('meta[name=_token]').attr('content');
        $.post('/post/remove_all_slots', {
            '_token': csrftoken,
            post_id: $('#post_id').data('id'),
            date: $('#slots_date').val()
        }, function (data) {

            $('#slots_cont').html(data);
        }).fail(function (data) {
            console.log(data.responseText);
        });

    });
});

function remove_slot(id) {
    var csrftoken = $('meta[name=_token]').attr('content');
    $.post('/post/remove_slot', {
        '_token': csrftoken,
        id: id,
        post_id:$('#post_id').data('id'),
        date: $('#slots_date').val()
    }, function (data) {

        $('#slots_cont').html(data);
    }).fail(function (data) {
        console.log(data.responseText);
    });
}
function get_slots(){
    var csrftoken = $('meta[name=_token]').attr('content');
    $.post('/post/get_slots', {
        '_token': csrftoken,
        time_from: $('#time_from').val(),
        time_to: $('#time_to').val(),
        takes:$('#takes').val(),
        interval:$('#interval').val(),
        post_id:$('#post_id').data('id'),
        date: $('#slots_date').val()
    }, function (data) {
       // console.log(data);
        $('#slots_cont').html(data);
    }).fail(function (data) {
        console.log(data.responseText);
    });
}
function show_slots() {
    var csrftoken = $('meta[name=_token]').attr('content');
    var post_id = $('#sl_cont').data('postid');
    //  console.log(current);
    $.post('/post/show_slots', {
        '_token': csrftoken,
        post_id: post_id,
        current: current
    }, function (data) {

        $('#sl_cont').html(data);
    }).fail(function (data) {
        console.log(data.responseText);
    });
}

function select_slot() {
    if (!confirm('Please confirm!')) return;
    if (!slot_id) {
        alert('Select slot, please');
        return;
    }
    var csrftoken = $('meta[name=_token]').attr('content');
    var post_id = $('#sl_cont').data('postid');
    //  console.log(current);
    $.post('/post/select_slot', {
        '_token': csrftoken,
        post_id: post_id,
        slot_id: slot_id,
        current: current
    }, function (data) {

        $('#sl_cont').html(data);
    }).fail(function (data) {
        console.log(data.responseText);
    });
}

function change_slot(slot_id,action) {
    var csrftoken = $('meta[name=_token]').attr('content');
    var post_id = $('#sl_cont').data('postid');
    $.post('/post/change_slot', {
        '_token': csrftoken,
        post_id:$('#post_id').data('id'),
        slot_id: slot_id,
        date: $('#slots_date').val(),
        action:action
    }, function (data) {
         $('#slots_cont').html(data);
    }).fail(function (data) {
        console.log(data.responseText);
    });
}

function close_age(id) {
    $('#age'+id).remove();
}

