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
        <h1 class="page_title">Requirements</h1>
        <ul class="breadcrumbs">
          <li><a href="#">Home</a></li>
          <li class="divider">/</li>
          <li><a href="#" class="active">Approve Requirements</a></li>
        </ul>
        <div class="form_container profile">
            @if(session('success'))
              <div class="message success">
                {{ session('success') }}
              </div>
            @endif
          <div class="approve_forms_container">
            @foreach ($requirements as $requirement)
            {{-- <form action="post" enctype="multipart/form-data"> --}}
              @csrf
              
              <!-- intern Infor -->
              <div class="form_container profile">
                <div class="form_content">
                  <div class="form_group">
                    <div class="form_input">
                    <p class="page_title">{{ $requirement->setRequirement->name }}</p>
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
                      <div class="message">
                        {{ $requirement->status }}
                      </div>
                    @endif
                    </div>
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
                    @if($requirement->status == 'pending')

                        <form method="POST" action="{{ route('coordinator.declinerequirement', ['requirement' => $requirement]) }}">
                          @csrf
                          @method('put')
                          <div class="form_input">
                            <textarea
                              name="comment"
                              id="comment"
                              cols="10"
                              rows="10"
                              @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}"
                            ></textarea>
                            @if($errors->has('comment'))
                                <small class="error">{{ $errors->first('comment') }}</small>
                            @endif
                          </div>
                          <div class="form_input">
                            <button
                            type="submit"
                            class="btn btn-danger"
                            {{-- onclick="setRequired(true)" --}}
                          >
                            Declined
                          </button>
                          </div>
                        </form>
                        {{--  --}}
                        <form method="POST" action="{{ route('coordinator.checkedrequirement', ['requirement' => $requirement]) }}">
                          @csrf
                          @method('put')
                          <div class="form_input">
                            <button
                            type="submit"
                            class="btn btn-primary"
                            {{-- onclick="setRequired(true)" --}}
                          >
                            Checked
                          </button>
                          </div>
                        </form>
                    @endif
                  </div>
                </div>
              </div>
            {{-- </form> --}}
            @endforeach
            
          </div>
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

      function setRequired(isRequired) {
        var textarea = document.getElementById("comment");

        // Set or remove the 'required' attribute based on the isRequired parameter
        if (isRequired) {
          textarea.setAttribute("required", "required");
          document.getElementById("text").innerText = "Required";
        } else {
          textarea.removeAttribute("required");
        }
      }
    </script>
  </body>
</html>
