@extends('layouts.app')
@section('content')
@include('profile/profile-style')
<?php
  $links = array('', '', '', '');
  $url = url()->current();
  if(strrpos($url, '/profile/tweets/')) $links[0] = 'active';
  else if(strrpos($url, '/profile/following/')) $links[1] = 'active';
  else if(strrpos($url, '/profile/followers/')) $links[2] = 'active';
  else if(strrpos($url, '/profile/likes/')) $links[3] = 'active';

  //var_dump(Auth::user());
  if(isset($profile->bg)) {
    $profile->bg = '/storage/media/'.$profile->id.'/bg/bg.'.$profile->bg;
  }

  if(isset($profile->avatar)) {
    $profile->avatar = '/storage/media/'.$profile->id.'/avatar/avatar.'.$profile->avatar;
  }

  $auth = (object)['username' => ''];
  if(Auth::check()) {
    $auth = Auth::user();
  }

  $time = strtotime($profile->created_at);
  $date = 'Joined '.date('M', $time).' '.date('Y', $time);
?>
<div class='profile'>
  <div class='bg'>
    <img src={{$profile->bg}} onerror="this.style.display='none'" />
  </div>
  <div class='nav'>
    <div class='container'>
      <a class='avatar' href={{'profile/tweets/'.$profile->id}}>
        <img src={{$profile->avatar}} onerror="this.style.display='none'" />
      </a>
      <ul class='profile_ul'>
        <li class={{$links[0]}}>
          <a href={{'/profile/tweets/'.$profile->username}}>
            <span>Tweets</span>
            <span class='profile-tweets'>{{$profile->tweets}}</span>
          </a>
        </li>
        <li class={{$links[1]}}>
          <a href={{'/profile/following/'.$profile->username}}>
            <span>Following</span>
            <span class='profile-following'>{{$profile->following}}</span>
          </a>
        </li>
        <li class={{$links[2]}}>
          <a href={{'/profile/followers/'.$profile->username}}>
            <span>Followers</span>
            <span class='profile-followers'>{{$profile->followers}}</span>
          </a>
        </li>
        <li class={{$links[3]}}>
          <a href={{'/profile/likes/'.$profile->username}} >
            <span>Likes</span>
            <span class='profile-likes'>{{$profile->likes}}</span>
          </a>
        </li>
      </ul>
      @if($profile->username === $auth->username)
        <button class='btn btn-default edit' onclick='edit_profile()'>
          Edit Profile
        </button>
      @elseif($profile->followed === 1)
        <button class='btn btn-primary follow followed' onclick='follow_user({{$profile->id}})'></button>
      @elseif($profile->followed === 0)
        <button class='btn btn-primary follow' onclick='follow_user({{$profile->id}})'></button>
      @endif
    </div>
  </div>
  <div class='main container'>
   <div>
     <div class='left'>
       <div class='content'>
          <h1>
            <span class='name'>{{$profile->name}}</span>
            <span class='username'>{{'@'.$profile->username}}</span>
          </h1>
          <p class='bio'>{{$profile->bio}}</p>
          <div class='date'>
            <i class='fa fa-calendar'></i>
            {{$date}}
          </div>
        </div>
      </div>
      <div class='center'>
        @if($links[0] || $links[3])
          <div>
            @include('tweets/tweets', ['tweets' => $tweets]);
          </div>
        @else
          <ul class='users'>
            @isset($users)
              @foreach($users as $u)
                @include('profile/user', ['user' => $u])
              @endforeach
            @endisset
          </ul>
        @endif
      </div>
      <div class='right'>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
var authId = "<?php echo Auth::user()->id ?>";
function edit_profile() {
  console.log('edit_profile()');
  window.location.href = '/profile/edit/'+authId;
}

function follow_user(id) {
  console.log('follow_user('+id+')');
  $.ajax({
    url: '/relationships/',
    type: 'POST',
    data: {"_token": "{{ csrf_token() }}", id: id},
    success: function(res) {
      console.log(JSON.stringify(res));
      if(res.success) {
        // update button
        var button = $('.profile .follow');
        if(res.followed) button.addClass('followed');
        else button.removeClass('followed');
        // update followers
        $('.profile-followers').html(res.profileFollowers);

      }
    }
  });
}

</script>
