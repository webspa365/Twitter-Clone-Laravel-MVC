@extends('layouts.app')
@section('content')
@include('home/home-style')
<?php
  if(Auth::check()) {
    $auth = Auth::user();
  }

  //var_dump($auth);

  $avatar = '';
  if(isset($auth['avatar'])) $avatar = '/storage/media/'.$auth['id'].'/avatar/avatar.'.$auth['avatar'];

  $bg = '';
  if(isset($auth['bg'])) $bg = '/storage/media/'.$auth['id'].'/bg/thumbnail.'.$auth['bg'];

  $users = [];
?>
<div class='home container'>
  <div class='left'>
    <?php if(isset($auth)) : ?>
      <div class='authUser'>
        <a class='avatar' href=<?php echo '/profile/tweets/'.$auth->username; ?>>
          <img src=<?php echo $avatar; ?> onerror="this.style.display='none'">
        </a>
        <a class='bg' href=<?php echo '/profile/tweets/'.$auth->username; ?>>
          <img src=<?php echo $bg; ?> onerror="this.style.display='none'">
        </a>
        <div class='content'>
          <h2>
            <span><?php echo $auth['name']; ?></span>
            <span>@<?php echo $auth['username']; ?></span>
          </h2>
          <ul>
            <li>
              <a href="<?php echo '/profile/tweets/'.$auth['username'] ?>">
                <span>Tweets</span>
                <span><?php echo $auth['tweets']; ?></span>
              </a>
            </li>
            <li>
              <a href="<?php echo '/profile/following/'.$auth['username'] ?>">
                <span>Following</span>
                <span><?php echo $auth['following']; ?></span>
              </a>
            </li>
            <li>
              <a href="<?php echo '/profile/followers/'.$auth['username'] ?>">
                <span>Followers</span>
                <span><?php echo $auth['followers']; ?></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <div class='center'>
    @include('home/timeline', ['tweets' => $tweets])
  </div>

  <div class='right'>
    <?php if(isset($auth)) : ?>
      <div class='users'>
        <h3>Who to follow</h3>
        <?php if(isset($users)) : ?>
          <ul>
            <?php foreach($users as $u) : ?>
              @include('home/rightUser', ['user' => $u])
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
@endsection
