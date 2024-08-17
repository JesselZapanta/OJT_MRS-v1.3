<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OJT MRS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  </head>
  <body>
    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form_container">
        <h1 class="title">Register your Intern account here!</h1>
        <div class="form_content">
          <div class="form_group">
            <div class="form_input">
              <label for="email" class="input_label">Email</label>
              <input
                type="email"
                name="email"
                id="email"
                placeholder="example@gmail.com"
                @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
              />
              @if($errors->has('email'))
                <small class="error">{{ $errors->first('email') }}</small>
              @endif
            </div>
            <div class="form_input">
              <label for="password" class="input_label">Password</label>
              <input
                type="password"
                name="password"
                id="password"
                placeholder="••••••••"
                @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"
              />
              @if($errors->has('password'))
                <small class="error">{{ $errors->first('password') }}</small>
              @endif
            </div>
          </div>
          <div class="img_container">
            <img src="{{ asset('images/tcgc.png') }}" alt="" />
          </div>
        </div>
      </div>
      <!-- intern Infor -->
      <div class="form_container">
        <h1 class="title">Enter your Personal Information here!</h1>
        <div class="form_content">
          <div class="form_group">
            <div class="content">
              <div class="form_input">
                <label for="lastname" class="input_label">lastname</label>
                <input 
                  type="text" 
                  name="lastname" 
                  id="lastname" 
                  @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}"
                />
                  @if($errors->has('lastname'))
                    <small class="error">{{ $errors->first('lastname') }}</small>
                  @endif
              </div>
              <div class="form_input">
                <label for="firstname" class="input_label">firstname</label>
                <input 
                type="text" 
                name="firstname" 
                id="firstname" 
                @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}"
                />
              @if($errors->has('firstname'))
                <small class="error">{{ $errors->first('firstname') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="middlename" class="input_label">middlename</label>
                <input 
                type="text" 
                name="middlename" 
                id="middlename" 
                @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}"
                />
              @if($errors->has('middlename'))
                <small class="error">{{ $errors->first('middlename') }}</small>
              @endif
              </div>
            </div>
            <div class="content">
              <div class="form_input">
                <label for="institute" class="input_label">institute</label>
                <select name="institute" id="institute">
                  <option value="">--</option>
                  <option value="ias">Institute of Arts and Sciences</option>
                  <option value="ibfs">
                    Institute of Business and Financial Services
                  </option>
                  <option value="ics">Institute of Computer Studies</option>
                  <option value="icje">
                    Institute of Criminal Justice Education
                  </option>
                  <option value="ihs">Institute of Health Sciences</option>
                  <option value="ite">Institute of Teacher Education</option>
                </select>
              @if($errors->has('institute'))
                <small class="error">{{ $errors->first('institute') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="program" class="input_label">program</label>
                <select name="program" id="program">
                  <option value="">--</option>
                  <option value="BSCRIM">BSCRIM</option>
                  <option value="BSISM">BSISM</option>
                  <option value="BSBA-HRM">BSBA-HRM</option>
                  <option value="BSBA-MM">BSBA-MM</option>
                  <option value="BEED">BEED</option>
                  <option value="BSED-ENGLISH">BSED-ENGLISH</option>
                  <option value="BSED-FILIPINO">BSED-FILIPINO</option>
                  <option value="BSED-MATH">BSED-MATH</option>
                  <option value="BSED-SOCSTUD">BSED-SOCSTUD</option>
                  <option value="AB-COMM">AB-COMM</option>
                  <option value="AB-ENGLISH">AB-ENGLISH</option>
                  <option value="AB-POLSCI">AB-POLSCI</option>
                  <option value="BSCS">BSCS</option>
                  <option value="GEN-MID">GEN-MID</option>
                </select>
              @if($errors->has('program'))
                <small class="error">{{ $errors->first('program') }}</small>
              @endif
              </div>
            </div>
            <div class="content">
              <div class="form_input">
                <label for="id_number" class="input_label">id number</label>
                <input 
                type="number" 
                name="id_number" 
                id="id_number" 
                @error('id_number') is-invalid @enderror" name="id_number" value="{{ old('id_number') }}"
                />
              @if($errors->has('id_number'))
                <small class="error">{{ $errors->first('id_number') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="year_level" class="input_label">year level</label>
                <input 
                type="number" 
                name="year_level" 
                id="year_level" 
                @error('year_level') is-invalid @enderror" name="year_level" value="{{ old('year_level') }}"
                />
              @if($errors->has('year_level'))
                <small class="error">{{ $errors->first('year_level') }}</small>
              @endif
              </div>
            </div>
            <div class="content">
              <div class="form_input">
                <label for="gender" class="input_label">gender</label>
                <select name="sex" id="sex">
                  <option value="">--</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
                @if($errors->has('sex'))
                  <small class="error">{{ $errors->first('sex') }}</small>
                @endif
              </div>
              <div class="form_input">
                <label for="address" class="input_label">address</label>
                <input 
                type="text" 
                name="address" 
                id="address" 
                @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}"
                />
              @if($errors->has('address'))
                <small class="error">{{ $errors->first('address') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="contact_number" class="input_label"
                  >contact number</label
                >
                <input 
                type="text" 
                name="contact_number" 
                id="contact_number" 
                @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}"
                />
              @if($errors->has('contact_number'))
                <small class="error">{{ $errors->first('contact_number') }}</small>
              @endif
              </div>
            </div>
            <div class="content">
              <div class="form_input">
                <label for="date_of_birth" class="input_label"
                  >date of birth</label
                >
                <input 
                type="date" 
                name="date_of_birth" 
                id="date_of_birth" 
                @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}"
                />
              @if($errors->has('date_of_birth'))
                <small class="error">{{ $errors->first('date_of_birth') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="place_of_birth" class="input_label"
                  >place of birth</label
                >
                <input 
                type="text" 
                name="place_of_birth" 
                id="place_of_birth" 
                @error('place_of_birth') is-invalid @enderror" name="place_of_birth" value="{{ old('place_of_birth') }}"
                />
              @if($errors->has('place_of_birth'))
                <small class="error">{{ $errors->first('place_of_birth') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="age" class="input_label">age</label>
                <input 
                type="number" 
                name="age" 
                id="age" 
                @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}"
                />
              @if($errors->has('age'))
                <small class="error">{{ $errors->first('age') }}</small>
              @endif
              </div>
            </div>
            <!-- ==== -->
            <div class="content">
              <div class="form_input">
                <label for="father" class="input_label">father's name</label>
                <input 
                type="text" 
                name="father" 
                id="father" 
                @error('father') is-invalid @enderror" name="father" value="{{ old('father') }}"
                />
              @if($errors->has('father'))
                <small class="error">{{ $errors->first('father') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="father_occupation" class="input_label"
                  >Occupation</label
                >
                <input
                  type="text"
                  name="father_occupation"
                  id="father_occupation"
                  @error('father_occupation') is-invalid @enderror" name="father_occupation" value="{{ old('father_occupation') }}"
                />
              @if($errors->has('father_occupation'))
                <small class="error">{{ $errors->first('father_occupation') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="father_contact_no" class="input_label"
                  >contact number</label
                >
                <input
                  type="number"
                  name="father_contact_no"
                  id="father_contact_no"
                  @error('father_contact_no') is-invalid @enderror" name="father_contact_no" value="{{ old('father_contact_no') }}"
                />
              @if($errors->has('father_contact_no'))
                <small class="error">{{ $errors->first('father_contact_no') }}</small>
              @endif
              </div>
            </div>
            <!-- ==== -->
            <div class="content">
              <div class="form_input">
                <label for="mother" class="input_label">mother's name</label>
                <input 
                type="text" 
                name="mother" 
                id="mother" 
                @error('mother') is-invalid @enderror" name="mother" value="{{ old('mother') }}"
                />
              @if($errors->has('mother'))
                <small class="error">{{ $errors->first('mother') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="mother_occupation" class="input_label"
                  >occupation</label
                >
                <input
                  type="text"
                  name="mother_occupation"
                  id="mother"
                  @error('mother_occupation') is-invalid @enderror" name="mother_occupation" value="{{ old('mother_occupation') }}"
                />
              @if($errors->has('mother'))
                <small class="error">{{ $errors->first('mother') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="mother_contact_no" class="input_label"
                  >contact number</label
                >
                <input
                  type="number"
                  name="mother_contact_no"
                  id="mother_contact_no"
                  @error('mother_contact_no') is-invalid @enderror" name="mother_contact_no" value="{{ old('mother_contact_no') }}"
                />
              @if($errors->has('mother_contact_no'))
                <small class="error">{{ $errors->first('mother_contact_no') }}</small>
              @endif
              </div>
            </div>
            <!-- ==== -->
            <div class="content">
              <div class="form_input">
                <label for="guardian_address" class="input_label"
                  >parent/guardian address</label
                >
                <input 
                type="text" 
                name="guardian_address" 
                id="guardian_address" 
                @error('guardian_address') is-invalid @enderror" name="guardian_address" value="{{ old('guardian_address') }}"
                />
              @if($errors->has('guardian_address'))
                <small class="error">{{ $errors->first('guardian_address') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="guardian_contact_no" class="input_label"
                  >contact number</label
                >
                <input
                  type="number"
                  name="guardian_contact_no"
                  id="guardian_contact_no"
                  @error('guardian_contact_no') is-invalid @enderror" name="guardian_contact_no" value="{{ old('guardian_contact_no') }}"
                />
              @if($errors->has('guardian_contact_no'))
                <small class="error">{{ $errors->first('guardian_contact_no') }}</small>
              @endif
              </div>
            </div>
            <!-- ==== -->
            <div class="content">
              <div class="form_input">
                <label for="ojt_instructor" class="input_label"
                  >OJT/practicum instructor</label
                >
                <input 
                type="text" 
                name="ojt_instructor" 
                id="ojt_instructor" 
                @error('ojt_instructor') is-invalid @enderror" name="ojt_instructor" value="{{ old('ojt_instructor') }}"
                />
              @if($errors->has('ojt_instructor'))
                <small class="error">{{ $errors->first('ojt_instructor') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="instructor_contact_no" class="input_label"
                  >contact number</label
                >
                <input
                  type="number"
                  name="instructor_contact_no"
                  id="instructor_contact_no"
                  @error('instructor_contact_no') is-invalid @enderror" name="instructor_contact_no" value="{{ old('instructor_contact_no') }}"
                />
              @if($errors->has('instructor_contact_no'))
                <small class="error">{{ $errors->first('instructor_contact_no') }}</small>
              @endif
              </div>
            </div>
            <div class="form_input">
              <label for="profile" class="input_label"
                >Upload 2x2 profile</label
              >
              <input type="file" name="profile" id="profile" />
              @if($errors->has('profile'))
                <small class="error">{{ $errors->first('profile') }}</small>
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- Company Info -->
      <div class="form_container">
        <h1 class="title">Enter Company Information here!</h1>
        <div class="form_content">
          <div class="form_group">
            <div class="content">
              <div class="form_input">
                <label for="company_name" class="input_label"
                  >company name</label
                >
                <input 
                type="text" 
                name="company_name" 
                id="company_name" 
                @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}"
                />
              @if($errors->has('company_name'))
                <small class="error">{{ $errors->first('company_name') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="company_address" class="input_label"
                  >company address</label
                >
                <input
                  type="text"
                  name="company_address"
                  id="company_name"
                  @error('company_address') is-invalid @enderror" name="company_address" value="{{ old('company_address') }}"
                />
              @if($errors->has('company_name'))
                <small class="error">{{ $errors->first('company_name') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="company_contact_number" class="input_label"
                  >company contact number</label
                >
                <input
                  type="number"
                  name="company_contact_number"
                  id="company_contact_number"
                  @error('company_contact_number') is-invalid @enderror" name="company_contact_number" value="{{ old('company_contact_number') }}"
                />
              @if($errors->has('company_contact_number'))
                <small class="error">{{ $errors->first('company_contact_number') }}</small>
              @endif
              </div>
            </div>
            <div class="content">
              <div class="form_input">
                <label for="date_of_application" class="input_label"
                  >date of application</label
                >
                <input
                  type="date"
                  name="date_of_application"
                  id="date_of_application"
                  @error('date_of_application') is-invalid @enderror" name="date_of_application" value="{{ old('date_of_application') }}"
                />
              @if($errors->has('date_of_application'))
                <small class="error">{{ $errors->first('date_of_application') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="position" class="input_label">position</label>
                <input 
                type="text" 
                name="position" 
                id="position" 
                @error('position') is-invalid @enderror" name="position" value="{{ old('position') }}"
                />
              @if($errors->has('position'))
                <small class="error">{{ $errors->first('position') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="schedule" class="input_label">schedule</label>
                <input 
                type="text" 
                name="schedule" 
                id="schedule" 
                @error('schedule') is-invalid @enderror" name="schedule" value="{{ old('schedule') }}"
                />
              @if($errors->has('schedule'))
                <small class="error">{{ $errors->first('schedule') }}</small>
              @endif
              </div>
            </div>
            <div class="content">
              <div class="form_input">
                <label for="start_date" class="input_label">start date</label>
                <input 
                type="date" 
                name="start_date" 
                id="start_date" 
                @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}"
                />
              @if($errors->has('start_date'))
                <small class="error">{{ $errors->first('start_date') }}</small>
              @endif
              </div>
              <div class="form_input">
                <label for="end_date" class="input_label">end date</label>
                <input 
                type="date" 
                name="end_date" 
                id="end_date" 
                @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}"
                />
              @if($errors->has('end_date'))
                <small class="error">{{ $errors->first('end_date') }}</small>
              @endif
              </div>
            </div>
            <div class="form_input">
              <p>Already have an Account? <a href="{{ route('login') }}">Log In</a></p>
            </div>
            <div class="form_btn_container">
              <button type="submit" class="btn btn-primary">Register</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
