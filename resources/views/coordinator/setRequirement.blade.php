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
          <a href="{{ route('coordinator.setRequirementPage') }}" class="active"
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
          <img src="{{ asset('profile/' . Auth::user()->profile) }}" alt="profile">
          <ul class="profile-link">
            <li>
              <a href="{{ route('coordinatorprofile.view') }}"
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
          <li><a href="#" class="active">Set Requirements</a></li>
        </ul>
        <!-- Form -->
        <form action="{{ route('coordinator.setrequirement') }}" method="POST" enctype="multipart/form-data">
          <!-- Requierment Info -->
          @csrf
          <div class="form_container addCoor">
            <h1 class="">Enter Requierment Information here!</h1>
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
                    @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
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
                    @error('details') is-invalid @enderror" name="details" value="{{ old('details') }}"
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
                    @error('form') is-invalid @enderror" name="form" value="{{ old('form') }}"
                  />
                    @if($errors->has('form'))
                      <small class="error">{{ $errors->first('form') }}</small>
                    @endif
                </div>

                <div class="form_btn_container">
                  <button type="submit" class="btn btn-primary">
                    Set Requirements
                  </button>
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
