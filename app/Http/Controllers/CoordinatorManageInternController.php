<?php

namespace App\Http\Controllers;

use App\Models\SubmittedRequirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CoordinatorManageInternController extends Controller
{
    //
    public function viewintern(){
        $institute = Auth::user()->institute;
        $interns = User::where('userole', 'intern')->where('institute', $institute)->where('status', 'pending')->get();
        $count = User::where('userole', 'intern')->where('institute', $institute)->where('status', 'pending')->count();
        return view('coordinator.approveIntern', ['interns' => $interns, 'count' => $count]);
    }
    
    public function viewprofile(User $intern){

        return view('coordinator.viewApproveInternProfile', [
            'intern' => $intern
        ]);
    }

    public function approved(User $intern){
        $intern->status = 'approved';
        $intern->save();
        return redirect()->route('approveintern.view')->with('success', 'Approved Successfully');
    }

    public function decline(User $intern){
        $intern->status = 'declined';
        $intern->save();
        return redirect()->route('approveintern.view')->with('success', 'Decline Successfully');
    }

    public function manageintern(){
        $institute = Auth::user()->institute;
        $interns = User::where('userole', 'intern')->where('institute', $institute)->get();
        return view('coordinator.manageintern')->with('interns', $interns);
    }
    public function viewinternprofile(User $intern){
        $requirements = SubmittedRequirement::with('setRequirement')
            ->where('userId', $intern->id)
            ->where('status', 'approved')
            ->get();
            
        return view('coordinator.viewinternprofile', [
            'intern' => $intern,
            'requirements' => $requirements
        ]);
    }
    public function updateintern(User $intern, Request $request){
        $data = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
            'institute' => 'required|string|max:255',
            'program' => 'required|string|max:255', 
            'profile' => 'mimes:jpg,png,jpeg|max:5048',

            'id_number' => 'required|numeric',
            'year_level' => 'required|numeric|max:4|min:1',
            'sex' => 'required|string',
            'address' => 'required|string|max:255',
            'contact_number' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required|string|max:255',
            'age' => 'required|numeric',
            'father' => 'required|string|max:255',
            'father_occupation' => 'required|string|max:255',
            'father_contact_no' => 'required|numeric',
            'mother' => 'required|string|max:255',
            'mother_occupation' => 'required|string|max:255',
            'mother_contact_no' => 'required|numeric',
            'guardian_address' => 'required|string|max:255',
            'guardian_contact_no' => 'required|numeric',
            'ojt_instructor' => 'required|string|max:255',
            'instructor_contact_no' => 'required|numeric',

            'company_name' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'company_contact_number' => 'required|numeric',
            'date_of_application' => 'required|date',
            'position' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        
        // // Handle image deletion if a new profile image is uploaded
        if ($request->hasFile('profile')) {
            $oldImagePath = public_path('profile/' . $intern->profile);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            
            $newImagePath = time() . '-' . 'intern-profile' . '-' . $request->lastname . '-' . $request->firstname . '.' . $request->profile->extension();
            $request->profile->move(public_path('profile'), $newImagePath);
            $data['profile'] = $newImagePath;
        }
        DB::transaction(function () use ($intern, $data) {
            try {
                // Update the User (Intern) table
                $intern->update($data);

                // Update the Intern table
                $intern->intern()->update([
                    // ... fields to update in the Intern table
                    'id_number' => $data['id_number'],
                    'year_level' => $data['year_level'],
                    'sex' => $data['sex'],
                    'address' => $data['address'],
                    'contact_number' => $data['contact_number'],
                    'date_of_birth' => $data['date_of_birth'],
                    'place_of_birth' => $data['place_of_birth'],
                    'age' => $data['age'],
                    'father' => $data['father'],
                    'father_occupation' => $data['father_occupation'],
                    'father_contact_no' => $data['father_contact_no'],
                    'mother' => $data['mother'],
                    'mother_occupation' => $data['mother_occupation'],
                    'mother_contact_no' => $data['mother_contact_no'],
                    'guardian_address' => $data['guardian_address'],
                    'guardian_contact_no' => $data['guardian_contact_no'],
                    'ojt_instructor' => $data['ojt_instructor'],
                    'instructor_contact_no' => $data['instructor_contact_no'],
                ]);

                // Update the Company table
                $intern->company()->update([
                    // ... fields to update in the Company table
                    'company_name' => $data['company_name'],
                    'company_address' => $data['company_address'],
                    'company_contact_number' => $data['company_contact_number'],
                    'date_of_application' => $data['date_of_application'],
                    'position' => $data['position'],
                    'schedule' => $data['schedule'],
                    'start_date' => $data['start_date'],
                    'end_date' => $data['end_date'],
                ]);
            } catch (\Exception $e) {
                // If any error occurs, rollback the transaction
                DB::rollback();
                throw $e; // Rethrow the exception to handle it appropriately
            }
        });

        return redirect()->route('manageintern.viewprofile', ['intern' => $intern])->with('success', 'Updates Successful.');
    }

    public function deleteintern(User $intern){

        $intern->delete();

        $profilename = public_path('profile/' . $intern->profile);
        if (File::exists($profilename)) {
            File::delete($profilename);
        }
        return redirect()->route('manageintern.view')->with('success', 'Deleted Successfully');
    }
}
