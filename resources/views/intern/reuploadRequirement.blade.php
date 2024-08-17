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
      <a href="{{ route('interndashboard') }}" class="brand">
        <div class="logo_con">
          <img src="{{ asset('images/tcgc.png') }}" class="icon" />
        </div>
        OJT MRS</a
      >
      <ul class="side-menu">
        <li>
          <a href="{{ route('interndashboard') }}"
            ><i class="bx bxs-dashboard icon"></i> Dashboard</a
          >
        </li>
        <li class="divider" data-text="Profile"></li>
        <li>
          <a href="{{ route('internprofile') }}"><i class='bx bx-user-pin icon'></i> Profile</a>
        </li>
        <li class="divider" data-text="Requirements"></li>
        <li>
          <a href="{{ route('intern.viewrequirements') }}"
            ><i class="bx bxs-file-export icon"></i> Submit Requirements
            @if($requirementsCount > 0)
              <small class="notif">
                {{ $requirementsCount }}
              </small>
            @endif
          </a>
        </li>
        <li>
          <a href="{{ route('intern.viewstatus') }}" class="active"
            ><i class="bx bxs-file-export icon"></i> Requirements Status
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
              <a href="{{ route('internprofile') }}"
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
          <li><a href="#" class="active">Re Upload Requirements</a></li>
        </ul>
          @if(session('success'))
              <div class="message success">
                {{ session('success') }}
              </div>
          @endif
          <form method="post" action="{{ route('intern.reuploadRequirement', ['requirement' => $requirement]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form_container submit">
                <h1 class="title">{{ $requirement->setRequirement->name }}</h1>
                    <div class="form_group"> 
                        <div class="content">
                            <div class="form_input">
                                <label for="file" class="input_label">Upload File(Must be PDF File)</label>
                                <input type="file" name="file" id="file" /> 
                            </div>
                        </div>
                        <div class="form_btn_container">
                              <button type="submit" class="btn btn-primary">
                                  Re-Upload Requirements
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
