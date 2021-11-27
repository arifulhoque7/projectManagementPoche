<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\AdminUserTypeModal;
use App\Models\CompanyModal;
use App\Models\UserModal;
use App\Models\UserTypeModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    function index()
    {
        $tmpUsers = UserModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();
        $users = array();
        $tmpValue = array();
        foreach ($tmpUsers as $tmpUser) {
            $tmpValue['id'] = $tmpUser->id;

            $company = CompanyModal::find($tmpUser->company_id);

            $tmpValue['company_id'] = $tmpUser->company_id;
            $tmpValue['company_name'] = $company->name;
            $tmpValue['name'] = $tmpUser->name;
            $tmpValue['designation'] = $tmpUser->designation;
            $tmpValue['mobile'] = $tmpUser->mobile;
            $tmpValue['email'] = $tmpUser->email;
            $tmpValue['designation'] = $tmpUser->designation;

            $usertype = UserTypeModal::find($tmpUser->user_type);

            $tmpValue['user_type'] = $tmpUser->user_type;
            $tmpValue['user_type_name'] = $usertype->name;
            $tmpValue['created_at'] = $tmpUser->created_at;
            $tmpValue['created_by'] = $tmpUser->created_by;
            $tmpValue['deleted_at'] = $tmpUser->deleted_at;
            $tmpValue['deleted_by'] = $tmpUser->deleted_by;
            $tmpValue['status'] = $tmpUser->status;

            array_push($users, $tmpValue);
        }
        $usertypes = UserTypeModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        $companys = CompanyModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();
        
        return response()->json([$users,$usertypes, $companys]);
        //return view('user', compact('users', 'usertypes', 'companys'));
    }

    function addUser(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'company' => 'required',
            'designation' => 'required',
            'mobile' => 'required | unique:App\Models\UserModal,mobile',
            'email' => 'required | email | unique:App\Models\UserModal,email',
            'usertype' => 'required',
            'password' => 'required | min:6'
        ]);

        $user = new UserModal();

        $user->name = $request->name;
        $user->company_id = $request->company;
        $user->designation = $request->designation;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->user_type = $request->usertype;
        $user->password = Hash::make($request->password);
        $user->created_by = 1; //$request->session()->get('user_id'); 

        $user->save();

        return response()->json($user);
    }


    function detailsOfUser($id)
    {
        $user = UserModal::find($id);
        return response()->json($user);
    }

    function updateUser(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'company' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
            'email' => 'required | email',
            'usertype' => 'required'
        ]);


        $userToUpdate = UserModal::find($request->id);

        $userToUpdate->name = $request->name;
        $userToUpdate->company_id = $request->company;
        $userToUpdate->designation = $request->designation;
        $userToUpdate->mobile = $request->mobile;
        $userToUpdate->email = $request->email;
        $userToUpdate->user_type = $request->usertype;
        if ($request->password != "" || null) {
            $userToUpdate->password = Hash::make($request->password);
        }

        $userToUpdate->save();

        $returnArray = array();


        $tmpUser = UserModal::find($request->id);

        $returnArray['id'] = $tmpUser->id;
        $returnArray['name'] = $tmpUser->name;

        $company = CompanyModal::find($tmpUser->company_id);
        $returnArray['company_id'] = $tmpUser->company_id;
        $returnArray['company_name'] = $company->name;
        $returnArray['company'] = $tmpUser->company;
        $returnArray['designation'] = $tmpUser->designation;
        $returnArray['mobile'] = $tmpUser->mobile;
        $returnArray['email'] = $tmpUser->email;

        $usertype = UserTypeModal::find($tmpUser->user_type);
        $returnArray['user_type'] = $tmpUser->user_type;
        $returnArray['user_type_name'] = $usertype->name;
        $returnArray['created_at'] = $tmpUser->created_at;
        $returnArray['created_by'] = $tmpUser->created_by;
        $returnArray['deleted_at'] = $tmpUser->deleted_at;
        $returnArray['deleted_by'] = $tmpUser->deleted_by;
        $returnArray['notification'] = $tmpUser->notification;
        $returnArray['status'] = $tmpUser->status;

        return response()->json($returnArray);
    }

    function deleteUser(Request $request)
    {
        $userToDelete = UserModal::find($request->id);

        $userToDelete->deleted_at = date('Y-m-d H:i:s');
        $userToDelete->deleted_by = 1;  //$request->session()->get('user_id');
        $userToDelete->status = 0;
        $userToDelete->save();

        return response()->json($userToDelete);
    }
}
