<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />

    <title>OJT MRS</title>
  </head>
  <body>
    <!-- SIDEBAR -->
    <section id="sidebar">
      <a href="{{ route('coordinatordashboard') }}" class="brand">
        <div class="logo_con">
          <img src="{{ asset('images/tcgc.png') }}" class="icon" />
        </div>
        OJT MRS</a
      >

      <ul class="side-menu">
        <li>
          <a href="{{ route('coordinatordashboard') }}"  
            ><i class="bx bxs-dashboard icon"></i> Dashboard</a
          >
        </li>
        <li class="divider" data-text="Intern"></li>

        <li>
          <a href="{{ route('approveintern.view') }}"
            ><i class="bx bxs-user-detail icon"></i> Approve Intern
            @if($approvedCount > 0)
              <small class="notif">
                {{ $approvedCount }}
              </small>
            @endif
            </a>
        </li>
        
        <li>
          <a href="{{ route('manageintern.view') }}" 
            ><i class="bx bxs-user-account icon"></i> Manage Intern</a
          >
        </li>
        <li class="divider" data-text="Requirements"></li>
        <li>
          <a href="{{ route('coordinator.setRequirementPage') }}" 
            ><i class="bx bxs-file-plus icon"></i> Set Requirements</a
          >
        </li>
        <li>
          <a href="{{ route('coordinator.approvedrequirementpage') }}"
            ><i class="bx bxs-file icon"></i> Approve Requirements
            @if($usersWithPendingRequirementsCount > 0)
              <small class="notif">
                {{ $usersWithPendingRequirementsCount }}
              </small>
            @endif
          </a>
        </li>
        <li>
          <a href="{{ route('coordinator.managerequirement') }}"
            ><i class="bx bxs-file-archive icon"></i> Manage Requirements
          </a>
        </li>
      </ul>

      <form action="{{ route('logout') }}" method="POST">
        @csrf
        @method('DELETE')
        <div class="logout">
          <input type="submit" class="btn-logout" value="Logout">
        </div>
      </form>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
      <!-- NAVBAR -->
      <nav>
        <i class="bx bx-menu toggle-sidebar"></i>

        <div class="profile">
          <img src="{{ asset('profile/' . $intern->profile) }}" alt="profile">
          <ul class="profile-link">
            <li>
              <a href="{{ route('interndashboard') }}"
                ><i class="bx bxs-user-circle icon"></i> Profile</a
              >
            </li>
          </ul>
        </div>
      </nav>
      <!-- NAVBAR -->

      <!-- MAIN -->
      <main>
        <h1 class="page_title">Intern Profile</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Approve Intern</a></li>
          <li class="divider">/</li>
          <li><a href="#" class="active">Profile</a></li>
        </ul>
        <!-- Form -->
          <form method="post" action="{{ route('approveintern.approved', ['intern' => $intern ]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form_container profile">
            @if(session('success'))
              <div class="message success">
                {{ session('success') }}
              </div>
            @endif
            <h1 class="title">Personal Information here!</h1>
            <div class="form_content">
              <div class="form_group">
                <div class="form_input">
                    <label for="lastname" class="input_label">lastname</label>
                    <input 
                    type="text" 
                    name="lastname" 
                    id="lastname" 
                    value="{{ $intern->lastname }}"
                    disabled
                    />
                </div>
                <div class="form_input">
                    <label for="firstname" class="input_label">firstname</label>
                    <input 
                    type="text" 
                    name="firstname" 
                    id="firstname"
                    disabled
                    value="{{ $intern->firstname }}" 
                    />
                  </div>
                  <div class="form_input">
                    <label for="middlename" class="input_label">middlename</label>
                    <input 
                    type="text" 
                    name="middlename" 
                    id="middlename"
                    value="{{ $intern->middlename }}"  
                    disabled
                    />
                  </div>
              </div>
              <div class="img_container">
                <img src="{{ asset('profile/' . $intern->profile) }}" alt="" />
              </div>
            </div>
          </div>
          <!-- intern Infor -->
          <div class="form_container profile">
            <div class="form_content">
              <div class="form_group">
                <div class="content">
                  <div class="form_input">
                    <label for="institute" class="input_label">institute</label>
                    <select name="institute" id="institute" disabled>
                        <option value="">--</option>
                        <option value="ias" @if($intern->institute == 'ias') selected @endif>Institute of Arts and Sciences</option>
                        <option value="ibfs" @if($intern->institute == 'ibfs') selected @endif>Institute of Business and Financial Services</option>
                        <option value="ics" @if($intern->institute == 'ics') selected @endif>Institute of Computer Studies</option>
                        <option value="icje" @if($intern->institute == 'icje') selected @endif>Institute of Criminal Justice Education</option>
                        <option value="ihs" @if($intern->institute == 'ihs') selected @endif>Institute of Health Sciences</option>
                        <option value="ite" @if($intern->institute == 'ite') selected @endif>Institute of Teacher Education</option>
                    </select>
                  </div>
                  <div class="form_input">
                    <label for="program" class="input_label">program</label>
                    <select name="program" id="program" disabled>
                        <option value="">--</option>
                        <option value="BSCS" @if($intern->program == 'BSCS') selected @endif>BS Computer Science</option>
                    </select>
                  </div>
                </div>
                <div class="content">
                  <div class="form_input">
                    <label for="id_number" class="input_label">id number</label>
                    <input 
                    type="number" 
                    name="id_number" 
                    id="id_number" 
                    value="{{ $intern->intern->id_number }}"  
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="year_level" class="input_label">year level</label>
                    <input 
                    type="number" 
                    name="year_level" 
                    id="year_level"
                    value="{{ $intern->intern->year_level }}" 
                    disabled
                    />
                  </div>
                </div>
                <div class="content">
                  <div class="form_input">
                    <label for="sex" class="input_label">Sex</label>
                    <select name="sex" id="sex" disabled>
                      <option value="">--</option>
                      <option value="Male" @if($intern->intern->sex == 'Male') selected @endif>Male</option>
                      <option value="Female" @if($intern->intern->sex == 'Female') selected @endif>Female</option>
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
                    value="{{ $intern->intern->address }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="contact_number" class="input_label"
                      >contact number</label
                    >
                    <input 
                    type="text" 
                    name="contact_number" 
                    value="{{ $intern->intern->contact_number }}" 
                    disabled
                    />
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
                    value="{{ $intern->intern->date_of_birth }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="place_of_birth" class="input_label"
                      >place of birth</label
                    >
                    <input 
                    type="text" 
                    name="place_of_birth" 
                    id="place_of_birth" 
                    value="{{ $intern->intern->place_of_birth }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="age" class="input_label">age</label>
                    <input 
                    type="number" 
                    name="age" 
                    id="age" 
                    value="{{ $intern->intern->age }}" 
                    disabled
                    />
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
                    value="{{ $intern->intern->father }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="father_occupation" class="input_label"
                      >Occupation</label
                    >
                    <input
                      type="text"
                      name="father_occupation"
                      id="father_occupation"
                      value="{{ $intern->intern->father_occupation }}" 
                      disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="father_contact_no" class="input_label"
                      >contact number</label
                    >
                    <input
                      type="number"
                      name="father_contact_no"
                      id="father_contact_no"
                      value="{{ $intern->intern->father_contact_no }}" 
                      disabled
                    />
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
                    value="{{ $intern->intern->mother }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="mother_occupation" class="input_label"
                      >occupation</label
                    >
                    <input
                      type="text"
                      name="mother_occupation"
                      id="mother"
                      value="{{ $intern->intern->mother_occupation }}" 
                      disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="mother_contact_no" class="input_label"
                      >contact number</label
                    >
                    <input
                      type="number"
                      name="mother_contact_no"
                      id="mother_contact_no"
                      value="{{ $intern->intern->mother_contact_no }}" 
                      disabled
                    />
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
                    value="{{ $intern->intern->guardian_address }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="guardian_contact_no" class="input_label"
                      >contact number</label
                    >
                    <input
                      type="number"
                      name="guardian_contact_no"
                      id="guardian_contact_no"
                      value="{{ $intern->intern->guardian_contact_no }}" 
                      disabled
                    />
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
                    value="{{ $intern->intern->ojt_instructor }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="instructor_contact_no" class="input_label"
                      >contact number</label
                    >
                    <input
                      type="number"
                      name="instructor_contact_no"
                      id="instructor_contact_no"
                      value="{{ $intern->intern->instructor_contact_no }}" 
                      disabled
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Company Info -->
          <div class="form_container profile">
            <h1 class="title">Company Information here!</h1>
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
                    value="{{ $intern->company->company_name }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="company_address" class="input_label"
                      >company address</label
                    >
                    <input
                      type="text"
                      name="company_address"
                      id="company_address"
                      value="{{ $intern->company->company_address }}" 
                      disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="company_contact_number" class="input_label"
                      >company contact number</label
                    >
                    <input
                      type="number"
                      name="company_contact_number"
                      id="company_contact_number"
                      value="{{ $intern->company->company_contact_number }}" 
                      disabled
                    />
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
                      value="{{ $intern->company->date_of_application }}" 
                      disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="position" class="input_label">position</label>
                    <input 
                    type="text" 
                    name="position" 
                    id="position" 
                    value="{{ $intern->company->position }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="schedule" class="input_label">schedule</label>
                    <input 
                    type="text" 
                    name="schedule" 
                    id="schedule" 
                    value="{{ $intern->company->schedule }}" 
                    disabled
                    />
                  </div>
                </div>
                <div class="content">
                  <div class="form_input">
                    <label for="start_date" class="input_label">start date</label>
                    <input 
                    type="date" 
                    name="start_date" 
                    id="start_date" 
                    value="{{ $intern->company->start_date }}" 
                    disabled
                    />
                  </div>
                  <div class="form_input">
                    <label for="end_date" class="input_label">end date</label>
                    <input 
                    type="date" 
                    name="end_date" 
                    id="end_date" 
                    value="{{ $intern->company->end_date }}" 
                    disabled
                    />
                  </div>
                </div>
                <div class="form_btn_container view">
                  <a href="{{ route('approveintern.view') }}" class="btn back_btn">Back</a>
                  <button type="submit" class="btn btn-primary">Approve</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </main>
      <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
