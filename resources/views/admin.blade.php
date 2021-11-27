@extends('layouts.master')

@section('title', 'Admin Management')
@section('page-name', 'Admin Management')


@section('main-content')
    @csrf

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Admin List</h3>
            <span class="float-right">
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal"
                    data-target="#addAdminModal">Add</button>
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="adminTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Designation</th>
                        <th>User Type</th>
                        <th>Details</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($admins as $admin)
                        <tr id="tr{{ $admin['id'] }}">
                            <td>{{ $i }}</td>
                            <td>{{ $admin['name'] }}</td>
                            <td>{{ $admin['email'] }}</td>
                            <td>{{ $admin['mobile'] }}</td>
                            <td>{{ $admin['designation'] }}</td>
                            <td>{{ $admin['user_type_name'] }}</td>
                            <td>
                                Created By: {{ $admin['created_by'] }} <br>
                                Created At: {{ $admin['created_at'] }} <br>
                                Deleted By: {{ $admin['deleted_by'] }} <br>
                                Deleted At: {{ $admin['deleted_at'] }}
                            </td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-xs"
                                    onclick="editPromt('{{ $admin['id'] }}')">Edit</button>
                                <button class="btn btn-danger btn-xs"
                                    onclick="deleteAdmin('{{ $admin['id'] }}')">Delete</button>
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
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Designation</th>
                        <th>User Type</th>
                        <th>Details</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- add Admin Modal -->
    <div class="modal fade" id="addAdminModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Admin</h4>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Admin Name" name="addAdminName"
                                    id="addAdminName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Admin Email" name="addAdminEmail"
                                    id="addAdminEmail" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" placeholder="Admin Mobile Number"
                                    name="addAdminMobile" id="addAdminMobile" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" placeholder="Admin Designation"
                                    name="addAdminDesignation" id="addAdminDesignation" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Admin Type</label>
                                <select id="addAdminUserType" class="form-control" name="addAdminUserType">
                                    <option value="null" selected disabled>--Select A Type--</option>
                                    @foreach ($adminusertypes as $adminUserType)
                                        <option value="{{ $adminUserType->id }}">{{ $adminUserType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Admin Password"
                                    name="addAdminPassword" id="addAdminPassword" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveAdmin()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Admin Modal -->

    <!-- edit Admin Modal -->
    <div class="modal fade" id="editAdminModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Admin</h4>
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
                    <input type="hidden" name="editAdminId" id="editAdminId" value="0">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Admin Name" name="editAdminName"
                                    id="editAdminName" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" placeholder="Admin Email" name="editAdminEmail"
                                    id="editAdminEmail" required><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mobile</label>
                                <input type="text" class="form-control" placeholder="Admin Mobile Number"
                                    name="editAdminMobile" id="editAdminMobile" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" class="form-control" placeholder="Admin Designation"
                                    name="editAdminDesignation" id="editAdminDesignation" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Admin Type</label>
                                <select id="editAdminUserType" class="form-control" name="editAdminUserType">
                                    <option value="null" selected disabled>--Select A Type--</option>

                                    @foreach ($adminusertypes as $adminUserType)
                                        <option value="{{ $adminUserType->id }}">{{ $adminUserType->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control"
                                    placeholder="Type If You Need to Update The Password !" name="editAdminPassword"
                                    id="editAdminPassword" required><br>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateAdmin()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- edit Admin Modal -->
@endsection


@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#adminTable').DataTable({
                "scrollX": true,
                "autoWidth": false
            });
        });


        function saveAdmin() {
            showPreloader();
            var name = $('#addAdminName').val();
            var email = $('#addAdminEmail').val();
            var mobile = $('#addAdminMobile').val();
            var designation = $('#addAdminDesignation').val();
            var usertype = $('#addAdminUserType').val();
            var password = $('#addAdminPassword').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                method: "POST",
                url: "{{ route('admin.save') }}",
                data: {
                    name: name,
                    email: email,
                    mobile: mobile,
                    designation: designation,
                    usertype: usertype,
                    password: password,
                    _token: _token
                },
                success: function(response) {

                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Admin has been Added Successfully',
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

            $.get("admin-management/details/" + id, function(admin) {

                $('#editAdminId').val(admin.id);
                $('#editAdminName').val(admin.name);
                $('#editAdminEmail').val(admin.email);
                $('#editAdminMobile').val(admin.mobile);
                $('#editAdminDesignation').val(admin.designation);
                $('#editAdminUserType').val(admin.user_type);
                $('#editAdminPassword').val("");
                $('#editAdminModal').modal('show');
                hidePreloader();
            });
        }

        function updateAdmin() {

            showPreloader();

            var id = $('#editAdminId').val();
            var name = $('#editAdminName').val();
            var email = $('#editAdminEmail').val();
            var mobile = $('#editAdminMobile').val();
            var designation = $('#editAdminDesignation').val();
            var usertype = $('#editAdminUserType').val();
            var password = $('#editAdminPassword').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "PUT",
                url: "{{ route('admin.update') }}",
                data: {
                    id: id,
                    name: name,
                    email: email,
                    mobile: mobile,
                    designation: designation,
                    usertype: usertype,
                    password: password,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $('#tr' + response.id + ' td:nth-child(2)').text(response.name);
                        $('#tr' + response.id + ' td:nth-child(3)').text(response.email);
                        $('#tr' + response.id + ' td:nth-child(4)').text(response.mobile);
                        $('#tr' + response.id + ' td:nth-child(5)').text(response.designation);
                        $('#tr' + response.id + ' td:nth-child(6)').text(response.user_type_name);

                        $('#editAdminModal').modal('hide');
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Admin has been Updated Successfully',
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

        function deleteAdmin(id) {
            if (confirm("Do You Really Want To Delete The Admin ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('admin.delete') }}",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {
                            $("#adminTable").DataTable().rows($("#tr" + id)).remove();
                            $("#adminTable").DataTable().draw();
                            hidePreloader();
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Admin has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    }
                });
            }
        }
    </script>
@endsection
