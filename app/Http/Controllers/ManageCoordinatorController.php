<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ManageCoordinatorController extends Controller
{
    //
    public function index(){
        return view('admin.addCoordinator');
    }

    public function store(Request $request){

    $data = $request->validate([
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
        'lastname' => 'required|string|max:255',
        'firstname' => 'required|string|max:255',
        'middlename' => 'string|max:255',
        'institute' => 'required|string|max:255',
        'profile' => 'required|mimes:jpg,png,jpeg|max:5048',
    ]);

    $newProfileName = time() . '-' . 'coordinator-profile' . '-' . $request->lastname . '-' . $request->firstname . '.' . $request->profile->extension();
    $request->profile->move(public_path('profile'), $newProfileName);

    $user = User::create([
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'lastname' => $data['lastname'],
        'firstname' => $data['firstname'],
        'middlename' => $data['middlename'],
        'institute' => $data['institute'],
        'status' => 'approved',
        'userole' => 'coordinator',
        'profile' => $newProfileName,
    ]);
    return redirect()->route('managecoordinator')->with('success', 'Added Successful.');
    }

    public function editCoordinator(User $coordinator){
        return view('admin.viewCoordinatorProfile', ['coordinator' => $coordinator]);
    }


    public function update(User $coordinator, Request $request){
        $data = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middlename' => 'string|max:255',
            'profile' => 'mimes:jpg,png,jpeg|max:5048',
        ]);
        
        // Handle image deletion if a new profile image is uploaded
        if ($request->hasFile('profile')) {
            $oldImagePath = public_path('profile/' . $coordinator->profile);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
            
            $newImagePath = time() . '-' . 'profile' . '-' . $request->lastname . '-' . $request->firstname . '.' . $request->profile->extension();
            $request->profile->move(public_path('profile'), $newImagePath);
            $data['profile'] = $newImagePath;
        }

        $coordinator->update($data);
        return redirect()->route('editCoordinator', ['coordinator' => $coordinator])->with('success', 'Updates Successful.');
    }

    public function managecoordinatorPage(){
        $coordinators = User::where('userole','coordinator')->get();
        return view('admin.managecoordinator')->with('coordinators', $coordinators);
    }

    public function destroy(User $coordinator)
    {
        $imagePath = public_path('profile/' . $coordinator->profile); // Assuming the image path is stored in the 'profile_image' column

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $coordinator->delete();

        return redirect()->route('managecoordinator')->with('success', 'Deleted Successfully.');
    }
}
