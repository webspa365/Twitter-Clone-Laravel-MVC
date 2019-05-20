@extends('layouts.app')
@section('content')
@include('profile/editProfile-style')
<?php
  $profile = Auth::user();

  $thumb = '/storage/media/'.$profile->id.'/avatar/thumbnail.'.$profile->avatar;

  if(isset($profile->bg)) {
    $profile->bg = '/storage/media/'.$profile->id.'/bg/bg.'.$profile->bg;
  }

  if(isset($profile->avatar)) {
    $profile->avatar = '/storage/media/'.$profile->id.'/avatar/avatar.'.$profile->avatar;
  }
?>
<form class='editProfile' method="POST" action={{'/profile/edit/'.Auth::user()->username}} enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class='bg'>
    <img id='img_bg' src={{$profile->bg}} />
    <div class='message'>
      <i class='fa fa-camera'></i><br />
      <span>Add a header photo</span>
      <input id='input_bg' class='form-control' type='file' name='bg' onchange='change_bg(event)' />
    </div>
  </div>
  <div class='nav'>
    <div class='container'>
      <div class='avatar'>
        <img id='img_avatar' src={{$profile->avatar}} />
        <div class='message'>
          <i class='fa fa-image'></i><br />
          <span>Change your profile photo</span>
        </div>
        <input id='input_avatar' class='form-control' type='file' name='avatar' onchange='change_avatar(event)' />
      </div>
      <input class='button btn btn-default' type='submit' value='Save cahnges' />
      <a class='button btn btn-default' href={{'/profile/tweets/'.Auth::user()->username}}>Cancel</a>
    </div>
  </div>

  <div class='main container'>
    <div class='row'>
      <div class='left col-lg-3'>
        <div class='info'>
          <label>Name:</label>
          <input class='name form-control' type='text' name='name' value={{$profile->name}} />
          <label>Username:</label>
          <input class='username form-control' type='text' name='username' value={{$profile->username}} required />
          <label>Email:</label>
          <input class='email form-control' type='text' name='email' value={{$profile->email}} required />
          <label>Bio:</label>
          <textarea class='bio form-control' type='text' name='bio'>{{$profile->bio}}</textarea>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

<script>
var thumb = '<?php echo $thumb; ?>';

window.addEventListener('load', function(){
  $('.li_user').find('img').attr('src', thumb);
});


function change_bg(e) {
  console.log(e.target.files[0]);
  var src = URL.createObjectURL(e.target.files[0]);
  var bg = _id('img_bg');
  bg.setAttribute('src', src);
  var img = new Image();
  img.src = src;
  img.onload = () => {
    //console.log(img.naturalWidth +'/'+ img.naturalHeight);
    if((img.naturalWidth/img.naturalHeight) > 4) {
      bg.style.width = 'auto';
      bg.style.height = '100%';
    }
  }
}

function change_avatar(e) {
  this.avatar = e.target.files[0];
  var src = URL.createObjectURL(e.target.files[0]);
  var avatar = _id('img_avatar');
  avatar.setAttribute('src', src);
  var img = new Image();
  img.src = src;
  img.onload = () => {
    //console.log(img.naturalWidth +'/'+ img.naturalHeight);
    if(img.naturalWidth > img.naturalHeight) {
      avatar.style.width = 'auto';
      avatar.style.height = '100%';
    }
  }
}
</script>
