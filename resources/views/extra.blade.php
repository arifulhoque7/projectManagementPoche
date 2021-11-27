@extends('layouts.master')

@section('title', 'Extra Management')
@section('page-name', 'Extra Management')


@section('main-content')
    @csrf

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Extra List</h3>
            <span class="float-right">
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal"
                    data-target="#addExtraModal" onclick="clearAddModal()">Add</button>
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="extraTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Value</th>
                        <th>Details</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($extras as $extra)
                        <tr id="tr{{ $extra['id'] }}">
                            <td>{{ $i }}</td>
                            <td>{{ $extra['name'] }}</td>
                            <td>{{ $extra['value'] }}</td>
                            <td>
                                Created By: {{ $extra['created_by'] }} <br>
                                Created At: {{ $extra['created_at'] }} <br>
                                Deleted By: {{ $extra['deleted_by'] }} <br>
                                Deleted At: {{ $extra['deleted_at'] }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-xs"
                                    onclick="editPromt('{{ $extra['id'] }}')">Edit</button>
                                <button class="btn btn-danger btn-xs"
                                    onclick="deleteExtra('{{ $extra['id'] }}')">Delete</button>
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
                        <th>Name</th>
                        <th>Value</th>
                        <th>Details</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->


    </div>

    <!-- add Extra Modal -->
    <div class="modal fade" id="addExtraModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Extra</h4>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Extra Name" name="addExtraName"
                                    id="addExtraName" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Value</label>
                                <input type="text" class="form-control" placeholder="Extra Value" name="addExtraValue"
                                    id="addExtraValue" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveExtra()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Extra Modal -->


    <!-- edit Extra Modal -->
    <div class="modal fade" id="editExtraModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Extra</h4>
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
                    <input type="hidden" name="editExtraId" id="editExtraId" value="0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Extra Name" name="editExtraName"
                                    id="editExtraName" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Value</label>
                                <input type="text" class="form-control" placeholder="Extra Value" name="editExtraValue"
                                    id="editExtraValue" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateExtra()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- edit Extra Modal -->


@endsection


@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#extraTable').DataTable({
                "scrollX": true,
                "autoWidth": false
            });
        });



        function saveExtra() {
            showPreloader();
            var name = $('#addExtraName').val();
            var value = $('#addExtraValue').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                method: "POST",
                url: "{{ route('extra.save') }}",
                data: {
                    name: name,
                    value: value,
                    _token: _token
                },
                success: function(response) {

                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Extra has been Added Successfully',
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

            $.get("extra-management/details/" + id, function(extra) {

                $('#editExtraId').val(extra.id);
                $('#editExtraName').val(extra.name);
                $('#editExtraValue').val(extra.value);
                $('#editExtraModal').modal('show');

                hidePreloader();

            });
        }

        function updateExtra() {

            showPreloader();

            var id = $('#editExtraId').val();
            var name = $('#editExtraName').val();
            var value = $('#editExtraValue').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "PUT",
                url: "{{ route('extra.update') }}",
                data: {
                    id: id,
                    name: name,
                    value: value,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $('#tr' + response.id + ' td:nth-child(2)').text(response.name);
                        $('#tr' + response.id + ' td:nth-child(3)').text(response.value);

                        $('#editExtraModal').modal('hide');
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Extra has been Updated Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
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

        function deleteExtra(id) {
            if (confirm("Do You Really Want To Delete The Extra ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('extra.delete') }}",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {

                            $("#extraTable").DataTable().rows($("#tr" + id)).remove();
                            $("#extraTable").DataTable().draw();

                            hidePreloader();
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Extra has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }


                    }
                });
            }
        }

        function clearAddModal(){
            $('#addExtraName').val('');
            $('#addExtraValue').val('');
            $("#errorDivForAdd").empty();
        }
    </script>
@endsection
