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
                <div class="panel-heading" id="main-heading">Dashboard</div>

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
        UpdateCounts()
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
            $("#main-heading").text("Employees");

            $.getJSON( "api/user/all", function( data ) {
                var d = '<table class="table">\n' +
                    '<thead>' +
                    '<tr>' +
                    '<th>#</th>' +
                    '<th>Name</th>' +
                    '<th>Email</th>' +
                    '<th>Actions</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                $.each( data.data, function( key, value) {
                    d += '<tr>' +
                        '<td>'+data.data[key].id+'</td>' +
                        '<td>'+data.data[key].name+'</td>' +
                        '<td>'+data.data[key].email+'</td>' +
                        '<td><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></td>' +
                        '</tr>';
                });
                d += '</tbody>' +
                    '</table>';
                $("#main-body").html(d);
            });
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
