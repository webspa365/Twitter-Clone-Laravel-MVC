<?php
/*
  Auth::user() = (object)[
    'name' => '',
    'username' => 'username',
    'following' => 0,
    'followers' => 0,
    'likes' => 0
  ];
*/
  $auth = Auth::user();
?>
@include('navigation/menu-style')
@if($auth)
<div class='menu'>
  <div><div></div></div>
  <ul>
    <li class='menuUser' onclick='to_profile()'>
      <a href={{'/profile/tweets/'.$auth->username}}>
        <span>{{$auth->name}}</span>
        <span>{{'@'.$auth->username}}</span>
      </a>
    </li>
    <li class='menuFollowing'>
      <a href={{'/profile/following/'.$auth->username}}>
        {{$auth->following}} Following
      </a>
    </li>
    <li class='menuFollowers'>
      <a href={{'/profile/followers/'.$auth->username}}>
        {{$auth->followers}} Followers
      </a>
    </li>
    <li class='menuLikes'>
      <a href={{'/profile/likes/'.$auth->username}}>
        {{$auth->likes}} Likes
      </a>
    </li>
    <li class='logout'><a href='/logout'>Log out</a></li>
  </ul>
</div>
@endif

<script>
function to_profile() {

}

function log_out() {

}
</script>
