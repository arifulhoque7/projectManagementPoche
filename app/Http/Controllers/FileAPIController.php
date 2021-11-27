<?php

namespace App\Http\Controllers;

use App\Models\PhaseDetailsFilesModal;
use App\Models\PhaseDetailsModal;
use App\Models\PhaseFilesModal;
use App\Models\PhaseModal;
use App\Models\ProjectModal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    function index()
    {
        // return view('files');
    }
    function viewFiles($id)
    {

        $phases = PhaseModal::where([
            ['status', '>', 0],
            ['project_id', '=', $id]
        ])->orderBy('id', 'ASC')->get();

        $phaseFiles = PhaseFilesModal::where([
            ['status', '>', 0],
            ['project_id', '=', $id]
        ])->orderBy('id', 'ASC')->get();

        $projects = ProjectModal::find($id)->first();

        return response()->json([$phases, $phaseFiles, $projects]);
    }

    function addPhaseDetailsFile(Request $request)
    {
        $validateData = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'company_id' => 'required ',
            'project_id' => 'required',
            'phase_id' => 'required'
        ]);

        $image = $request->file('file');
        $imageName = 'poche' . time() . '.' . $image->extension();
        $image->move(public_path('pocheImages'), $imageName);

        $phaseFile = new PhaseFilesModal();

        $phaseFile->company_id = $request->company_id;
        $phaseFile->project_id = $request->project_id;
        $phaseFile->phase_id = $request->phase_id;
        // $phaseFile->phase_details_id = $request->phase_details_id;
        $phaseFile->file_name = $imageName;
        $phaseFile->created_by = 1; //$request->session()->get('admin_id');

        $phaseFile->save();

        return response()->json($phaseFile);
    }
    function editFile($fileId, $fileName)
    {
        return response()->json([$fileId, $fileName]);
        //return view('files', ['fileId' => $fileId, 'fileName' => $fileName]);
    }
    function replaceFile(Request $request)
    {

        $validateData = $request->validate([
            'id' => 'required',
            'image' => 'required'
        ]);

        $phaseFilesDetails = PhaseFilesModal::find($request->id);
    
        $phaseFilesName = $phaseFilesDetails->file_name; 
        //var_dump($phaseFilesName);

        if(File::exists(public_path('pocheImages/'.$phaseFilesName))){
            File::delete(public_path('pocheImages/'.$phaseFilesName));
        }else{
            dd('File does not exists.');
        }

    
        $image = $request->image;

        $imageExtension = explode('/', mime_content_type($request->image))[1];


        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);



        $imageName = 'poche' . time() . '.' . $imageExtension;


        File::put(public_path('pocheImages/').$imageName, $image_base64);
       
        $fileToReplace = PhaseFilesModal::find($request->id);
        $fileToReplace->file_name = $imageName;
        $fileToReplace->save();

        return response()->json($fileToReplace);
    }

    public function deleteFile(Request $request)
    {
        $fileToDelete = PhaseFilesModal::find($request->id);
        
        $phaseFilesName = $fileToDelete->file_name; 

        if(File::exists(public_path('pocheImages/'.$phaseFilesName))){
            File::delete(public_path('pocheImages/'.$phaseFilesName));
        }else{
            dd('File does not exists.');
        }
        $fileToDelete->deleted_at = date('Y-m-d H:i:s');
        $fileToDelete->deleted_by = 1;  //$request->session()->get('admin_id');
        $fileToDelete->status = 0;

        $fileToDelete->save();

        return response()->json($fileToDelete);
        
    }
}
