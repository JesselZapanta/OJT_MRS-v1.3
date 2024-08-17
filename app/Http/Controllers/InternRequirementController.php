<?php

namespace App\Http\Controllers;

use App\Models\SetRequirement;
use App\Models\SubmittedRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class InternRequirementController extends Controller
{

    public function viewrequirements(){
        $institute = Auth::user()->institute;

        // Get the IDs of requirements already submitted by the user
        $submittedRequirementIds = SubmittedRequirement::where('userId', Auth::id())
                                                        ->pluck('requirementId');

        // Fetch only requirements that are not in the submitted list
        $requirements = SetRequirement::whereIn('office', [$institute, 'ojt'])
                                        ->whereNotIn('id', $submittedRequirementIds)
                                        ->get();

        return view('intern.submitRequirements', ['requirements' => $requirements]);
    }


    public function submitrequirements(Request $request) {
        $user = Auth::user()->id;

        $validatedData = $request->validate([
            'requirementId' => 'required|array',
            'files' => 'required|array',
            'files.*' => 'required|mimes:pdf',
        ]);

        foreach ($validatedData['files'] as $index => $file) {
            // Generate a unique filename for each file, ensuring distinct names
            $newReqName = time() . '-' . $index . '-' . 'Submitted-Requirement' . '-' . Auth::user()->lastname . '.' . $file->extension();

            // Move the current file to the storage path
            $file->move(public_path('submittedRequirements'), $newReqName);

            $requirement = SubmittedRequirement::create([
                'userId' => $user,
                'requirementId' => $validatedData['requirementId'][$index],
                'institute' => Auth::user()->institute,
                // 'status' => 'pending',
                'file' => $newReqName,
            ]);
        }

        return redirect()->route('intern.viewstatus')->with('success', 'Submitted Successfully.');
    }

    public function viewstatus(){
        $user = Auth::user()->id;
        $requirements = SubmittedRequirement::with('setRequirement') // Eager load
                                        ->where('userId', $user)
                                        ->get();

        return view('intern.submitRequirementStatus', ['requirements' => $requirements]);
    }



    public function reuploadRequirementPage(SubmittedRequirement $requirement){
        return view('intern.reuploadRequirement', ['requirement' => $requirement]);
    }

    public function reuploadRequirement(Request $request, SubmittedRequirement $requirement){
            $data = $request->validate([
                'file' => 'required|mimes:pdf',
            ]);


            if ($request->hasFile('file')) {
                $oldFilePath = public_path('submittedRequirements/' . $requirement->file);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }

                $newFilePath = time() . '-' . 'Submitted-Requirement' . '-' . Auth::user()->lastname . '.' . $request->file->extension();

                // Access the actual uploaded file instance from the request
                $uploadedFile = $request->file('file');
                $uploadedFile->move(public_path('submittedRequirements'), $newFilePath);

                $data['file'] = $newFilePath;
            }

            
            $requirement->update([
                'file' => $data['file'],
                'status' => 'pending',
                'comment' => null
            ]);

            return redirect()->route('intern.viewstatus')->with('success', 'Re-Upload Successfully, Wait for Checking and Approval');
    }
}
