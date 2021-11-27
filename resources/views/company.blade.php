@extends('layouts.master')

@section('title', 'Company Management')
@section('page-name', 'Company Management')


@section('main-content')
    @csrf

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Company List</h3>
            <span class="float-right">
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal"
                    data-target="#addCompanyModal">Add</button>
            </span>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table id="companyTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>address</th>
                        <th>Total Project</th>
                        <th>Total project value</th>
                        <th>Total Paid Amount</th>
                        <th>Created by</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($companys as $company)
                        <tr id="tr{{ $company['id'] }}">
                            <td>{{ $i }}</td>
                            <td>{{ $company['name'] }}</td>
                            <td>{{ $company['address'] }}</td>
                            <td>{{ $company['total_projects'] }}</td>
                            <td>{{ $company['total_projects_value'] }}</td>
                            <td>{{ $company['total_paid_amount'] }}</td>
                            <td>{{ $company['created_by_name'] }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-xs"
                                    onclick="editPromt('{{ $company['id'] }}')">Edit</button>
                                <button class="btn btn-danger btn-xs"
                                    onclick="deleteCompany('{{ $company['id'] }}')">Delete</button>
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
                        <th>address</th>
                        <th>Total Project</th>
                        <th>Total project value</th>
                        <th>Total Paid Amount</th>
                        <th>Created by</th>
                        <th>Operation</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

    <!-- add Company Modal -->
    <div class="modal fade" id="addCompanyModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Company</h4>
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
                                <input type="text" class="form-control" placeholder="Company Name" name="addCompanyName"
                                    id="addCompanyName" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Comapny Address"
                                    name="addCompanyAddress" id="addCompanyAddress" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveCompany()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Company Modal -->


    <!-- edit Company Modal -->
    <div class="modal fade" id="editCompanyModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Company</h4>
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
                    <input type="hidden" name="editCompanyId" id="editCompanyId" value="0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Company Name" name="editCompanyName"
                                    id="editCompanyName" required><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Company Address"
                                    name="editCompanyAddress" id="editCompanyAddress" required><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateCompany()">Save</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- edit Company Modal -->


@endsection


@section('extra-js')
    <script>
        $(document).ready(function() {
            $('#companyTable').DataTable({
                "scrollX": true,
                "autoWidth": false,
                "order": [
                    [0, "asc"]
                ]
            });
        });



        function saveCompany() {

            showPreloader();
            var name = $('#addCompanyName').val();
            var address = $('#addCompanyAddress').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "POST",
                url: "{{ route('company.save') }}",
                data: {
                    name: name,
                    address: address,
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

            $.get("company-management/details/" + id, function(company) {

                $('#editCompanyId').val(company.id);
                $('#editCompanyName').val(company.name);
                $('#editCompanyAddress').val(company.address);
                $('#editCompanyModal').modal('show');
                hidePreloader();
            });
        }

        function updateCompany() {

            showPreloader();

            var id = $('#editCompanyId').val();
            var name = $('#editCompanyName').val();
            var address = $('#editCompanyAddress').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "PUT",
                url: "{{ route('company.update') }}",
                data: {
                    id: id,
                    name: name,
                    address: address,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $('#tr' + response.id + ' td:nth-child(2)').text(response.name);
                        $('#tr' + response.id + ' td:nth-child(3)').text(response.address);
                        $('#editCompanyModal').modal('hide');
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Company has been Edited Successfully',
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

        function deleteCompany(id) {
            if (confirm("Do You Really Want To Delete The Company ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('company.delete') }}",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {

                            $("#companyTable").DataTable().rows($("#tr" + id)).remove();
                            $("#companyTable").DataTable().draw();
                            hidePreloader();
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Company has been Deleted Successfully',
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
