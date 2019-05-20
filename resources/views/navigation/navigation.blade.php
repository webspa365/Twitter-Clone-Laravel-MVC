@include('navigation/navigation-style')
@include('variables')
<nav class='navigation'>
  <?php
    $links = array('', '', '', '');
    $url = url()->current();
    if(strrpos($url, '/home')) $links[0] = 'active';
    else if(strrpos($url, '/moments')) $links[1] = 'active';
    else if(strrpos($url, '/notifications')) $links[2] = 'active';
    else if(strrpos($url, '/messages')) $links[3] = 'active';

    $avatar = '';
    $auth = null;
    if(Auth::check()) {
      $auth = Auth::user();
      if(isset($auth->avatar)) {
        $avatar = '/storage/media/'.$auth->id.'/avatar/thumbnail.'.$auth->avatar;
      }
    }
  ?>
  <ul>
    <li class='left {{$links[0]}}'>
      <a href='/home' ><i class='fa fa-home'></i><span>Home</span></a>
    </li>
    <li class='left {{$links[1]}}'>
      <a href='/moments' ><i class='fa fa-bolt'></i><span>Moments</span></a>
    </li>
    <li class='left {{$links[2]}}'>
      <a href='/notifications' ><i class='fa fa-bell-o'></i><span>Notifications</span></a>
    </li>
    <li class='left {{$links[3]}}'>
      <a href='/messages' ><i class='fa fa-envelope-o'></i><span>Messages</span></a>
    </li>
    <li class='center'>
      <div class='twitter'><i class='fa fa-twitter'></i></div>
      <div class='center_loader spinner_wrapper'>
        <div class='spinner'></div>
      </div>
    </li>
    <li class='right li_post'><div onclick='open_tweet_dialog()'>Tweet</div></li>
    <li class='right li_user' onclick='show_menu()'>
      <div>
        @if(!$avatar)
          <i class='fa fa-user'></i>
        @else
          <img src="{{$avatar}}" onerror="this.style.display='none'" />
        @endif
      </div>
      @include('navigation/menu')
    </li>
    <li class='right li_search'><Search /></li>
  </ul>
  @include('dialog/tweetDialog')
  @include('dialog/deleteDialog')
  @include('dialog/replyDialog')
  @include('dialog/replies')
</nav>

<script>
auth = <?php echo json_encode($auth); ?>

spin_center(false);

function spin_center(loading) {
  if(loading) {
    _('.twitter').style.display = 'none';
    _('.center_loader').style.display = 'block';
  } else {
    _('.twitter').style.display = 'block';
    _('.center_loader').style.display = 'none';
  }
}

function show_menu() {
  console.log('show_menu()');
  if(auth && auth.username) {
    $('.menu').toggle();
  } else {
    window.location.href = '/';
  }
}

function open_tweet_dialog() {
  console.log('open_tweet_dialog()');
  if(auth && auth.username) {
    $('.tweetDialog').toggle();
  } else {
    window.location.href = '/';
  }
}

function add_active(index) {
  var li = $('.navigation > ul > li').eq(index);
  li.addClass('active');
}
</script>
