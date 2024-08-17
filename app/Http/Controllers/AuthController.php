<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Intern as ModelsIntern;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
public function register()
{
    return view('register');
}

public function registerPost(Request $request)
{

    $data = $request->validate([
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:2',
        'lastname' => 'required|string|max:255',
        'firstname' => 'required|string|max:255',
        'middlename' => 'string|max:255',
        'institute' => 'required|string|max:255',
        'program' => 'required|string|max:255',
        'profile' => 'required|mimes:jpg,png,jpeg|max:5048',

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

    $newProfileName = time() . '-' . 'profile' . '-' . $request->lastname . '-' . $request->firstname . '.' . $request->profile->extension();
    $request->profile->move(public_path('profile'), $newProfileName);

    $user = User::create([
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'lastname' => $data['lastname'],
        'firstname' => $data['firstname'],
        'middlename' => $data['middlename'],
        'institute' => $data['institute'],
        'program' => $data['program'],
        'profile' => $newProfileName,
    ]);

    $intern = ModelsIntern::create([
        'userId' => $user->id,
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

    $company = Company::create([
        'userId' => $user->id,
        'company_name' => $data['company_name'],
        'company_address' => $data['company_address'],
        'company_contact_number' => $data['company_contact_number'],
        'date_of_application' => $data['date_of_application'],
        'position' => $data['position'],
        'schedule' => $data['schedule'],
        'start_date' => $data['start_date'],
        'end_date' => $data['end_date'],
    ]);

    return redirect()->route('login')->with('success', 'Registration Successful. Wait for Approval.');
}

public function login()
{
    return view('login');
}

public function loginPost(Request $request)
{
    $credetials = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    if (Auth::attempt($credetials)) {
        // return redirect('/home')->with('success', 'Login Success');
        if($request->user()->userole === 'intern'){
            return redirect()->intended('interndashboard');
        }elseif($request->user()->userole === 'coordinator'){
            return redirect()->intended('coordinatordashboard');
        }elseif($request->user()->userole === 'admin'){
            return redirect()->intended('admindashboard');
        }
    }

    // return back()->with('error', 'Error Email or Password');
    return redirect()->route('login')->with('error', 'Invalid credentials.');
}

public function logout()
{
    
    Auth::logout();

    return redirect()->route('login');
}
}