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
          <a href="{{ route('coordinatordashboard') }}" class="active"
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
            ><i class="bx bxs-file-plus icon"></i> Set Requirements
            </a
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
        <h1 class="page_title">Coordinator Dashboard</h1>
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
                <h2>{{$internUserCount }}</h2>
                <p>Total Interns</p>
              </div>
              <i class="bx bxs-user-detail icon"></i>
            </div>
          </div>
          <div class="card">
            <div class="head">
              <div>
                <h2>{{ $maleCount }}</h2>
                <p>Male</p>
              </div>
              <i class="bx bx-male-sign icon"></i>
            </div>
          </div>
          <div class="card">
            <div class="head">
              <div>
                <h2>{{ $femaleCount }}</h2>
                <p>Female</p>
              </div>
              <i class="bx bx-female-sign icon"></i>
            </div>
          </div>
        </div>
{{-- 
        <div class="data">
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
