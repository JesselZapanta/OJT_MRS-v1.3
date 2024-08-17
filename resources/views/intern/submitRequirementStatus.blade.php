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
        <h1 class="page_title">Requirements</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="divider">/</li>
          <li><a href="#" class="active">Submit Requirements</a></li>
        </ul>
          @if(session('success'))
              <div class="message success">
                {{ session('success') }}
              </div>
          @endif
        <!-- Form -->
        <div class="approve_forms_container">
          @foreach ($requirements as $requirement)
            <!-- intern Infor -->
            <div class="form_container profile">
              <div class="form_content">
                <div class="form_group">
                  <div class="form_input">
                    <h1 class="page_title">{{  $requirement->setRequirement->name }}</h1>
                  </div>
                    @if($requirement->status == 'pending')
                      <div class="message warning">
                        {{ $requirement->status }}
                      </div>
                      @elseif ($requirement->status == 'checked')
                      <div class="message primary">
                        {{ $requirement->status }}
                      </div>
                      @elseif ($requirement->status == 'approved')
                      <div class="message success">
                        {{ $requirement->status }}
                      </div>
                      @elseif ($requirement->status == 'declined')
                      <div class="message">
                        {{ $requirement->status }}
                      </div>
                      @elseif ($requirement->status == 'disapproved')
                      <div class="message error">
                        {{ $requirement->status }}
                      </div>
                    @endif
                  <div class="form_input">
                    <iframe
                      class="view_file approve"
                      src="{{ asset('submittedRequirements/' . $requirement->file) }}"
                      frameborder="0"
                    ></iframe>
                    <a
                      href="{{ asset('submittedRequirements/' . $requirement->file) }}"
                      class="view_file_btn"
                      target="_blank"
                      >view</a
                    >
                  </div>
                  @if($requirement->status == 'declined' || $requirement->status == 'disapproved')
                  <div class="form_input">
                    <textarea
                      name="comment_text"
                      id="comment"
                      cols="10"
                      rows="10"
                      disabled
                    >{{ $requirement->comment }}</textarea>
                  </div>
                  @endif
                  @if($requirement->status == 'declined' || $requirement->status == 'pending' || $requirement->status == 'disapproved')
                    <div class="form_btn_container view">
                      <a href="{{ route('intern.reuploadRequirementPage', ['requirement'=> $requirement])}}" class="btn btn-primary"
                        >Re Upload</a>
                    </div>
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
          @if ($requirements->isEmpty())
              <div class="message primary">
                No requirements submitted.
              </div>
          @endif
      </main>
      <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
