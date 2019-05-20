@if(Auth::check())
  <script>
    // redirect if user is logged in
    var url = '/profile/tweets/'+'<?php echo Auth::user()->username;?>';
    window.location.href = url;
  </script>
@endif
@extends('layouts.app')
@section('content')
  @include('auth.auth-style')
  <div class='auth'>
    <div class='left'>
      <ul>
        <li>
          <i class='fa fa-search'></i>
          <span>Follow your interests.</span>
        </li>
        <li>
          <i class='fa fa-user-o'></i>
          <span>Hear what people are talking about.</span>
        </li>
        <li>
          <i class='fa fa-comment-o'></i>
          <span>Join the conversation.</span>
        </li>
      </ul>
      <div class='bg'><i class='fa fa-twitter'></i></div>
    </div>
    <div class='right' >
      @if($form === 'signUp')
        @include('auth/signUp')
      @elseif($form === 'logIn')
        @include('auth/logIn')
      @else
        <div class='wrapper'>
          <i class='fa fa-twitter'></i>
          <p>See what’s happening in<br /> the world right now</p>
          <h1>Join Twitter today.</h1>
          <button class='btn btn-primary toSignUp' onclick='switch_form("signUp")'>Sign Up</button>
          <button class='btn btn-default toLogIn' onclick='switch_form("logIn")'>Log In</button>
        </div>
      @endif
      <!--SignUp v-else-if='this.type === "SignUp"' :switch_form='switch_form' />
      <LogIn v-else-if='this.type === "LogIn"' :switch_form='switch_form' /-->
    </div>
  </div>
@endsection
<script>
//var f = <?php echo $form ?>;
//console.log('f='+f);

function switch_form(name) {
  console.log('switch_form='+name);
  window.location.href = name;
}
/*
$(document).ready(function() {
  $('.toSignUp').click(function() {


  });
  $('.toLogIn').click(function() {

  });
});*/

</script>
