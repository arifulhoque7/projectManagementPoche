<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\CompanyModal;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    function index()
    {
        $tempCompanys = CompanyModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        $companys = array();
        $tempCompanysArray = array();

        foreach($tempCompanys as $tempCompany){
            $tempCompanysArray['id'] = $tempCompany->id;
            $tempCompanysArray['name'] = $tempCompany->name;
            $tempCompanysArray['address'] = $tempCompany->address;
            $tempCompanysArray['total_projects'] = $tempCompany->total_projects;
            $tempCompanysArray['total_projects_value'] = $tempCompany->	total_projects_value;
            $tempCompanysArray['total_paid_amount'] = $tempCompany->total_paid_amount;
            $tempCompanysArray['created_at'] = $tempCompany->created_at;
            $tempCompanysArray['created_by'] = $tempCompany->created_by;
            $adminDetails = AdminModal::find($tempCompany->created_by);
            $tempCompanysArray['created_by_name'] = $adminDetails->name;
            $tempCompanysArray['deleted_at'] = $tempCompany->deleted_at;
            $tempCompanysArray['deleted_by'] = $tempCompany->deleted_by;
            $tempCompanysArray['notification'] = $tempCompany->notification;
            $tempCompanysArray['status'] = $tempCompany->status;

            array_push($companys, $tempCompanysArray);
        }
        return response()->json($companys);
        // return view('company', compact('companys'));
    }


    function addCompany(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required | unique:App\Models\CompanyModal,name',
            'address' => 'required' 
        ]);
        $company = new CompanyModal();

        $company->name = $request->name;
        $company->address = $request->address;
        $company->created_by = 1; //$request->session()->get('admin_id'); 

        $company->save();

        return response()->json($company);
    }

    function detailsOfCompany($id)
    {
        $company = CompanyModal::find($id);
        return response()->json($company);
    }

    function updateCompany(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);


        $companyToUpdate = CompanyModal::find($request->id);
        $companyToUpdate->name = $request->name;
        $companyToUpdate->address = $request->address;
        $companyToUpdate->save();
        return response()->json($companyToUpdate);
    }

    function deleteCompany(Request $request)
    {
        $companyToDelete = CompanyModal::find($request->id);

        $companyToDelete->deleted_at = date('Y-m-d H:i:s');
        $companyToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $companyToDelete->status = 0;

        $companyToDelete->save();

        return response()->json($companyToDelete);
    }
}
