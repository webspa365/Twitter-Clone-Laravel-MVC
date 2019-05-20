@include('auth.signUp-style')
<div class='signUp'>
  <header>
    <i class='fa fa-twitter'></i>
    <h1>Create Your Account</h1>
  </header>
  <form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="form-group">
      <label>Username: <span id='for_username'></span></label>
      <input type="text" class="form-control" id="username" name='username' />
      @if ($errors->has('username'))
          <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Email address: <span id='for_email'></span></label>
      <input type="email" class="form-control" id="email" name='email' />
      @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Password: <span id='for_password'></span></label>
      <input type="password" class="form-control" id="password" name='password' />
      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Confirm password: <span id='for_confirmation'></span></label>
      <input type="password" class="form-control" id="password_confirm" name='password_confirmation' />
    </div>
    <div class="form-group">
      <label><span id='for_post' class='msg'></span></label>
      <input type="submit" class="form-control button" id="submit" value="Sign Up" />
    </div>
  </form>
  <div class='toLogIn'>
    <p>If you have an account, <span onclick='switch_form("logIn")'>Log In »</span></p>
  </div>
</div>
