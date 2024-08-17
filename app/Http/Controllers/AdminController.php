<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function index(){
        $internUserCount = User::where('userole', 'intern')->count();
        $coordinatorUserCount = User::where('userole', 'coordinator')->count();
        $maleCount = Intern::where('sex', 'Male')->count();
        $femaleCount = Intern::where('sex', 'Female')->count();
        return view('admin.admindashboard', compact('internUserCount', 'coordinatorUserCount', 'maleCount', 'femaleCount'));
    }

    public function adminprofile(){
        $admin = Auth::user();
        return view('admin.adminprofile')->with('admin', $admin);
    }

    public function update(User $admin, Request $request){
        $data = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
            'profile' => 'mimes:jpg,png,jpeg|max:5048',
        ]);
        
        // // Handle image deletion if a new profile image is uploaded
        if ($request->hasFile('profile')) {
            $oldImagePath = public_path('profile/' . $admin->profile);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            
            $newImagePath = time() . '-' . 'admin-profile' . '-' . $request->lastname . '-' . $request->firstname . '.' . $request->profile->extension();
            $request->profile->move(public_path('profile'), $newImagePath);
            $data['profile'] = $newImagePath;
        }

        $admin->update($data);
        return redirect()->route('adminprofile', ['admin' => $admin])->with('success', 'Updates Successful.');
    }
}
