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

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/1.13.7/css/dataTables.bulma.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bulma.min.css"
    />
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
        <h1 class="page_title">Intern</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="divider">/</li>
          <li><a href="#" class="active">Manage Intern</a></li>
        </ul>
        <div class="form_container profile">
            @if(session('success'))
              <div class="message success">
                {{ session('success') }}
              </div>
            @endif
        <table id="example" class="table is-striped nowrap" style="width: 100%">
          <thead>
            <tr>
              <th>Id Number</th>
              <th>Firstname</th>
              <th>Middlename</th>
              <th>Lastname</th>
              <th>Status</th>
              {{-- <th>Institute</th>
              <th>Program</th> --}}
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          @foreach ($interns as $intern)
            <tr>
              <td>{{ $intern->intern->id_number }}</td>
              <td>{{ $intern->firstname }}</td>
              <td>{{ $intern->middlename }}</td>
              <td>{{ $intern->lastname }}</td>
              <td><small class="status" id="status">{{ $intern->status }}</small></td>
              {{-- <td>{{ $intern->institute }}</td>
              <td>{{ $intern->program }}</td> --}}
              <td class="action">
                <div class="action_btn">
                  <a href="{{ route('approveintern.viewprofile', ['intern' => $intern])}}" class="btn view"
                    >View <i class="bx bx-show"></i
                  ></a>
                  <form method="post" action="{{ route('approveintern.decline', ['intern' => $intern]) }}">
                    @csrf
                    @method('put')
                    <button class="btn danger">Decline <i class="bx bx-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach    
          </tbody>
        </table>
      </main>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bulma.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bulma.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
      new DataTable("#example", {
        responsive: true,
      });
    </script>
  </body>
</html>
