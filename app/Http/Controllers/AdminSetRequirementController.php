<?php

namespace App\Http\Controllers;

use App\Models\SetRequirement;
use App\Models\SubmittedRequirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminSetRequirementController extends Controller
{
    //
    public function index(){
        return view('admin.setRequirement');
    }

    public function setrequirement(Request $request){
        $institute = Auth::user()->institute;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'form' => 'mimes:pdf|max:5048',
        ]);

        $newReqName = null; // Initialize
        if ($request->hasFile('form')) {
            $newReqName = time() . '-' . 'Set-Requirement' . '-' . $institute . '-'. $request->name .  '.'  . $request->form->extension();
            $request->form->move(public_path('setRequirements'), $newReqName);
        }

        $setRequirement = SetRequirement::create([
            'name' => $data['name'],
            'details' => $data['details'],
            'form' => $newReqName,
            'office' => $institute
        ]);

        return redirect()->route('admin.managerequirement')->with('success', 'Requirement Added Successfully');
    }


    public function managerequirements(){
        $requirements = SetRequirement::where('office', 'ojt')->get();
        return view('admin.manageRequirements')->with('requirements', $requirements);
    }

    public function viewrequirement(SetRequirement $requirement){
        return view('admin.viewRequirement')->with('requirement', $requirement);
    }

    public function updaterequirement(Request $request, SetRequirement $requirement){
        $institute = Auth::user()->institute;

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'required|string|max:255',
            'form' => 'mimes:pdf|max:5048',
        ]);

        $data['office'] = $institute;

        if ($request->hasFile('form')) {
            $oldFormPath = public_path('setRequirements/' . $requirement->form);
            if (File::exists($oldFormPath)) {
                File::delete($oldFormPath);
            }
            
            $newFormPath = time() . '-' . 'Set-Requirement' . '-' . $institute . '.' . $request->form->extension();
            $request->form->move(public_path('setRequirements'), $newFormPath);
            $data['form'] = $newFormPath;
        }

        $requirement->update($data);
        return redirect()->route('admin.viewrequirement', ['requirement' => $requirement ])->with('success', 'Updates Successful.');
    }

    public function deleterequirement(SetRequirement $requirement){
        $requirementPath = public_path('setRequirements/' . $requirement->form);

        if (File::exists($requirementPath)) {
            File::delete($requirementPath);
        }

        $requirement->delete();

        return redirect()->route('admin.managerequirement')->with('success', 'Deleted Successfully.');
    }


    // approve page

        // Approve
    public function approvedrequirementpage(){

        $userIdsWithPendingRequirements = SubmittedRequirement::query()
            ->where('status', 'checked') // Keep this filter
            ->orWhere('status', 'disapproved') // Keep this filter
            // ->where('institute', $institute)
            ->distinct('userId')
            ->pluck('userId');

        // Fetch the complete user information for those IDs
        $usersWithPendingRequirements = User::query()
            ->whereIn('id', $userIdsWithPendingRequirements)
            ->get();

        // dd( $usersWithPendingRequirementsCount);
        return view('admin.approvedRequirement', [
            'usersWithPendingRequirements' => $usersWithPendingRequirements,
        ]);
    }

    public function viewapprovedrequirementpage(User $user){

        $requirements = SubmittedRequirement::with('setRequirement')
            ->where('userId', $user->id)
            ->get();


        // dd($requirements);
        return view('admin.viewApprovedRequirement', ['requirements' => $requirements]);
    }

        // decline
    public function declinerequirement(Request $request, SubmittedRequirement $requirement){

        $data = $request->validate([
            'comment' => 'required|string'
        ]);

        $requirement->update([
            'comment' => $data['comment'],
            'status' => 'disapproved'
        ]);

        return redirect()->back()->with('success', 'Aisapproved Successfully');
    }

    //Checked
    public function checkedrequirement(SubmittedRequirement $requirement){
        $requirement->status = 'approved';
        $requirement->save();

        return redirect()->back()->with('success', 'Approved Successfully');
    }
}
