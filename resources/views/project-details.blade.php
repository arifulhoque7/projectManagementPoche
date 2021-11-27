@extends('layouts.master')

@section('title', 'Project Details')
{{-- @section('page-name', 'Project Details') --}}

@section('extra-css')
    <style>


    </style>
@endsection


@section('main-content')


    {{-- @php
foreach ($payments as $payment) {
    print_r($payment);
}
@endphp --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card card-widget widget-user">
                <div class="card-header bg-dark">
                    <a href="{{ route('phase.details.file.view') }}/{{ $projects['id'] }}"><i class="far fa-file fa-2x float-right ml-2 mt-3" ></i></a>
                    <i class="fas fa-trash-alt fa-lg float-right ml-2 mt-4 "></i>
                    <i class="fas fa-plus-square  fa-lg float-right mt-4"
                        onclick="promtAddPhase(' {{ $projects['company_id'] }}', '{{ $projects['company_name'] }}',  '{{ $projects['id'] }}', '{{ $projects['name'] }}')"></i>
                    

                    <h2 class="text-center">{{ $projects['name'] }}</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $projects['project_location'] }}</h5>
                                <span class="description-text">
                                    <a
                                        href="{{ route('project.view') }}/{{ $projects['company_id'] }}">{{ $projects['company_name'] }}</a>
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $projects['starting_date'] }}</h5>
                                <span class="description-text">Starting Date</span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">{{ $projects['finishing_date'] }}</h5>
                                <span class="description-text">Expected Project Complete Date</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @foreach ($phases as $phase)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-bold">{{ $phase['name'] }} </h3>
                        <h3 class="card-title text-bold">Phase Complete Date:
                            {{ substr($phase['expected_complete_date'], 0, 10) }} | Phase Value:
                            {{ $phase['milestone_value'] }} </h3>
                            
                        <i class="fas fa-file-medical fa-2x float-right ml-2 " onclick="promtaddPhaseFiles('{{ $phase['company_id'] }}','{{ $phase['project_id'] }}','{{ $phase['id'] }}','{{ $phase['name'] }}')"></i>

                        <i class="fas fa-trash-alt fa-lg float-right ml-2 mt-2"
                            onclick="deletePhase('{{ $phase['id'] }}')"></i>
                        <i class="fas fa-plus-square  fa-lg float-right mt-2 "
                            onclick="promtAddPhaseDetails(' {{ $projects['company_id'] }}', '{{ $projects['company_name'] }}',  '{{ $projects['id'] }}', '{{ $projects['name'] }}','{{ $phase['id'] }}','{{ $phase['name'] }}')"></i>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Phase Details Name</th>
                                    <th>Expected Complete Date</th>
                                    <th>Phase Value</th>
                                    {{-- <th>Files</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $phaseDetailsArrayName = 'pd' . $phase['id'];
                                    
                                @endphp
                                @if (count($phaseDetails[$phaseDetailsArrayName]) > 0)
                                    @foreach ($phaseDetails[$phaseDetailsArrayName] as $phaseDetail)
                                        <tr>
                                            <td>{{ $phaseDetail['name'] }}</td>
                                            <td>{{ substr($phaseDetail['expected_complete_date'], 0, 10) }}</td>
                                            <td>{{ $phaseDetail['milestone_value'] }}</td>
                                            {{-- <td>
                                                <button type="button" class="btn btn-outline-primary btn-flat"
                                                    ><i
                                                        class="far fa-file ml-1"></i> Add file</button>
                                            </td> --}}
                                            <td>
                                                <i class="fas fa-trash-alt fa-lg ml-2" style='color: rgb(255, 0, 0)'
                                                    onclick="deletePhaseDetails('{{ $phaseDetail['id'] }}')"></i>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center">No Phase Details Found !!</td>
                                    </tr>
                                @endif


                            </tbody>

                            {{-- <tfoot>
                        <tr>
                            <th>Total</th>
                            <th>Total phase Details</th>
                            <th></th>
                            <th>Total Phase Value</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- @foreach ($phases as $phase) --}}
    @if ($phases->count() != null)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title text-bold">Payment Details</h2>
                        {{-- <i class="fas fa-trash-alt fa-lg float-right ml-2"></i> --}}
                        <i class="fas fa-plus-square  fa-lg float-right "
                            onclick="promtAddPaymentDetails(' {{ $projects['company_id'] }}', '{{ $projects['company_name'] }}',  '{{ $projects['id'] }}', '{{ $projects['name'] }}','{{ $phase['id'] }}')"></i>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Phase Name</th>
                                    <th>Payment Method</th>
                                    <th>Received By</th>
                                    <th>Payment Date</th>
                                    <th>Paid Amount</th>
                                    <th>Due Before Payment</th>
                                    <th>Due After Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @php
                                $count = 0;
                            @endphp
                            <tbody>
                                @foreach ($phases as $phase)
                                    @php
                                        $phasePaymentArrayName = 'pay' . $phase['id'];
                                    @endphp
                                    @if (count($payments[$phasePaymentArrayName]) > 0)
                                        @foreach ($payments[$phasePaymentArrayName] as $payment)
                                            <tr>
                                                <td>{{ $payment['phase_name'] }}</td>
                                                <td>{{ $payment['payment_method'] }}</td>
                                                <td>{{ $payment['received_by'] }}</td>
                                                <td>{{ $payment['payment_date'] }}</td>
                                                <td>{{ $payment['paid_amount'] }}</td>
                                                <td>{{ $payment['due_before_payment'] }}</td>
                                                <td>{{ $payment['due_after_payment'] }}</td>
                                                <td>
                                                    <i class="fas fa-trash-alt fa-lg ml-2" style='color: rgb(255, 0, 0)'
                                                        onclick="deletePayment('{{ $payment['id'] }}')"></i>
                                                </td>
                                            </tr>
                                            @php
                                                $count = 1;
                                            @endphp
                                        @endforeach
                                    @endif
                                @endforeach

                                @if (count($payments[$phasePaymentArrayName]) <= 0 && $count == 0)
                                    <tr>
                                        <td colspan="12" class="text-center">No Payment Details Found !!</td>
                                    </tr>
                                @endif

                            </tbody>
                            {{-- <tfoot>
                    <tr>
                        <th>Number of Payment</th>
                        <th>Total Details Details</th>
                        <th></th>
                        <th>Total Paid Amount</th>
                        <th>Total Due Amount</th>
                        <th></th>
                    </tr>
                </tfoot> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endif

    <!-- add Phase Modal -->
    <div class="modal fade" id="addPhaseModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Phase</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" name="addPhaseProjectId" id="addPhaseProjectId">
                    <input type="hidden" name="addPhaseCompanyId" id="addPhaseCompanyId">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForAdd">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" placeholder="Company Name"
                                    name="addPhaseCompanyName" id="addPhaseCompanyName" readonly><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name"
                                    name="addPhaseProjectName" id="addPhaseProjectName" readonly><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phase Name</label>
                                <input type="text" class="form-control" placeholder="Phase Name" name="addPhaseName"
                                    id="addPhaseName" required><br>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Expected Complete Date</label>
                                <div class="input-group date" id="expectedCompletedDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#expectedCompletedDateDiv" id="addPhaseExpectedCompletedDate" />
                                    <div class="input-group-append" data-target="#expectedCompletedDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Milestone Value</label>
                                <input type="text" class="form-control" placeholder="Milestone Value"
                                    name="addMilestoneValue" id="addMilestoneValue" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="savePhase()">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- add Phase Modal -->

    <!-- add Phase Details Modal -->
    <div class="modal fade" id="addPhaseDetailsModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Phase Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" name="addPhaseDetailsProjectId" id="addPhaseDetailsProjectId">
                    <input type="hidden" name="addPhaseProjectCompanyId" id="addPhaseProjectCompanyId">
                    <input type="hidden" name="addPhaseDetailsId" id="addPhaseDetailsId">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForAddDetails">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" placeholder="Company Name"
                                    name="addPhaseDetailsCompanyName" id="addPhaseDetailsCompanyName" readonly><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name"
                                    name="addPhaseDetailsProjectName" id="addPhaseDetailsProjectName" readonly><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phase Name</label>
                                <input type="text" class="form-control" placeholder="Phase Name"
                                    name="addPhaseDetailsPhaseName" id="addPhaseDetailsPhaseName" readonly><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phase Details Name</label>
                                <input type="text" class="form-control" placeholder="Phase Details Name"
                                    name="addPhaseDetailsName" id="addPhaseDetailsName" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Expected Complete Date</label>
                                <div class="input-group date" id="expectedPhaseDetailsExpectedCompletedDateDiv"
                                    data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#expectedPhaseDetailsExpectedCompletedDateDiv"
                                        id="addPhaseDetailsExpectedCompletedDate" />
                                    <div class="input-group-append"
                                        data-target="#expectedPhaseDetailsExpectedCompletedDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Milestone Value</label>
                                <input type="text" class="form-control" placeholder="Milestone Value"
                                    name="addPhaseDetailsMilestoneValue" id="addPhaseDetailsMilestoneValue" required><br>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="savePhaseDetails()">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- add Phase Details Modal -->


    <!-- add Payment Details Modal -->
    <div class="modal fade" id="addPaymentDetailsModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Payment Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <input type="hidden" name="addPaymentDetailsProjectId" id="addPaymentDetailsProjectId">
                    <input type="hidden" name="addPaymentDetailsCompanyId" id="addPaymentDetailsCompanyId">
                    <input type="hidden" name="addPaymentDetailsPhaseId" id="addPaymentDetailsPhaseId">
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" id="errorDivForAddPaymentDetails">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Select Payment Method</label>
                                <select id="addMethod" class="form-control" name="addMethod"
                                    onchange="paymentMethodSelected(this.value)">
                                    <option value="null" selected disabled>--Select A Method--</option>

                                    @foreach ($PaymentsMethodsDetails as $PaymentsMethodsDetail)
                                        <option value="{{ $PaymentsMethodsDetail->id }}">
                                            {{ $PaymentsMethodsDetail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phase Name</label>
                                <select id="addPhaseName" class="form-control" name="addPhaseName">
                                    <option value="null" selected disabled>--Select A Phase--</option>

                                    @foreach ($phases as $phase)
                                        <option value="{{ $phase->id }}">{{ $phase->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Received By</label>
                                <select id="addPaymentDetailsReceivedBy" class="form-control"
                                    name="addPaymentDetailsReceivedBy">
                                    <option value="null" selected disabled>--Select Receiver--</option>
                                    @foreach ($AdminDetails as $AdminDetail)
                                        <option value="{{ $AdminDetail->id }}">{{ $AdminDetail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" placeholder="Company Name"
                                    name="addPaymentDetailsCompanyName" id="addPaymentDetailsCompanyName" readonly><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <input type="text" class="form-control" placeholder="Project Name"
                                    name="addPaymentDetailsProjectName" id="addPaymentDetailsProjectName" readonly><br>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Date and time -->
                            <div class="form-group">
                                <label>Payment Date</label>
                                <div class="input-group date" id="PaymentDateDiv" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#PaymentDateDiv" id="PaymentDate" />
                                    <div class="input-group-append" data-target="#PaymentDateDiv"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Paid Amount</label>
                                <input type="text" class="form-control" placeholder="Paid Amount"
                                    name="addPaymentDetailsPaidAmount" id="addPaymentDetailsPaidAmount" required
                                    onkeyup="getPaymentData('{{ $projects['company_id'] }}')"><br>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Due Before Payment</label>
                                <input type="text" class="form-control" placeholder="Due Before Payment"
                                    name="dueBeforePayment" id="dueBeforePayment" readonly><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Due After Payment</label>
                                <input type="text" class="form-control" placeholder="Due After Payment"
                                    name="dueAfterPayment" id="dueAfterPayment" readonly><br>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="chequeDiv">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cheque Bank</label>
                                <input type="text" class="form-control" placeholder="Cheque Bank" name="chequeBank"
                                    id="chequeBank" value="0"><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cheque Number</label>
                                <input type="text" class="form-control" placeholder="Cheque Number" name="chequeNumber"
                                    id="chequeNumber" value="0"><br>
                            </div>
                        </div>
                    </div>


                    <div class="row" id="cardDiv">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control" placeholder="Card Number" name="cardNumber"
                                    id="cardNumber" value="0"><br>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="sslDiv">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Transaction Number</label>
                                <input type="text" class="form-control" placeholder="Transaction Number"
                                    name="transactionNumber" id="transactionNumber" value="0"><br>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="savePayment()">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- add Payment Details Modal -->





    <!-- add Phase Details FIles Modal -->
    <div class="modal fade" id="addPhaseFilesModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Phase Files</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12" id="errorDivForaddPhaseFiles">

                        </div>
                    </div>
                    <form method="post" id="upload-image-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="company_id" id="addPhaseFilesCompanyId">
                        <input type="hidden" name="project_id" id="addPhaseFilesProjectId">
                        <input type="hidden" name="phase_id" id="addPhaseFilesPhaseId">
                        <input type="hidden" name="phase_details_id" id="addPhaseFilesPhaseDetailsId">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Phase Name</label>
                                    <input type="text" class="form-control" placeholder="Phase Name"
                                        name="addPhaseFilesPhaseName" id="addPhaseFilesPhaseName"
                                        readonly><br>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Upload File
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        {{-- <form method="POST" enctype="multipart/form-data" class="dropzone dz-clickable" --}}
                                        {{-- id="image-upload" action="{{ route('file.upload') }}"> --}}

                                        <input type="file" name="file">

                                        {{-- <span  class="dropzone dz-clickable">
                                        <div>
                                            <h3 class="text-center text-muted">Upload Image By Click Here</h3>
                                        </div>
                                        <div class="dz-default dz-message text-muted">
                                            <span>Drop files here to upload</span>
                                        </div>
                                    </span> --}}
                                        {{-- </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                        <div class="col-md-12">
                            <div id="main">
                                <div id="header">
                                    <h3>Drag & Drop Upload Files Using Dropzone With PHP</h1>
                                </div>
                                <div id="content">
                                    <form class="dropzone" id="file_upload"></form>
                                    <button id="upload_btn">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
    <!-- add Phase  Details  File Modal -->


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
            $('#expectedCompletedDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            //Date picker
            $('#expectedPhaseDetailsExpectedCompletedDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });
            $('#PaymentDateDiv').datetimepicker({
                format: 'YYYY/MM/DD'
            });

            $('#chequeDiv').hide();
            $('#cardDiv').hide();
            $('#sslDiv').hide();



        });

        function promtAddPhase(companyId, companyName, projectId, projectName) {
            showPreloader();
            $('#addPhaseCompanyId').val(companyId);
            $('#addPhaseCompanyName').val(companyName);
            $('#addPhaseProjectId').val(projectId);
            $('#addPhaseProjectName').val(projectName);
            $('#addPhaseModal').modal('show');
            hidePreloader();
        }


        function savePhase() {
            showPreloader();
            var company_id = $('#addPhaseCompanyId').val();
            var project_id = $('#addPhaseProjectId').val();
            var name = $('#addPhaseName').val();
            var expected_complete_date = $('#addPhaseExpectedCompletedDate').val();
            var milestone_value = $('#addMilestoneValue').val();
            var _token = $('input[name=_token]').val();


            $.ajax({
                method: "POST",
                url: "{{ route('phase.save') }}",
                data: {
                    company_id: company_id,
                    project_id: project_id,
                    name: name,
                    expected_complete_date: expected_complete_date,
                    milestone_value: milestone_value,
                    _token: _token
                },
                success: function(response) {

                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Phase has been Added Successfully',
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

        function promtAddPhaseDetails(companyId, companyName, projectId, projectName, PhaseId, PhaseName) {
            showPreloader();
            $('#addPhaseProjectCompanyId').val(companyId);
            $('#addPhaseDetailsCompanyName').val(companyName);
            $('#addPhaseDetailsProjectId').val(projectId);
            $('#addPhaseDetailsProjectName').val(projectName);
            $('#addPhaseDetailsId').val(PhaseId);
            $('#addPhaseDetailsPhaseName').val(PhaseName);
            $('#addPhaseDetailsModal').modal('show');
            hidePreloader();
        }

        function savePhaseDetails() {
            showPreloader();
            var company_id = $('#addPhaseProjectCompanyId').val();
            var project_id = $('#addPhaseDetailsProjectId').val();
            var phase_id = $('#addPhaseDetailsId').val();
            var name = $('#addPhaseDetailsName').val();
            var expected_complete_date = $('#addPhaseDetailsExpectedCompletedDate').val();
            var milestone_value = $('#addPhaseDetailsMilestoneValue').val();
            var _token = $('input[name=_token]').val();


            $.ajax({
                method: "POST",
                url: "{{ route('phase.compare.milestone') }}",
                data: {
                    phaseId: phase_id,
                    milestoneValue: milestone_value,
                    _token: _token
                },
                success: function(response) {
                    if (response) {
                        $.ajax({
                            method: "POST",
                            url: "{{ route('phase.details.save') }}",
                            data: {
                                company_id: company_id,
                                project_id: project_id,
                                phase_id: phase_id,
                                name: name,
                                expected_complete_date: expected_complete_date,
                                milestone_value: milestone_value,
                                _token: _token
                            },
                            success: function(response) {

                                if (response) {
                                    swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Phase Details has been Added Successfully',
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
                                $("#errorDivForAddDetails").empty();
                                $.each(xhr.responseJSON.errors, function(key, item) {
                                    $("#errorDivForAddDetails").append(
                                        "<li class='alert alert-danger'>" + item +
                                        "</li>")
                                });
                            }
                        });
                    } else {
                        hidePreloader();
                        $("#errorDivForAddDetails").empty();
                        $("#errorDivForAddDetails").append(
                            "<li class='alert alert-danger'>The Phase Details Milestone Value summation can't Be Gretear than Phase Value !</li>"
                        )
                    }
                },
                error: function(xhr, status, error) {
                    hidePreloader();
                    $("#errorDivForAddDetails").empty();
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errorDivForAddDetails").append("<li class='alert alert-danger'>" + item +
                            "</li>")
                    });
                }
            });

        }


        function deletePhase(id) {
            if (confirm("Do You Really Want To Delete The Phase ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('phase.delete') }}",
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

        function deletePhaseDetails(id) {
            if (confirm("Do You Really Want To Delete The Phase Details ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('phase.details.delete') }}",
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
                                title: 'Phase Details  has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                        }
                    }
                });
            }
        }

        function getPaymentData(id) {
            $.get("/company-management/details/" + id, function(company) {
                var dueBeforePayment = parseFloat(company.total_projects_value) - parseFloat(company
                    .total_paid_amount);
                var dueAfterPayment = parseFloat(company.total_projects_value) - parseFloat(company
                    .total_paid_amount) - parseFloat($('#addPaymentDetailsPaidAmount').val());
                $('#dueBeforePayment').val(dueBeforePayment);
                $('#dueAfterPayment').val(dueAfterPayment);
            });
        }

        function promtAddPaymentDetails(companyId, companyName, projectId, projectName, PhaseId) {
            showPreloader();
            $('#addPaymentDetailsCompanyId').val(companyId);
            $('#addPaymentDetailsCompanyName').val(companyName);
            $('#addPaymentDetailsProjectId').val(projectId);
            $('#addPaymentDetailsProjectName').val(projectName);
            $('#addPaymentDetailsPhaseId').val(PhaseId);
            $('#addPaymentDetailsModal').modal('show');
            hidePreloader();
        }


        function paymentMethodSelected(paymentMethodId) {
            if (paymentMethodId == 1) {
                $('#chequeDiv').show();
                $('#sslDiv').hide();
                $('#cardDiv').hide();
            } else if (paymentMethodId == 2) {
                $('#chequeDiv').hide();
                $('#sslDiv').hide();
                $('#cardDiv').show();
            } else if (paymentMethodId == 3) {
                $('#chequeDiv').hide();
                $('#sslDiv').show();
                $('#cardDiv').hide();
            }
        }

        function savePayment() {
            showPreloader();
            var payment_methods_id = $('#addMethod').val();
            var company_id = $('#addPaymentDetailsCompanyId').val();
            var project_id = $('#addPaymentDetailsProjectId').val();
            var phase_id = $('#addPaymentDetailsPhaseId').val();
            var received_by = $('#addPaymentDetailsReceivedBy').val();
            var payment_date = $('#PaymentDate').val();
            var paid_amount = $('#addPaymentDetailsPaidAmount').val();
            var due_before_payment = $('#dueBeforePayment').val();
            var due_after_payment = $('#dueAfterPayment').val();
            var cheque_number = $('#chequeBank').val();
            var cheque_bank = $('#chequeNumber').val();
            var card_number = $('#cardNumber').val();
            var transaction_number = $('#transactionNumber').val();
            var _token = $('input[name=_token]').val();

            $.ajax({
                method: "POST",
                url: "{{ route('payment.save') }}",
                data: {
                    payment_methods_id: payment_methods_id,
                    company_id: company_id,
                    project_id: project_id,
                    phase_id: phase_id,
                    received_by: received_by,
                    payment_date: payment_date,
                    paid_amount: paid_amount,
                    due_before_payment: due_before_payment,
                    due_after_payment: due_after_payment,
                    cheque_number: cheque_number,
                    cheque_bank: cheque_bank,
                    card_number: card_number,
                    transaction_number: transaction_number,
                    _token: _token
                },
                success: function(response) {

                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Payment has been Added Successfully',
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
                    $("#errorDivForAddPaymentDetails").empty();
                    $.each(xhr.responseJSON.errors, function(key, item) {
                        $("#errorDivForAddPaymentDetails").append("<li class='alert alert-danger'>" +
                            item + "</li>")
                    });
                }
            });
        }

        function deletePayment(id) {
            if (confirm("Do You Really Want To Delete The Payment ?")) {

                showPreloader();
                var _token = $('input[name=_token]').val();
                $.ajax({
                    method: "PUT",
                    url: "{{ route('payment.delete') }}",
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
                                title: 'Payment has been Deleted Successfully',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            location.reload();
                        }
                    }
                });
            }
        }

        function promtaddPhaseFiles(CompanyId, ProjectId, PhaseId, PhaseName) {
            showPreloader();
            $('#addPhaseFilesCompanyId').val(CompanyId);
            $('#addPhaseFilesProjectId').val(ProjectId);
            $('#addPhaseFilesPhaseId').val(PhaseId);
            $('#addPhaseFilesPhaseName').val(PhaseName);
            $('#addPhaseFilesModal').modal('show');
            hidePreloader();
        }

        $('#upload-image-form').submit(function(e) {
            e.preventDefault();
            showPreloader();
            let formData = new FormData(this);
            $('#errorDivForaddPhaseFiles').text('');

            $.ajax({
                type: 'POST',
                url: "{{ route('phase.details.file.save') }}",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    if (response) {
                        swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Phase File has been Added Successfully!',
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
                error: function(response) {
                    console.log(response);
                    $('#errorDivForaddPhaseFiles').text(response.responseJSON.errors.file);
                }
            });
        });
    </script>
@endsection
