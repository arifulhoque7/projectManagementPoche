<?php

namespace App\Http\Controllers;

use App\Models\AdminModal;
use App\Models\ExtraModal;
use Illuminate\Http\Request;

class ExtraController extends Controller
{
    
    function index()
    {
        $tmpExtras = ExtraModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();
        $extras = array();
        $tmpValue = array();
        foreach ($tmpExtras as $tmpExtra) {
            $tmpValue['id'] = $tmpExtra->id;
            $tmpValue['name'] = $tmpExtra->name;
            $tmpValue['value'] = $tmpExtra->value;
            $tmpValue['created_at'] = $tmpExtra->created_at;
            $tmpValue['created_by'] = $tmpExtra->created_by;
            $adminDetails = AdminModal::find($tmpExtra->created_by);
            $tempCompanysArray['created_by_name'] = $adminDetails->name;
            $tmpValue['deleted_at'] = $tmpExtra->deleted_at;
            $tmpValue['deleted_by'] = $tmpExtra->deleted_by;
            $tmpValue['status'] = $tmpExtra->status;

            array_push($extras, $tmpValue);
        }
        // return view('extra', compact('extras'));
        return response()->json($extras);
    }


    function addExtra(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required | unique:App\Models\ExtraModal,name',
            'value' => 'required |alpha_num' 
        ]);
        $extra = new ExtraModal();

        $extra->name = $request->name;
        $extra->value = $request->value;
        $extra->created_by = 1; //$request->session()->get('extra_id'); 

        $extra->save();

        return response()->json($extra);
    }

    function detailsOfExtra($id)
    {
        $extra = ExtraModal::find($id);
        return response()->json($extra);
    }

    function updateExtra(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);


        $extraToUpdate = ExtraModal::find($request->id);
        $extraToUpdate->name = $request->name;
        $extraToUpdate->value = $request->value;
        $extraToUpdate->save();
        return response()->json($extraToUpdate);
    }

    function deleteExtra(Request $request)
    {
        $extraToDelete = ExtraModal::find($request->id);

        $extraToDelete->deleted_at = date('Y-m-d H:i:s');
        $extraToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $extraToDelete->status = 0;

        $extraToDelete->save();

        return response()->json($extraToDelete);
    }
}
