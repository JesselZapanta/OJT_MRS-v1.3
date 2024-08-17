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
      <a href="{{ route('admindashboard') }}" class="brand">
        <div class="logo_con">
          <img src="{{ asset('images/tcgc.png') }}" class="icon" />
        </div>
        OJT MRS</a
      >

      <ul class="side-menu">
        <li>
          <a href="{{ route('admindashboard') }}" 
            ><i class="bx bxs-dashboard icon"></i> Dashboard</a
          >
        </li>
        <li class="divider" data-text="Coordinator"></li>
        <li>
          <a href="{{ route('addcoordinator') }}"
            ><i class="bx bx-user-plus icon"></i> Add Coordinator</a
          >
        </li>
        <li>
          <a href="{{ route('managecoordinator') }}" class="active"
            ><i class="bx bxs-user-rectangle icon"></i> Manage Coordinator</a
          >
        </li>
        <li class="divider" data-text="Intern"></li>

        <li>
          <a href="{{ route('admin.manageinternview') }}"
            ><i class="bx bxs-user-account icon"></i> Manage Intern</a
          >
        </li>
        <li class="divider" data-text="Requirements"></li>
        <li>
          <a href="{{ route('admin.viewsetrequirement') }}"
            ><i class="bx bxs-file-plus icon"></i> Set Requirements</a
          >
        </li>
        <li>
          <a href="{{ route('admin.approvedrequirementpage') }}"
            ><i class="bx bxs-file icon"></i> Approve Requirements
          @if($usersWithPendingRequirementsCount > 0)
              <div class="notif">
                {{ $usersWithPendingRequirementsCount }}
              </div>
            @endif
          </a>
        </li>
        <li>
          <a href="{{ route('admin.managerequirement') }}"
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
          <img src="{{ asset('profile/' . Auth::user()->profile) }}" alt="profile">
          <ul class="profile-link">
            <li>
              <a href="{{ route('adminprofile') }}"
                ><i class="bx bxs-user-circle icon"></i> Profile</a
              >
            </li>
          </ul>
        </div>
      </nav>
      <!-- NAVBAR -->

      <!-- MAIN -->
      <main>
        <h1 class="page_title">Coordinator Profile</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="divider">/</li>
          <li><a href="" class="active">Profile</a></li>
        </ul>
        <!-- Form -->
        <form method="post" action="{{ route('updateCoordinator', ['coordinator' => $coordinator]) }}" enctype="multipart/form-data">
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
                    value="{{ $coordinator->lastname }}"
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
                    value="{{ $coordinator->firstname }}" 
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
                    value="{{ $coordinator->middlename }}"  
                    @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename') }}"
                    />
                  @if($errors->has('middlename'))
                    <small class="error">{{ $errors->first('middlename') }}</small>
                  @endif
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
                <div class="form_btn_container view">
                  <a href="{{ route('managecoordinator') }}" class="btn back_btn">Back</a>
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </div>
              <div class="img_container">
                <img src="{{ asset('profile/' . $coordinator->profile) }}" alt="" />
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
