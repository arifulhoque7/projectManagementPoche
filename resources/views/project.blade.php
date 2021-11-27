@extends('layouts.master')

@section('title', 'Project Management')

@section('page-name', $extraVariables['pageName'])

@section('extra-css')
    <style>
        h3.widget-user-username {
            margin-left: 0 !important;
        }

        h3.widget-user-username a {
            color: #ffffff !important;
        }

        h3.widget-user-username a:hover {
            color: #ffffff !important;
            text-decoration: underline;
            font-weight: 500;
        }


        h5.widget-user-desc {
            margin-left: 0 !important;
        }

        .badge {
            font-size: 18px;
        }

    </style>
@endsection

@section('main-content')
    @csrf
    <div class="card card-dark card-tabs">
        <div class="card-header p-0 pt-1">

            <span class="float-right" style="margin-right: 10px;">
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addProjectModal"
                    onclick="clearAddModal()">Add Project
                </button>
            </span>

            <ul class="nav nav-tabs" id="project-management-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="project-management-all-tab" data-toggle="pill"
                        href="#project-management-all" role="tab" aria-controls="project-management-all"
                        aria-selected="true">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="project-management-on-going-tab" data-toggle="pill"
                        href="#project-management-on-going" role="tab" aria-controls="project-management-on-going"
                        aria-selected="false">On Going</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="project-management-on-hold-tab" data-toggle="pill"
                        href="#project-management-on-hold" role="tab" aria-controls="project-management-on-hold"
                        aria-selected="false">On Hold</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="project-management-completed-tab" data-toggle="pill"
                        href="#project-management-completed" role="tab" aria-controls="project-management-completed"
                        aria-selected="false">Completed</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content" id="project-management-tabContent">
                <div class="tab-pane fade show active" id="project-management-all" role="tabpanel"
                    aria-labelledby="project-management-all-tab">
                    <div class="row">

                        @foreach ($projects as $project)
                            <div class="col-md-4">
                                <!-- Widget: user widget style 2 -->
                                <div class="card card-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-dark">
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown">
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item"
                                                    onclick="promtEditStatus('{{ $project['id'] }}','{{ $project['name'] }}', '{{ $project['status'] }}')">Edit
                                                    status
                                                </button>

                                                <button class="dropdown-item" data-toggle="modal"
                                                    data-target="#editProjectModal"
                                                    onclick="editPromt('{{ $project['id'] }}')">Edit
                                                    Project
                                                </button>
                                                <button class="dropdown-item"
                                                    onclick="deleteProject('{{ $project['id'] }}')">Delete
                                                    Project
                                                </button>
                                                @if ($project['show_in_front'] == 0)
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 1)">Show in Front
                                                    </button>
                                                @else
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 0)">Remove From Front
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" name="projectId" id="projectId" value="{{ $project['id'] }}">
                                        <h3 class="widget-user-username ">
                                            <a
                                                href="{{ route('project.details.view', $project['id']) }}">{{ $project['name'] }}</a>
                                        </h3>
                                        <h5 class="widget-user-desc">{{ $project['location'] }}</h5>
                                    </div>

                                    <div class="card-body p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Phase Number <span
                                                        class="float-right badge bg-primary">{{ $project['phase_number'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Recent Phase Complete Date <span
                                                        class="float-right badge bg-info">{{ $project['phase_complete_date'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Project Value <span class="float-right badge bg-success"
                                                        id='totalProjectValue'>{{ $project['project_value'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Paid Amount <span class="float-right badge bg-danger"
                                                        id='totalPaidAmount'>{{ $project['paid_amount'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Due Amount
                                                    @if ((int) $project['project_value'] - (int) $project['paid_amount'] <= 0)
                                                        <span
                                                            class="float-right badge bg-success ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @elseif ((int) $project['project_value'] - (int)
                                                        $project['paid_amount'] > 0)
                                                        <span
                                                            class="float-right badge bg-danger ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="project-management-on-going" role="tabpanel"
                    aria-labelledby="project-management-on-going-tab">
                    <div class="row">

                        @foreach ($onGoingProjects as $project)
                            <div class="col-md-4">
                                <!-- Widget: user widget style 2 -->
                                <div class="card card-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-dark">
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown">
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item"
                                                    onclick="promtEditStatus('{{ $project['id'] }}','{{ $project['name'] }}', '{{ $project['status'] }}')">Edit
                                                    status
                                                </button>

                                                <button class="dropdown-item" data-toggle="modal"
                                                    data-target="#editProjectModal"
                                                    onclick="editPromt('{{ $project['id'] }}')">Edit
                                                    Project
                                                </button>
                                                <button class="dropdown-item"
                                                    onclick="deleteProject('{{ $project['id'] }}')">Delete
                                                    Project
                                                </button>
                                                @if ($project['show_in_front'] == 0)
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 1)">Show in Front
                                                    </button>
                                                @else
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 0)">Remove From Front
                                                    </button>
                                                @endif
                                               
                                            </div>
                                        </div>
                                        <input type="hidden" name="projectId" id="projectId"
                                            value="{{ $project['id'] }}">
                                        <h3 class="widget-user-username ">
                                            <a
                                                href="{{ route('project.details.view', $project['id']) }}">{{ $project['name'] }}</a>
                                        </h3>
                                        <h5 class="widget-user-desc">{{ $project['location'] }}</h5>

                                    </div>

                                    <div class="card-body p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Phase Number <span
                                                        class="float-right badge bg-primary">{{ $project['phase_number'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Recent Phase Complete Date <span
                                                        class="float-right badge bg-info">{{ $project['phase_complete_date'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Project Value <span class="float-right badge bg-success"
                                                        id='totalProjectValue'>{{ $project['project_value'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Paid Amount <span class="float-right badge bg-danger"
                                                        id='totalPaidAmount'>{{ $project['paid_amount'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Due Amount
                                                    @if ((int) $project['project_value'] - (int) $project['paid_amount'] <= 0)
                                                        <span
                                                            class="float-right badge bg-success ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @elseif ((int) $project['project_value'] - (int)
                                                        $project['paid_amount'] > 0)
                                                        <span
                                                            class="float-right badge bg-danger ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="project-management-on-hold" role="tabpanel"
                    aria-labelledby="project-management-on-hold-tab">
                    <div class="row">

                        @foreach ($holdProjects as $project)
                            <div class="col-md-4">
                                <!-- Widget: user widget style 2 -->
                                <div class="card card-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-dark">
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown">
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item"
                                                    onclick="promtEditStatus('{{ $project['id'] }}','{{ $project['name'] }}', '{{ $project['status'] }}')">Edit
                                                    status
                                                </button>
                                                <button class="dropdown-item" data-toggle="modal"
                                                    data-target="#editProjectModal"
                                                    onclick="editPromt('{{ $project['id'] }}')">Edit
                                                    Project
                                                </button>
                                                <button class="dropdown-item"
                                                    onclick="deleteProject('{{ $project['id'] }}')">Delete
                                                    Project
                                                </button>
                                                @if ($project['show_in_front'] == 0)
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 1)">Show in Front
                                                    </button>
                                                @else
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 0)">Remove From Front
                                                    </button>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" name="projectId" id="projectId"
                                            value="{{ $project['id'] }}">
                                        <h3 class="widget-user-username ">
                                            <a
                                                href="{{ route('project.details.view', $project['id']) }}">{{ $project['name'] }}</a>
                                        </h3>
                                        <h5 class="widget-user-desc">{{ $project['location'] }}</h5>
                                    </div>

                                    <div class="card-body p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Phase Number <span
                                                        class="float-right badge bg-primary">{{ $project['phase_number'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Recent Phase Complete Date <span
                                                        class="float-right badge bg-info">{{ $project['phase_complete_date'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Project Value <span class="float-right badge bg-success"
                                                        id='totalProjectValue'>{{ $project['project_value'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Paid Amount <span class="float-right badge bg-danger"
                                                        id='totalPaidAmount'>{{ $project['paid_amount'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Due Amount
                                                    @if ((int) $project['project_value'] - (int) $project['paid_amount'] <= 0)
                                                        <span
                                                            class="float-right badge bg-success ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @elseif ((int) $project['project_value'] - (int)
                                                        $project['paid_amount'] > 0)
                                                        <span
                                                            class="float-right badge bg-danger ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="project-management-completed" role="tabpanel"
                    aria-labelledby="project-management-completed-tab">
                    <div class="row">

                        @foreach ($completedProjects as $project)


                            <div class="col-md-4">
                                <!-- Widget: user widget style 2 -->
                                <div class="card card-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-dark">
                                        <div class="btn-group float-right">
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                                data-toggle="dropdown">
                                            </button>
                                            <div class="dropdown-menu">
                                                <button class="dropdown-item"
                                                    onclick="promtEditStatus('{{ $project['id'] }}','{{ $project['name'] }}', '{{ $project['status'] }}')">Edit
                                                    status
                                                </button>
                                                <button class="dropdown-item" data-toggle="modal"
                                                    data-target="#editProjectModal"
                                                    onclick="editPromt('{{ $project['id'] }}')">Edit
                                                    Project
                                                </button>
                                                <button class="dropdown-item"
                                                    onclick="deleteProject('{{ $project['id'] }}')">Delete
                                                    Project
                                                </button>
                                                @if ($project['show_in_front'] == 0)
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 1)">Show in Front
                                                    </button>
                                                @else
                                                    <button class="dropdown-item"
                                                        onclick="showProject('{{ $project['id'] }}', 0)">Remove From Front
                                                    </button>
                                                @endif
                                                
                                            </div>
                                        </div>
                                        <input type="hidden" name="projectId" id="projectId"
                                            value="{{ $project['id'] }}">
                                        <h3 class="widget-user-username ">
                                            <a
                                                href="{{ route('project.details.view', $project['id']) }}">{{ $project['name'] }}</a>
                                        </h3>
                                        <h5 class="widget-user-desc">{{ $project['location'] }}</h5>

                                    </div>

                                    <div class="card-body p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Phase Number <span
                                                        class="float-right badge bg-primary">{{ $project['phase_number'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Upcoming Deadlines <span
                                                        class="float-right badge bg-info">{{ $project['phase_complete_date'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Project Value <span class="float-right badge bg-success"
                                                        id='totalProjectValue'>{{ $project['project_value'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Total Paid Amount <span class="float-right badge bg-danger"
                                                        id='totalPaidAmount'>{{ $project['paid_amount'] }}</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-dark">
                                                    Due Amount
                                                    @if ((int) $project['project_value'] - (int) $project['paid_amount'] <= 0)
                                                        <span
                                                            class="float-right badge bg-success ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}

                                                        </span>
                                                    @elseif ((int) $project['project_value'] - (int)
                                                        $project['paid_amount'] > 0)
                                                        <span
                                                            class="float-right badge bg-danger ">{{ (int) $project['project_value'] - (int) $project['paid_amount'] }}
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->

        <div class="card-footer">

        </div>
    </div>

    {{-- modal --}}


    {{-- add project modal --}}
    <div class="modal fade" id="addProjectModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Project</h4>
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Company</label>
                                <select id="addCompany" class="form-control" name="addCompany">
                                    <option value="null" selected disabled>--Select A Company--</option>

                                    @foreach ($companys as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name" name="addProjectName"
                                    id="addProjectName" required><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Location</label>
                                <input type="text" class="form-control" placeholder="Project Location"
                                    name="addProjectLocation" id="addProjectLocation" required><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Value</label>
                                <input type="text" class="form-control" placeholder="Project Values" name="addProjectValue"
                                    id="addProjectValue" required
                                    onkeyup="getStanderdDays('perDayCost', 'addStandardDays')"><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Standard Days</label>
                                <input type="text" class="form-control" placeholder="Standard Days" name="addStandardDays"
                                    id="addStandardDays" required readonly><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Contract Sign Date</label>
                                <div class="input-group date" id="addContractSignDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#addContractSignDateDiv" id="addContractSignDate" readonly />
                                    <div class="input-group-append" data-target="#addContractSignDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Starting Date</label>
                                <div class="input-group date" id="addStartingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#addStartingDateDiv" id="addStartingDate" />
                                    <div class="input-group-append" data-target="#addStartingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Duration</label>
                                <input type="text" class="form-control" placeholder="Project Duration"
                                    name="addProjectDuration" id="addProjectDuration" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Finishing Date</label>
                                <div class="input-group date" id="addFinishingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#addFinishingDateDiv" id="addFinishingDate" />
                                    <div class="input-group-append" data-target="#addFinishingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Hours of Work</label>
                                <input type="text" class="form-control" placeholder="Total Hours of Work"
                                    name="addTotalHours" id="addTotalHours" required><br>
                            </div>
                        </div>
                    </div>
                    <!-- Date -->

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveProject()">Save</button>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- add Project Modal -->

    {{-- edit status --}}
    <div class="modal fade" id="editProjectStatusModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Project Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForEditStatus">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name" name="showProjectName"
                                    id="showProjectName" required readonly><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Status</label>
                                <select id="editStatus" class="form-control" name="editStatus">
                                    <option value="null" selected disabled>--Select A Status--</option>
                                    <option value="1">Input</option>
                                    <option value="2">On Going</option>
                                    <option value="3">Hold</option>
                                    <option value="4">Completed</option>
                                    <option value="5">Canceled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Date -->

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateStatus()">Save</button>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>

    {{-- edit project modal --}}
    <div class="modal fade" id="editProjectModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Project</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForEdit">

                        </div>
                    </div>
                    <input type="hidden" name="editProjectId" id="editProjectId" value="0">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Select Company</label>
                                <select id="editCompany" class="form-control" name="editCompany">
                                    <option value="null" selected disabled>--Select A Company--</option>

                                    @foreach ($companys as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name" name="editProjectName"
                                    id="editProjectName" required><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Location</label>
                                <input type="text" class="form-control" placeholder="Project Location"
                                    name="editProjectLocation" id="editProjectLocation" required><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Value</label>
                                <input type="text" class="form-control" placeholder="Project Values" name="editProjectValue"
                                    id="editProjectValue" required
                                    onkeyup="getStanderdDays('perDayCost', 'editStandardDays')"><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Standard Days</label>
                                <input type="text" class="form-control" placeholder="Standard Days" name="editStandardDays"
                                    id="editStandardDays" required readonly><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Contract Sign Date</label>
                                <div class="input-group date" id="editContractSignDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#editContractSignDateDiv" id="editContractSignDate" readonly />
                                    <div class="input-group-append" data-target="#editContractSignDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Starting Date</label>
                                <div class="input-group date" id="editStartingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#editStartingDateDiv" id="editStartingDate" readonly />
                                    <div class="input-group-append" data-target="#editStartingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Project Duration</label>
                                <input type="text" class="form-control" placeholder="Project Duration"
                                    name="editProjectDuration" id="editProjectDuration" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Finishing Date</label>
                                <div class="input-group date" id="editFinishingDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#editFinishingDateDiv" id="editFinishingDate" readonly />
                                    <div class="input-group-append" data-target="#editFinishingDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Total Hours of Work</label>
                                <input type="text" class="form-control" placeholder="Total Hours of Work"
                                    name="editTotalHours" id="editTotalHours" required><br>
                            </div>
                        </div>
                    </div>
                    <!-- Date -->

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateProject()">Save</button>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- edit Project Modal -->



    {{-- edit status --}}
@endsection


@section('extra-js')
    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            //Date picker
            $('#addContractSignDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            //Date picker
            $('#addStartingDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $('#addFinishingDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            //Date picker
            $('#editContractSignDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            //Date picker
            $('#editStartingDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $('#editFinishingDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });

            //$('.datetimepicker-input').attr('readonly', true);
        });



        function saveProject() {
            showPreloader();
            var company = $('#addCompany').val();
            var name = $('#addProjectName').val();
            var location = $('#addProjectLocation').val();
            var value = $('#addProjectValue').val();
            var day = $('#addStandardDays').val();
            var sign_date = $('#addContractSignDate').val();
            var start_date = $('#addStartingDate').val();
            var project_duration = $('#addProjectDuration').val();
            var finish_date = $('#addFinishingDate').val();
            var total_hours_of_work = $('#addTotalHours').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                method: "POST",
                url: "{{ route('project.save') }}",
                data: {
                    company: company,
                    name: name,
                    location: location,
                    value: value,
                    day: day,
                    sign_date: sign_date,
                    start_date: start_date,
                    project_duration: project_duration,
                    finish_date: finish_date,
                    total_hours_of_work: total_hours_of_work,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Project has been Added Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        window.location.reload();
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

        function getStanderdDays(name, idToView) {
            $.get("/extra/" + name, function(extra) {
                $('#' + idToView).val($('#addProjectValue').val() / extra.value);
            });
        }

        function promtEditStatus(projectId, projectName, projectStatus) {
            showPreloader();

            $('#projectId').val(projectId);
            $('#showProjectName').val(projectName);
            $('#editStatus').val(projectStatus);
            $('#editProjectStatusModal').modal('show');
            hidePreloader();
        }

        function updateStatus() {
            showPreloader();
            var id = $('#projectId').val();
            var status = $('#editStatus').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "POST",
                url: "{{ route('projectstatus.update') }}",
                data: {
                    id: id,
                    status: status,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Project Status has been Edited Successfully',
                            showConfirmButton: false,
                            timer: 1500
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
                    $("#errorDivForEditStatus").empty();
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errorDivForEditStatus").append("<li class='alert alert-danger'>" + item +
                            "</li>")
                    });

                }

            });
        }

        function editPromt(id) {

            showPreloader();
            $("#errorDivForEdit").empty();

            $.get("project-management/details/" + id, function(project) {

                $('#editProjectId').val(project.id);
                $('#editCompany').val(project.company_id);
                $('#editProjectName').val(project.name);
                $('#editProjectLocation').val(project.project_location);
                $('#editProjectValue').val(project.project_value);
                $('#editStandardDays').val(project.standard_days);
                $("#editContractSignDate").val(project.contract_sign_date.slice(0, 10));
                $('#editStartingDate').val(project.starting_date.slice(0, 10));
                $('#editProjectDuration').val(project.project_duration);
                $('#editFinishingDate').val(project.finishing_date.slice(0, 10));
                $('#editTotalHours').val(project.total_hours_of_work);
                $('#editProjectModal').modal('show');
                hidePreloader();
            });
        }

        function updateProject() {

            showPreloader();

            var id = $('#editProjectId').val();
            var company_id = $('#editCompany').val();
            var name = $('#editProjectName').val();
            var project_location = $('#editProjectLocation').val();
            var project_value = $('#editProjectValue').val();
            var standard_days = $('#editStandardDays').val();
            var contract_sign_date = $('#editContractSignDate').val();
            var starting_date = $('#editStartingDate').val();
            var project_duration = $('#editProjectDuration').val();
            var finishing_date = $('#editFinishingDate').val();
            var total_hours_of_work = $('#editTotalHours').val();
            var _token = $('input[name=_token]').val();
            $.ajax({
                method: "PUT",
                url: "{{ route('project.update') }}",
                data: {
                    id: id,
                    company: company_id,
                    name: name,
                    location: project_location,
                    value: project_value,
                    day: standard_days,
                    sign_date: contract_sign_date,
                    start_date: starting_date,
                    project_duration: project_duration,
                    finish_date: finishing_date,
                    total_hours_of_work: total_hours_of_work,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        hidePreloader();
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Project has been Updated Successfully',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        location.reload();
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

        function deleteProject(id) {
            if (confirm("Do You Really Want To Delete The Project ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('project.delete') }}",
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response) {
                        if (response) {
                            hidePreloader();
                            swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Project has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                        }
                    }
                });
            }
        }

        function showProject(id, showInWebsite) {

            if (showInWebsite == 0) {
                var alertText = "Do You Want To Remove This Project From Website ?";

                if (confirm(alertText)) {

                    showPreloader();
                    var _token = $('input[name=_token]').val();
                    $.ajax({
                        method: "POST",
                        url: "{{ route('project.to.show') }}",
                        data: {
                            id: id,
                            show_in_website: showInWebsite,
                            _token: _token
                        },
                        success: function(response) {
                            if (response) {
                                hidePreloader();
                                swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Project has been removed Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                location.reload();
                            }
                        }
                    });
                }
            } else {
                var alertText = "Do You Really Want To Show The Project in Website ?";

                if (confirm(alertText)) {

                    showPreloader();
                    var _token = $('input[name=_token]').val();
                    $.ajax({
                        method: "POST",
                        url: "{{ route('project.to.show') }}",
                        data: {
                            id: id,
                            show_in_website: showInWebsite,
                            _token: _token
                        },
                        success: function(response) {
                            if (response) {
                                hidePreloader();
                                swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Project has been Showed Successfully',
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                location.reload();
                            }
                        }
                    });
                }
            }
        }
        


        function clearAddModal() {
            $('#addProjectName').val('');
            $('#addProjectValue').val('');
            $('#addCompany').val('');
            $('#addProjectName').val('');
            $('#addProjectLocation').val('');
            $('#addProjectValue').val('');
            $('#addStandardDays').val('');
            $("#addContractSignDate").val('');
            $('#addStartingDate').val('');
            $('#addProjectDuration').val('');
            $('#addFinishingDate').val('');
            $('#addTotalHours').val('');
            $("#errorDivForAdd").empty();
        }
    </script>
@endsection
