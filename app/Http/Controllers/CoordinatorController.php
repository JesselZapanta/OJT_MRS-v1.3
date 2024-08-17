<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CoordinatorController extends Controller
{
    //
    public function index(){
        $institute = Auth::user()->institute;

        $internUserCount = User::where('userole', 'intern')->where('institute', $institute)->count();


        $maleCount = User::where('userole', 'intern')
                ->where('institute', $institute)
                ->whereHas('intern', function ($query) {
                    $query->where('sex', 'Male');
                })
                ->count();

                
        $femaleCount = User::where('userole', 'intern')
                ->where('institute', $institute)
                ->whereHas('intern', function ($query) {
                    $query->where('sex', 'Female');
                })
                ->count();

        return view('coordinator.coordinatorDashboard', [
            'internUserCount' => $internUserCount, 
            'maleCount' => $maleCount, 
            'femaleCount' => $femaleCount
        ]);
    }
    
    public function coordinatorprofile(){
        $coordinator = Auth::user();
        return view('coordinator.coordinatorProfile')->with('coordinator', $coordinator);
    }

    public function updateprofile(User $coordinator, Request $request){
        $data = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
            'profile' => 'mimes:jpg,png,jpeg|max:5048',
        ]);
        
        // // Handle image deletion if a new profile image is uploaded
        if ($request->hasFile('profile')) {
            $oldImagePath = public_path('profile/' . $coordinator->profile);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            
            $newImagePath = time() . '-' . 'coordinator-profile' . '-' . $request->lastname . '-' . $request->firstname . '.' . $request->profile->extension();
            $request->profile->move(public_path('profile'), $newImagePath);
            $data['profile'] = $newImagePath;
        }

        $coordinator->update($data);
        return redirect()->route('coordinatorprofile.view', ['coordinator' => $coordinator])->with('success', 'Updates Successful.');
    }
}
