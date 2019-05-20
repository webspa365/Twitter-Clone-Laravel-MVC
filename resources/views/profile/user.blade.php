<?php
  $followsYou = '';
  $bg = '/storage/media/'.$user->id.'/bg/thumbnail.'.$user->bg;
  $avatar = '/storage/media/'.$user->id.'/avatar/thumbnail.'.$user->avatar;
?>
<li class='user'>
  <div class='bg' onclick='click_user({{$user->id}})'>
    <img src={{$bg}} onerror="this.style.display='none'" />
  </div>
  <div class='avatar' onclick='click_user({{$user->id}})'>
    <img src={{$avatar}} onerror="this.style.display='none'" />
  </div>
  <div class='info'>
    <h3>
      <span class='name'>{{$user->name}}</span>
      <span class='username' onclick='click_user({{$user->id}})'>{{'@'.$user->username}}{{$followsYou}}</span>
    </h3>
    <p class='bio'>{{$user->bio}}</p>
    @if($user->followed === 0)
      <button class='btn btn-default followButton' onclick='follow_user({{$user->id}})'></button>
    @else
      <button class='btn btn-default followButton followed' onclick='follow_user({{$user->id}})'></button>
    @endif
  </div>
</li>
@include('profile/user-style')

<script>
function click_user(id) {
  window.location.href = '/profile/tweets/'+id;
}
</script>
