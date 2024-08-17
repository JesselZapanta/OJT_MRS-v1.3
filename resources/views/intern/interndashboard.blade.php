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
          <a href="{{ route('interndashboard') }}" class="active"
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
          <a href="{{ route('intern.viewstatus') }}"
            ><i class="bx bxs-file-export icon"></i> Requirements Status
            @if($declinedDisapprovedCount > 0)
              <small class="notif">
                {{ $declinedDisapprovedCount }}
              </small>
            @endif
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
        <h1 class="page_title">Intern Dashboard</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="divider">/</li>
          <li><a href="#" class="active">Dashboard</a></li>
        </ul>
        <div class="info-data">
          <div class="card">
            <div class="head">
              <div>
                <h2>Hello, Welcome!</h2>
                <p class="name"> {{ Auth::user()->firstname . ' ' . Auth::user()->lastname}} </p>
              </div>
              <i class="bx bx-user icon"></i>
            </div>
          </div>
        </div>
        <div class="info-data">
          <div class="card">
            <div class="head">
              <div>
                <h2>{{ $submittedReq }}</h2>
                <p>Submitted Requirements</p>
              </div>
              <i class="bx bxs-file icon"></i>
            </div>
          </div>
          <div class="card">
            <div class="head">
              <div>
                <h2>{{ $approvedReq }}</h2>
                <p>Approve Requirements</p>
              </div>
              <i class="bx bxs-file-plus icon"></i>
            </div>
          </div>
        </div>

        {{-- <div class="data">
          <div class="content-data">
            <div class="head">
              <h3>Report</h3>
              <div class="menu">
                <i class="bx bx-dots-horizontal-rounded icon"></i>
                <ul class="menu-link">
                  <li><a href="#">Edit</a></li>
                  <li><a href="#">Save</a></li>
                  <li><a href="#">Remove</a></li>
                </ul>
              </div>
            </div>
            <div class="chart">
              <!-- <div id="chart"></div> -->
            </div>
          </div>
          <div class="content-data">
            <div class="head">
              <h3>Report</h3>
              <div class="menu">
                <i class="bx bx-dots-horizontal-rounded icon"></i>
                <ul class="menu-link">
                  <li><a href="#">Edit</a></li>
                  <li><a href="#">Save</a></li>
                  <li><a href="#">Remove</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div> --}}
      </main>
      <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
