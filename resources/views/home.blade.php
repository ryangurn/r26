@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <div class="list-group">
                <a href="#" id="list-schedule" class="list-group-item">Schedule</a>
                <a href="#" id="list-events" class="list-group-item">Events</a>
                <a href="#" id="list-equipment" class="list-group-item">Equipment</a>
                <a href="#" id="list-employees" class="list-group-item"><span class="badge" id="employees-count">0</span>Employees</a>
                <a href="#" id="list-blackouts" class="list-group-item">Blackouts</a>
                <a href="#" id="list-locations" class="list-group-item">Locations</a>
                <a href="#" id="list-finance" class="list-group-item">Finance</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading" id="main-heading">
                    Dashboard
                </div>

                <div class="panel-body" id="main-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome!
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="panel panel-default hidden" id="actions">
                <div class="panel-heading">Actions</div>
                <div class="panel-body">
                    <button class="btn btn-primary hidden" id="trash"><span class="glyphicon glyphicon-trash"></span> Show Deleted</button>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Upcoming</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="application/javascript">
    $(document).ready(function(){
        function UpdateCounts() {
            // update list counts
            $.getJSON("api/user/count", function (data) {
                $("#employees-count").text(data.data);
            });
        }

        function EmployeesGetData(url){
            $.getJSON(url, function (data) {
                var d = '<table class="table table-condensed">\n' +
                    '<thead>' +
                    '<tr>' +
                    '<th>#</th>' +
                    '<th>Name</th>' +
                    '<th>Email</th>' +
                    '<th>Actions</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                $.each(data.data, function (key, value) {
                    d += '<tr>' +
                        '<td>' + data.data[key].id + '</td>' +
                        '<td>' + data.data[key].name + '</td>' +
                        '<td>' + data.data[key].email + '</td>' +
                        '<td><a href="api/user/delete/' + data.data[key].id + '"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <a href="#" class="calendar" id="'+data.data[key].id+'"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></a></td>' +
                        '</tr>';
                });
                d += '</tbody>' +
                    '</table>';
                $("#main-body").html(d);

                $(".calendar").on("click", function(){
                    user_id = this.id;
                    hours = ['0:','1:','2:','3:','4:','5:','6:','7:','8:','9:','10:','11:','12:','13:','14:','15:','16:','17:','18:','19:','20:','21:','22:','23:'];
                    minutes = ['00', '15', '30', '45'];

                    message = '<div class="row"><div class="col-md-10"><div class="panel panel-default"><div class="panel-heading">Schedule</div><div class="panel-body">' +
                        '<table class="table table-condensed">' +
                        '<thead>' +
                        '<tr>' +
                        '<th>Time</th>' +
                        '<th>Monday</th>' +
                        '<th>Tuesday</th>' +
                        '<th>Wednesday</th>' +
                        '<th>Thursday</th>' +
                        '<th>Friday</th>' +
                        '<th>Saturday</th>' +
                        '<th>Sunday</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';

                    $.each(hours, function(key, value){
                        message += '<tr>' +
                            '<td>'+ value +'00</td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '</tr>';
                    });

                    message += '</tbody>' +
                    '</table></div></div></div>' +
                        '<div class="col-md-2">' +
                        '<div class="panel panel-default">' +
                        '<div class="panel-heading">Availability</div>' +
                        '<div class="panel-body"><label for="day">Day</label>' +
                        '<div class="form-group">' +
                        '<select id="day" class="form-control">' +
                        '<option value="0">Monday</option>' +
                        '<option value="1">Tuesday</option>' +
                        '<option value="2">Wednesday</option>' +
                        '<option value="3">Thursday</option>' +
                        '<option value="4">Friday</option>' +
                        '<option value="5">Saturday</option>' +
                        '<option value="6">Sunday</option>' +
                        '</select>' +
                        '</div>' +
                        '<div class="form-group">' +
                        '<label for="start_time">Start Time</label>' +
                        '<select id="start_time" class="form-control">';

                    $.each(hours, function(key, value){
                        $.each(minutes, function(k, v){
                            message += '<option value="'+value+v+'">'+value+v+'</option>';
                        });
                    });

                    message += '</select></div><div class="form-group">' +
                        '<label for="end_time">End Time</label>' +
                        '<select id="end_time" class="form-control">';

                    $.each(hours, function(key, value){
                        $.each(minutes, function(k, v){
                            message += '<option value="'+value+v+'">'+value+v+'</option>';
                        });
                    });

                    message += '</select></div><div class="form-group">' +
                        '<label for="category">Reason</label>' +
                        '<select class="form-control" id="reason"><option value="class">Class</option><option value="other">Other</option></select>' +
                        '</div><div class="form-group">' +
                        '<input id="submit" type="button" class="form-control btn btn-danger" value="Submit">' +
                        '</div></div>' +
                        '</div>' +
                        '</div>';

                    bootbox.dialog({
                        title: 'Weekly Availability',
                        message: message,
                        closeButton: true,
                        backdrop: true,
                        size: 'large'
                    });

                    $("#submit").on("click", function(){
                        day = $("#day").val();
                        start_time = $("#start_time").val();
                        end_time = $("#end_time").val();
                        reason = $("#reason").val();

                        data = {
                            day: day,
                            start_time: start_time,
                            end_time: end_time,
                            reason: reason,
                            user_id: user_id,
                        };

                        console.log(data);
                        $.ajax({
                            type: "POST",
                            url: "/api/availability",
                            data: data,
                            success: function(data){
                                console.log(data);
                            },

                        }).fail(function(data) { console.log(data); });;
                    });
                });

            });
        }
        UpdateCounts();
        setInterval( UpdateCounts, 5000 );

        // setup list processing
        $("#list-schedule").click(function(){
            $("#main-heading").text("Schedule");
            $("#main-body").text("Schedule Area");
        });
        $("#list-events").click(function(){
            $("#main-heading").text("Events");
            $("#main-body").text("Events Area");
        });
        $("#list-equipment").click(function(){
            $("#main-heading").text("Equipment");
            $("#main-body").text("Equipment Area");
        });
        $("#list-employees").click(function(){
            url = "api/user/all";
            trash = $("#trash");
            /**
             * Unhiding actions div and options within that div
             */
            $("#actions").removeClass('hidden');
            trash.removeClass('hidden');

            /**
             * Set heading to Employees
             */
            $("#main-heading").text("Employees");

            /**
             * Set trash to change the api call url.
             */
            trash.on("click", function(){
                trash.toggleClass("active");
                if(trash.hasClass("active")){
                    url = "api/user/all?trashed=true";
                    EmployeesGetData(url);
                }else{
                    trash.removeClass('active');
                    url = "api/user/all";
                    EmployeesGetData(url);
                }
            });

            /**
             * Get initial data from api
             */
            EmployeesGetData(url);
        });
        $("#list-blackouts").click(function(){
            $("#main-heading").text("Blackouts");
            $("#main-body").text("Blackouts Area");
        });
        $("#list-locations").click(function(){
            $("#main-heading").text("Locations");
            $("#main-body").text("Locations Area");
        });
        $("#list-finance").click(function(){
            $("#main-heading").text("Finance");
            $("#main-body").text("Finance Area");
        });

    });
</script>
@endsection
