<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\CompanyModal;
use App\Models\PaymentMethodModal;
use App\Models\PaymentModal;
use App\Models\PhaseDetailsModal;
use App\Models\PhaseModal;
use App\Models\ProjectModal;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function index($companyId = null)
    {

        $extraVariables = array();
        if ($companyId == null) {
            $tempProjects = ProjectModal::where([
                ['status', '>', 0]
            ])->orderBy('id', 'ASC')->get();

            $extraVariables['pageName'] = "All Projects";
        } else {
            $tempProjects = ProjectModal::where([
                ['status', '>', 0],
                ['company_id', '=', $companyId]
            ])->orderBy('id', 'ASC')->get();

            $companyDetails = CompanyModal::find($companyId);
            $extraVariables['pageName'] = "Projects From " . $companyDetails->name;
        }
        $projects = array();
        $tempValue = array();
        $inputProjects = array();
        $onGoingProjects = array();
        $completedProjects = array();
        $holdProjects = array();
        $canceledProjects = array();
        $deletedProjects = array();
        foreach ($tempProjects as $tempProject) {

            $tempValue['id'] = $tempProject->id;
            $tempValue['name'] = $tempProject->name;
            $tempValue['location'] = $tempProject->project_location;

            $phaseDetails = PhaseModal::where([
                ['status', '=', 1],
                ['project_id', '=', $tempProject->id]
            ])->orderBy('expected_complete_date', 'ASC')->get();

            $tempValue['phase_number'] = count($phaseDetails);
            if (count($phaseDetails) > 0) {
                $tempValue['phase_complete_date'] =  substr($phaseDetails[0]->expected_complete_date, 0, 10);
            } else {
                $tempValue['phase_complete_date'] =  "N/A";
            }

            $tempValue['project_value'] = $tempProject->project_value;
            $tempValue['paid_amount'] = round(PaymentModal::where([
                ['status', '=', 1],
                ['project_id', '=', $tempProject->id]
            ])->sum('paid_amount'));

            $tempValue['status'] = $tempProject->status;
            $tempValue['show_in_front'] = $tempProject->show_in_front;

            if ($tempProject->status == 1) {
                array_push($inputProjects, $tempValue);
            } elseif ($tempProject->status == 2) {
                array_push($onGoingProjects, $tempValue);
            } elseif ($tempProject->status == 3) {
                array_push($holdProjects, $tempValue);
            } elseif ($tempProject->status == 4) {
                array_push($completedProjects, $tempValue);
            } elseif ($tempProject->status == 5) {
                array_push($canceledProjects, $tempValue);
            } else {
                array_push($deletedProjects, $tempValue);
            }
            array_push($projects, $tempValue);
        }

        $companys = CompanyModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        //return view('project', compact('extraVariables', 'companys', 'projects', 'inputProjects', 'onGoingProjects', 'holdProjects', 'completedProjects', 'canceledProjects', 'deletedProjects'));

        return response()->json([$extraVariables, $companys, $projects, $inputProjects, $onGoingProjects, $holdProjects, $completedProjects, $canceledProjects, $deletedProjects]);
    }

    function companyWiseManagement()
    {
        $tempCompanys = CompanyModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        $companys = array();
        $tempCompanysArray = array();

        foreach ($tempCompanys as $tempCompany) {
            $tempCompanysArray['id'] = $tempCompany->id;
            $tempCompanysArray['name'] = $tempCompany->name;
            $tempCompanysArray['address'] = $tempCompany->address;
            $tempCompanysArray['total_projects'] = $tempCompany->total_projects;
            $tempCompanysArray['total_projects_value'] = $tempCompany->total_projects_value;
            $tempCompanysArray['total_paid_amount'] = $tempCompany->total_paid_amount;
            $tempCompanysArray['created_at'] =  substr($tempCompany->created_at, 0, 10);
            array_push($companys, $tempCompanysArray);
        }
        return response()->json($companys);
        //return view('project-company', compact('companys'));
    }

    function addProject(Request $request)
    {
        $validateData = $request->validate([
            'company' => 'required ',
            'name' => 'required |unique:App\Models\ProjectModal,name',
            'location' => 'required',
            'value' => 'required',
            'day' => 'required',
            'sign_date' => 'required| date',
            'start_date' => 'required| date',
            'project_duration' => 'required',
            'finish_date' => 'required| date',
            'total_hours_of_work' => 'required'
        ]);

        $project = new ProjectModal();
        $project->company_id = $request->company;
        $project->name = $request->name;
        $project->project_location = $request->location;
        $project->project_value = $request->value;
        $project->standard_days = $request->day;
        $project->contract_sign_date = $request->sign_date;
        $project->starting_date = $request->start_date;
        $project->project_duration = $request->project_duration;
        $project->finishing_date = $request->finish_date;
        $project->total_hours_of_work = $request->total_hours_of_work;

        $project->save();

        $company = CompanyModal::find($request->company);

        $company->total_projects = $company->total_projects + 1;
        $company->total_projects_value = $company->total_projects_value + $request->value;

        $company->save();


        return response()->json($project);
    }

    function updateStatus(Request $request)
    {
        $validateData = $request->validate([
            'status' => 'required'
        ]);
        $statusToUpdate = ProjectModal::find($request->id);
        $statusToUpdate->status = $request->status;
        $statusToUpdate->save();

        return response()->json($statusToUpdate);
    }

    function projectDetails($id)
    {
        $tempProject = ProjectModal::find($id);

        $projects = array();

        $projects['id'] = $tempProject->id;
        $projects['name'] = $tempProject->name;
        $projects['project_location'] = $tempProject->project_location;
        $projects['project_value'] = $tempProject->project_value;
        $projects['standard_days'] = $tempProject->standard_days;
        $projects['contract_sign_date'] = $tempProject->contract_sign_date;
        $projects['starting_date'] = substr($tempProject->starting_date, 0, 10);
        $projects['project_duration'] = $tempProject->project_duration;
        $projects['finishing_date'] = substr($tempProject->finishing_date, 0, 10);
        $projects['total_hours_of_work'] = $tempProject->total_hours_of_work;
        $projects['created_at'] = $tempProject->created_at;
        $projects['created_by'] = $tempProject->created_by;
        $projects['deleted_at'] = $tempProject->deleted_at;
        $projects['deleted_by'] = $tempProject->deleted_by;

        $companyDetails = CompanyModal::find($tempProject->company_id);

        $projects['company_id'] = $companyDetails->id;
        $projects['company_name'] = $companyDetails->name;

        $phases = PhaseModal::where([
            ['status', '>', 0],
            ['project_id', '=', $tempProject->id]
        ])->orderBy('id', 'ASC')->get();


        $phaseDetails = array();
        $payments = array();
        //$tempPhaseDetailsArray = array();
        foreach ($phases as $tempPhase) {

            $nameConvention1 = 'pay' . $tempPhase->id;

            $tempPayments = PaymentModal::where([
                ['status', '>', 0],
                ['phase_id', '=', $tempPhase->id]
            ])->orderBy('id', 'ASC')->get();

            $payments[$nameConvention1] = array();
            $tempPaymentDetailsArray = array();

            if (count($tempPayments) > 0) {
                foreach ($tempPayments as $tempPayment) {
                    $tempPaymentDetailsArray['id'] = $tempPayment->id;

                    $receiverDetails = AdminModal::find($tempPayment->received_by);
                    $tempPaymentDetailsArray['received_by'] = $receiverDetails->name;
                    $tempPaymentDetailsArray['phase_name'] = $tempPhase->name;

                    $paymentMethodDetails = PaymentMethodModal::find($tempPayment->payment_methods_id);
                    $tempPaymentDetailsArray['payment_method'] = $paymentMethodDetails->name;

                    $tempPaymentDetailsArray['payment_date'] = substr($tempPayment->payment_date, 0, 10);
                    $tempPaymentDetailsArray['paid_amount'] = $tempPayment->paid_amount;
                    $tempPaymentDetailsArray['due_before_payment'] = $tempPayment->due_before_payment;
                    $tempPaymentDetailsArray['due_after_payment'] = $tempPayment->due_after_payment;


                    array_push($payments[$nameConvention1], $tempPaymentDetailsArray);
                }
            }

            $tempPhaseDetails = PhaseDetailsModal::where([
                ['status', '>', 0],
                ['phase_id', '=', $tempPhase->id]
            ])->orderBy('id', 'ASC')->get();

            $nameConvention = 'pd' . $tempPhase->id;

            $phaseDetails[$nameConvention] = array();

            if (count($tempPhaseDetails) > 0) {
                foreach ($tempPhaseDetails as $tempPhaseDetail) {
                    array_push($phaseDetails[$nameConvention], $tempPhaseDetail);
                }
            }
        }
        $PaymentsMethodsDetails = PaymentMethodModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        $AdminDetails = AdminModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();


        //return view('project-details', compact('projects', 'phases', 'phaseDetails', 'payments', 'PaymentsMethodsDetails','AdminDetails'));
        return response()->json([$projects, $phases, $phaseDetails, $payments, $PaymentsMethodsDetails, $AdminDetails]);
    }

    function detailsOfProject($id)
    {
        $project = ProjectModal::find($id);
        return response()->json($project);
    }

    function updateProject(Request $request)
    {

        $validateData = $request->validate([
            'company' => 'required',
            'name' => 'required',
            'location' => 'required',
            'value' => 'required',
            'day' => 'required',
            'sign_date' => 'required| date',
            'start_date' => 'required| date',
            'project_duration' => 'required',
            'finish_date' => 'required| date',
            'total_hours_of_work' => 'required'
        ]);
        $projectToUpdate = ProjectModal::find($request->id);

        $projectToUpdate->company_id = $request->company;
        $projectToUpdate->name = $request->name;
        $projectToUpdate->project_location = $request->location;
        $currentValue = $projectToUpdate->project_value;
        $updatedValue = $request->value;
        $projectToUpdate->project_value = $request->value;
        $projectToUpdate->standard_days = $request->day;
        $projectToUpdate->contract_sign_date = $request->sign_date;
        $projectToUpdate->starting_date = $request->start_date;
        $projectToUpdate->project_duration = $request->project_duration;
        $projectToUpdate->finishing_date = $request->finish_date;
        $projectToUpdate->total_hours_of_work = $request->total_hours_of_work;

        $projectToUpdate->save();

        $company = CompanyModal::find($request->company);

        $company->total_projects_value = $company->total_projects_value - $currentValue + $updatedValue;

        $company->save();

        return response()->json($projectToUpdate);
    }
    function deleteProject(Request $request)
    {
        $projectToDelete = ProjectModal::find($request->id);
        
        $projectToDelete->deleted_at = date('Y-m-d H:i:s');
        $projectToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $projectToDelete->status = 0;
        $projectToDelete->show_in_front = 0;

        $projectToDelete->save();

        return response()->json($projectToDelete);
    }

    function addPhase(Request $request)
    {
        $validateData = $request->validate([
            'company_id' => 'required',
            'project_id' => 'required',
            'name' => 'required',
            'expected_complete_date' => 'required| date',
            'milestone_value' => 'required| numeric',
        ]);

        $phase = new PhaseModal();

        $phase->company_id = $request->company_id;
        $phase->project_id = $request->project_id;
        $phase->name = $request->name;
        $phase->expected_complete_date = $request->expected_complete_date;
        $phase->milestone_value = $request->milestone_value;
        $phase->created_by = 1; //$request->session()->get('admin_id');

        $phase->save();

        return response()->json($phase);
    }

    function deletePhase(Request $request)
    {
        $phaseToDelete = PhaseModal::find($request->id);

        $phaseToDelete->deleted_at = date('Y-m-d H:i:s');
        $phaseToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $phaseToDelete->status = 0;

        $phaseToDelete->save();

        return response()->json($phaseToDelete);
    }

    function addPhaseDetails(Request $request)
    {

        $validateData = $request->validate([
            'company_id' => 'required',
            'project_id' => 'required',
            'phase_id' => 'required',
            'name' => 'required',
            'expected_complete_date' => 'required| date',
            'milestone_value' => 'required| numeric',
        ]);

        $phaseDetails = new PhaseDetailsModal();

        $phaseDetails->company_id = $request->company_id;
        $phaseDetails->project_id = $request->project_id;
        $phaseDetails->phase_id = $request->phase_id;
        $phaseDetails->name = $request->name;
        $phaseDetails->expected_complete_date = $request->expected_complete_date;
        $phaseDetails->milestone_value = $request->milestone_value;
        $phaseDetails->created_by = 1; //$request->session()->get('admin_id');

        $phaseDetails->save();
        return response()->json($phaseDetails);
    }

    function deletePhaseDetails(Request $request)
    {
        $phaseDetailsToDelete = PhaseDetailsModal::find($request->id);

        $phaseDetailsToDelete->deleted_at = date('Y-m-d H:i:s');
        $phaseDetailsToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $phaseDetailsToDelete->status = 0;

        $phaseDetailsToDelete->save();

        return response()->json($phaseDetailsToDelete);
    }

    function compareMilstoneValue(Request $request)
    {
        $phaseDetails = PhaseModal::find($request->phaseId);
        $phaseValue = $phaseDetails->milestone_value;

        $phaseDetailsValue = PhaseDetailsModal::where([['status', '=', 1], ['phase_id', '=', $request->phaseId]])->sum('milestone_value');
        $phaseDetailsValue = $phaseDetailsValue + $request->milestoneValue;

        if ($phaseValue >= $phaseDetailsValue) {
            return true;
        } else {
            return false;
        }
    }

 
    function addPaymentDetails(Request $request)
    {
        $validateData = $request->validate([
            'payment_methods_id' => 'required ',
            'company_id' => 'required ',
            'project_id' => 'required',
            'phase_id' => 'required',
            'received_by' => 'required',
            'paid_amount' => 'required',
            'due_before_payment' => 'required',
            'due_after_payment' => 'required'
        ]);

        if ($request->payment_methods_id == 1) {
            $validateData = $request->validate([
                'cheque_number' => 'required',
                'cheque_bank' => 'required',
            ]);
        }

        if ($request->payment_methods_id == 2) {
            $validateData = $request->validate([
                'card_number' => 'required'
            ]);
        }

        if ($request->payment_methods_id == 3) {
            $validateData = $request->validate([
                'transaction_number' => 'required'
            ]);
        }

        $payment = new PaymentModal();

        $payment->payment_methods_id = $request->payment_methods_id;
        $payment->company_id = $request->company_id;
        $payment->project_id = $request->project_id;
        $payment->phase_id = $request->phase_id;
        $payment->received_by = $request->received_by;
        $payment->payment_date = $request->payment_date;
        $payment->paid_amount = $request->paid_amount;
        $payment->due_before_payment = $request->due_before_payment; 
        $payment->due_after_payment = $request->due_after_payment; 
        $payment->cheque_number = $request->cheque_number; 
        $payment->cheque_bank = $request->cheque_bank; 
        $payment->card_number = $request->card_number; 
        $payment->transaction_number = $request->transaction_number; 
        $payment->created_by = 1; //$request->session()->get('admin_id');
        $payment->save();

        $company = CompanyModal::find($request->company_id);
        $company->total_paid_amount = $company->total_paid_amount + $request->paid_amount;
        $company->save();


        return response()->json($payment);
    }

    function deletePayment(Request $request)
    {
        $paymentToDelete = PaymentModal::find($request->id);

        $paymentToDelete->deleted_at = date('Y-m-d H:i:s');
        $paymentToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $paymentToDelete->status = 0;

        $paymentToDelete->save();

        return response()->json($paymentToDelete);
    }
    function projectShow(Request $request)
    {
        $projectToShow = ProjectModal::find($request->id);

        $projectToShow->show_in_front = $request->show_in_website;
        $projectToShow->save();

        return response()->json($projectToShow);
    }
}
