<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OJT MRS</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  </head>
  <body>
    <div class="login_container">
      <div class="login">
        <h1 class="title">Log In your account here!</h1>
        @if(session('error'))
        <div class="message">
          {{ session('error') }}
        </div>
        @endif

        @if(session('success'))
        <div class="message success">
          {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="form_input">
            <label for="email" class="input_label">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="example@gmail.com"
              @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
            />
          </div>
          <div class="form_input">
            <label for="password" class="input_label">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="••••••••"
              @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"
            />
          </div>
          {{-- <div class="checkbox_content">
            <input type="checkbox" />
            <label for="rememberme">Remember me</label>
          </div> --}}
          <div class="form_btn_container">
            <button type="submit" class="btn btn-primary">Log In</button>
          </div>
          <div class="form_input">
            <p>Don't have an Account? <a href="{{ route('register') }}">Register</a></p>
          </div>
        </form>
      </div>
      <div class="img_container">
        <img src="{{ asset('images/tcgc.png') }}" alt="" />
      </div>
    </div>
  </body>
</html>
