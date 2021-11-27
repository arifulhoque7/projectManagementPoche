@extends('layouts.master')

@section('title', 'TimeLine Management')
@section('eventsFromPhpge-name', 'Timeline Management')

@section('extra-css')
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.min.css"/> --}}
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fullcalendar/main.css') }}">
    {{-- <link rel="stylesheet" href="../plugins/fullcalendar/main.css"> --}}
    <style>
    </style>
@endsection

@section('main-content')
    @php
    $eventsFromPhp = [];
    $tempEvent = [];
    @endphp
    @foreach ($timelineProjects as $item)
        @php
            $tempEvent['title'] = $item['name'];
            $tempEvent['start'] = $item['start'];
            $tempEvent['end'] = $item['end'];
            $tempEvent['backgroundColor'] = $item['backgroundColor'];
            $tempEvent['borderColor'] = $item['borderColor'];
            $tempEvent['allDay'] = true;
            array_push($eventsFromPhp, $tempEvent);
        @endphp
    @endforeach
    @php
    $meetingsFromPhp = [];
    $tempMeeting = [];
    @endphp
    @foreach ($timelineEvents as $item)
        @php
            $tempMeeting['title'] = $item['title'];
            $tempMeeting['start'] = $item['starting_date'];
            
            $tempMeeting['backgroundColor'] = $item['backgroundColor'];
            $tempMeeting['borderColor'] = $item['borderColor'];
            if ($item['full_day'] == '0') {
                $tempMeeting['allDay'] = false;
            }
            if ($item['full_day'] == '1') {
                $tempMeeting['end'] = $item['ending_date'];
                $tempMeeting['allDay'] = true;
            } 
            array_push($eventsFromPhp, $tempMeeting);
        @endphp
    @endforeach

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@section('extra-js')
    <script src="{{ URL::asset('admin/plugins/fullcalendar/main.js') }}"></script>
    <script>
        var eventsjs = @php  echo json_encode($eventsFromPhp);  @endphp;
        $(function() {
            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function() {
                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }
                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)
                })
            }

            ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');
            // initialize the external events
            // -----------------------------------------------------------------

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: eventsjs,
                editable: false,

                drop: function(info) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        info.draggedEl.eventsFromPhprentNode.removeChild(info.draggedEl);
                    }
                }
            });
            calendar.render();

        })
    </script>

@endsection
