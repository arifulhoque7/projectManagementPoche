<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\AdminUserTypeModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAPIController extends Controller
{
    function index()
    {
        $tmpAdmins = AdminModal::where([
            ['user_type', '>', 1],
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();
        $admins = array();
        $tmpValue = array();
        foreach ($tmpAdmins as $tmpAdmin) {
            $tmpValue['id'] = $tmpAdmin->id;
            $tmpValue['name'] = $tmpAdmin->name;
            $tmpValue['email'] = $tmpAdmin->email;
            $tmpValue['mobile'] = $tmpAdmin->mobile;
            $tmpValue['designation'] = $tmpAdmin->designation;

            $usertype = AdminUserTypeModal::find($tmpAdmin->user_type);

            $tmpValue['user_type'] = $tmpAdmin->user_type;
            $tmpValue['user_type_name'] = $usertype->name;
            $tmpValue['created_at'] = $tmpAdmin->created_at;
            $tmpValue['created_by'] = $tmpAdmin->created_by;
            $tmpValue['deleted_at'] = $tmpAdmin->deleted_at;
            $tmpValue['deleted_by'] = $tmpAdmin->deleted_by;
            $tmpValue['notification'] = $tmpAdmin->notification;
            $tmpValue['status'] = $tmpAdmin->status;

            array_push($admins, $tmpValue);
        }

        $adminusertypes = AdminUserTypeModal::where([
            ['id', '>', 1],
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        return response()->json($admins);
    }

    function addAdmin(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:App\Models\AdminModal,email',
            'mobile' => 'required | unique:App\Models\AdminModal,mobile',
            'designation' => 'required',
            'password' => 'required | min:6',
            'usertype' => 'required'
        ]);

        $admin = new AdminModal();

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->designation = $request->designation;
        $admin->password = Hash::make($request->password);
        $admin->user_type = $request->usertype;
        $admin->created_by = 1; //$request->session()->get('admin_id'); 

        $admin->save();

        return response()->json($admin);
    }


    function detailsOfAdmin($id)
    {
        $admin = AdminModal::find($id);
        return response()->json($admin);
    }

    function updateAdmin(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'mobile' => 'required',
            'designation' => 'required',
            'usertype' => 'required'
        ]);


        $adminToUpdate = AdminModal::find($request->id);

        $adminToUpdate->name = $request->name;
        $adminToUpdate->email = $request->email;
        $adminToUpdate->mobile = $request->mobile;
        $adminToUpdate->designation = $request->designation;
        $adminToUpdate->user_type = $request->usertype;
        if ($request->password != "" || null) {
            $adminToUpdate->password = Hash::make($request->password);
        }

        $adminToUpdate->save();

        $returnArray = array();
        $tmpAdmin = AdminModal::find($request->id);

        $returnArray['id'] = $tmpAdmin->id;
        $returnArray['name'] = $tmpAdmin->name;
        $returnArray['email'] = $tmpAdmin->email;
        $returnArray['mobile'] = $tmpAdmin->mobile;
        $returnArray['designation'] = $tmpAdmin->designation;

        $usertype = AdminUserTypeModal::find($tmpAdmin->user_type);

        $returnArray['user_type'] = $tmpAdmin->user_type;
        $returnArray['user_type_name'] = $usertype->name;
        $returnArray['created_at'] = $tmpAdmin->created_at;
        $returnArray['created_by'] = $tmpAdmin->created_by;
        $returnArray['deleted_at'] = $tmpAdmin->deleted_at;
        $returnArray['deleted_by'] = $tmpAdmin->deleted_by;
        $returnArray['notification'] = $tmpAdmin->notification;
        $returnArray['status'] = $tmpAdmin->status;

        return response()->json($returnArray);
    }


    function deleteAdmin(Request $request)
    {
        $adminToDelete = AdminModal::find($request->id);

        $adminToDelete->deleted_at = date('Y-m-d H:i:s');
        $adminToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $adminToDelete->status = 0;

        $adminToDelete->save();

        return response()->json($adminToDelete);
    }
}
