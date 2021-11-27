@extends('layouts.master')

@section('title', 'Meeting and Event')
@section('page-name', 'Meeting and Event')


@section('main-content')
    @csrf

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Meeting and Event List</h3>
            <span class="float-right">
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addEventModal"
                    onclick="clearAddModal()">Add</button>
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="eventTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Event/Meeting Category</th>
                        <th>Details</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($events as $event)
                        <tr id="tr{{ $event['id'] }}">
                            <td>{{ $i }}</td>
                            <td>{{ $event['title'] }}</td>
                            <td>{{ $event['description'] }}</td>
                            <td>{{ $event['starting_date'] }}</td>
                            <td>{{ $event['ending_date'] }}</td>
                            <td>
                                @if ($event['full_day'] == '1')
                                    <p>Full Day Event</p>
                                @else
                                    <p>Time Event</p>
                                @endif
                            </td>
                            <td>
                                Created By: {{ $event['created_by'] }} <br>
                                Created At: {{ $event['created_at'] }} <br>
                                Deleted By: {{ $event['deleted_by'] }} <br>
                                Deleted At: {{ $event['deleted_at'] }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-xs"
                                    onclick="editPromt('{{ $event['id'] }}')">Edit</button>
                                <button class="btn btn-danger btn-xs"
                                    onclick="deleteEvent('{{ $event['id'] }}')">Delete</button>
                            </td>
                        </tr>

                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Event/Meeting Category</th>
                        <th>Details</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- add Event Modal -->
    <div class="modal fade" id="addEventModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForAdd">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Event/Meeting title"
                                    name="addEventTitle" id="addEventTitle" required><br>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" placeholder="Event/Meeting Description"
                                    name="addEventDescription" id="addEventDescription" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Starting Date</label>
                                <div class="input-group date" id="addEventStartingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#addEventStartingDateDiv" id="addEventStartingDate" />
                                    <div class="input-group-append" data-target="#addEventStartingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ending Date</label>
                                <div class="input-group date" id="addEventEndingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#addEventEndingDateDiv" id="addEventEndingDate" />
                                    <div class="input-group-append" data-target="#addEventEndingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Meeting or Event Type</label>
                                <select id="addEventType" class="form-control" name="addEventType">
                                    <option value="null" selected disabled>--Select A Type--</option>
                                    <option value="0">Time Event </option>
                                    <option value="1">Full Day Event</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- Date -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveEvent()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Event Modal -->


    <!-- edit Event Modal -->
    <div class="modal fade" id="editEventModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForEdit">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" name="editEventId" id="editEventId" value="0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" placeholder="Event/Meeting title"
                                    name="editEventTitle" id="editEventTitle" required><br>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" placeholder="Enter ..."
                                    name="editEventDescription" id="editEventDescription" required></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Starting Date</label>
                                <div class="input-group date" id="editEventStartingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#editEventStartingDateDiv" id="editEventStartingDate" />
                                    <div class="input-group-append" data-target="#editEventStartingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Ending Date</label>
                                <div class="input-group date" id="editEventEndingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#editEventEndingDateDiv" id="editEventEndingDate" />
                                    <div class="input-group-append" data-target="#editEventEndingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Meeting or Event Type</label>
                                <select id="editEventFullDay" class="form-control" name="editEventFullDay">
                                    <option value="null" selected disabled>--Select A Type--</option>
                                    <option value="0">Time Event </option>
                                    <option value="1">Full Day Event</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateEvent()">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- edit Event Modal -->
    </div>
@endsection


@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#eventTable').DataTable({
                "scrollX": true,
                "autoWidth": false
            });
        });
        $.fn.datetimepicker.Constructor.Default = $.extend({},
            $.fn.datetimepicker.Constructor.Default, {
                icons: {
                    time: 'fas fa-clock',
                    date: 'fas fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-arrow-circle-left',
                    next: 'fas fa-arrow-circle-right',
                    today: 'far fa-calendar-check-o',
                    clear: 'fas fa-trash',
                    close: 'far fa-times'
                }
            });
        //Date picker
        $('#addEventStartingDateDiv').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            timePicker: true,
            pick12HourFormat: false
        });
        $('#addEventEndingDateDiv').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            timePicker: true,
            pick12HourFormat: false
        });
        $('#editEventStartingDateDiv').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            timePicker: true,
            pick12HourFormat: false
        });
        $('#editEventEndingDateDiv').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            timePicker: true,
            pick12HourFormat: false
        });

        function saveEvent() {
            showPreloader();
            var title = $('#addEventTitle').val();
            var description = $('#addEventDescription').val();
            var starting_date = $('#addEventStartingDate').val();
            var ending_date = $('#addEventEndingDate').val();
            var full_day = $('#addEventType :selected').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                method: "POST",
                url: "{{ route('event.save') }}",
                data: {
                    title: title,
                    description: description,
                    starting_date: starting_date,
                    ending_date: ending_date,
                    full_day: full_day,
                    _token: _token
                },
                success: function(response) {

                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Event has been Added Successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        hidePreloader();
                        window.setTimeout(
                            function() {
                                location.reload(true)
                            },
                            1000
                        );
                    }

                },

                error: function(xhr, status, error) {
                    hidePreloader();
                    $("#errorDivForAdd").empty();
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errorDivForAdd").append("<li class='alert alert-danger'>" + item + "</li>")
                    });

                }

            });
        }

        function editPromt(id) {

            showPreloader();
            $("#errorDivForEdit").empty();
            $.get("event/details/" + id, function(event) {
                $('#editEventId').val(event.id);
                $('#editEventTitle').val(event.title);
                $('#editEventDescription').val(event.description);
                $('#editEventStartingDate').val(event.starting_date);
                $('#editEventEndingDate').val(event.ending_date);
                $('#editEventFullDay').val(event.full_day);
                $('#editEventModal').modal('show');

                hidePreloader();

            });
        }

        function updateEvent() {

            showPreloader();

            var id = $('#editEventId').val();
            var title = $('#editEventTitle').val();
            var description = $('#editEventDescription').val();
            var starting_date = $('#editEventStartingDate').val();
            var ending_date = $('#editEventEndingDate').val();
            var full_day = $('#editEventFullDay :selected').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "PUT",
                url: "{{ route('event.update') }}",
                data: {
                    id: id,
                    title: title,
                    description: description,
                    starting_date: starting_date,
                    full_day: full_day,
                    ending_date: ending_date,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $('#tr' + response.id + ' td:nth-child(2)').text(response.name);
                        $('#tr' + response.id + ' td:nth-child(3)').text(response.value);
                        $('#tr' + response.id + ' td:nth-child(4)').text(response.value);
                        $('#tr' + response.id + ' td:nth-child(5)').text(response.value);

                        $('#editEventModal').modal('hide');
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Event has been Updated Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        window.setTimeout(
                            function() {
                                location.reload(true)
                            },
                            1000
                        );
                    }

                },

                error: function(xhr, status, error) {
                    hidePreloader();
                    $("#errorDivForEdit").empty();
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errorDivForEdit").append("<li class='alert alert-danger'>" + item + "</li>")
                    });

                }
            });
        }


        function deleteEvent(id) {
            if (confirm("Do You Really Want To Delete The Event ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('event.delete') }}",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {
                            $("#eventTable").DataTable().rows($("#tr" + id)).remove();
                            $("#eventTable").DataTable().draw();
                            hidePreloader();
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Event has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            window.setTimeout(
                                function() {
                                    location.reload(true)
                                },
                                1000
                            );
                        }
                    }
                });
            }
        }

        function clearAddModal() {
            $('#addEventTitle').val('');
            $('#addEventDescription').val('');
            $('#addEventStartingDate').val('');
            $('#addEventEndingDate').val('');
            $("#errorDivForAdd").empty();
        }
    </script>
@endsection
