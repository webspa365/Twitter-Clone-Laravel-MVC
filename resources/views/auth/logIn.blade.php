@include('auth.logIn-style')
<div class='logIn'>
  <header>
    <i class='fa fa-twitter'></i>
    <h1>Log In to Twitter</h1>
  </header>
  <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="form-group">
      <label>Username:</label>
      <input type="text" class="form-control" id="username" name="username" />
      @if ($errors->has('username'))
          <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label>Password:</label>
      <input type="password" class="form-control" id="password" name="password" />
      @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('username') }}</strong>
          </span>
      @endif
    </div>
    <div class="form-group">
      <label class='msg'></label>
      <input type="submit" class="form-control button" id="login" value="Log In" />
    </div>
  </form>
  <div class='toSignUp'>
    <p>New to Twitter? <span onclick='switch_form("signUp")'>Sign up now »</span></p>
  </div>
</div>

<script>
var username = $('#username');
var password = $('#password');
var msg = $('.msg');
</script>
