<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../css/style.css" />
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
          <a href="{{ route('managecoordinator') }}"
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
          <a href="{{ route('admin.managerequirement') }}" class="active"
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
        <h1 class="page_title">Requirements</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="divider">/</li>
          <li><a href="#" class="active">Requirement Details</a></li>
        </ul>
          @if(session('success'))
            <div class="message success">
              {{ session('success') }}
            </div>
          @endif
        <!-- Form -->
        <form method="post" action="{{ route('updaterequirement', ['requirement' => $requirement ]) }}" enctype="multipart/form-data">
          <!-- Requierment Info -->
          @csrf
          @method('put')
          <div class="form_container addCoor">
            <h1 class="">Requirement Details here!</h1>
            <div class="form_content">
              <div class="form_group">
                <div class="form_input">
                  <label for="name" class="input_label"
                    >requirement name</label
                  >
                  <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ $requirement->name }}"
                  />
                    @if($errors->has('name'))
                      <small class="error">{{ $errors->first('name') }}</small>
                    @endif
                </div>
                <div class="form_input">
                  <label for="details" class="input_label"
                    >requirement details</label
                  >
                  <input
                    type="text"
                    name="details"
                    id="details"
                    value="{{ $requirement->details }}"
                  />
                    @if($errors->has('details'))
                      <small class="error">{{ $errors->first('details') }}</small>
                    @endif
                </div>
                <div class="form_input">
                  <label for="requirement_form" class="input_label"
                    >requirement form</label
                  >
                  <input
                    type="file"
                    name="form"
                    id="form"
                  />
                    @if($errors->has('form'))
                      <small class="error">{{ $errors->first('form') }}</small>
                    @endif
                </div>
                @if($requirement->form)
                  <div class="form_input">
                    <iframe
                      class="view_file"
                      src="{{ asset('setRequirements/' . $requirement->form) }}"
                      frameborder="0"
                    ></iframe>
                  </div>
                @endif
                <div class="form_btn_container view">
                  <a href="{{ route("admin.managerequirement") }}" class="btn back_btn">Back</a>
                  <button type="submit" class="btn btn-primary">Update</button>
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
