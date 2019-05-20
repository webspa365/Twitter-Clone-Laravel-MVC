@include('dialog/replyDialog-style')
<?php
  $msg = '';
  $avatar = '';

?>
<div class='replyDialog' onclick='close_reply_dialog(event)'>
    <form class='wrapper modal-content' method='post' action='/replies'>
      {{ csrf_field() }}
      <div class='modal-header'>
        <h3></h3>
        <i class='fa fa-times closeButton' onclick='close_dialog(event)'></i>
      </div>
      <div class='replyTo'>
        @include('tweets/reply')
      </div>
      <div class='modal-body'>
        <div class='replying'>
          <span>Replying to @</span>
        </div>
        <div class='textarea'>
          <textarea class='form-control replyText' name='text' placeholder='Tweet your reply'></textarea>
        </div>
        <input class='inputReplyTo' type='hidden' name='replyTo' value=''>
      </div>
      <div class='modal-footer'>
        <span class='msg'><?php echo $msg; ?></span>
        <div>
          <ul class='icons'>
            <li><i class='fa fa-image'></i></li>
            <li><i class='fa fa-camera'></i></li>
            <li><i class='fa fa-map-o'></i></li>
            <li><i class='fa fa-map-marker'></i></li>
          </ul>
          <button class='btn btn-default addButton'><i class='fa fa-plus'></i></button>
          <!--button class='btn btn-primary replyButton' onclick='post_reply()'>Reply</button-->
          <input class='btn btn-primary replyButton' type='submit' value='Reply'>
        </div>
      </div>
    </form>
</div>


<script>
function close_reply_dialog(e) {
  console.log('close_dialog()');
  var classList = e.target.classList.toString();
  if(classList.indexOf('replyDialog') > -1 || classList.indexOf('closeButton') > -1) {
    replyTo = {};
    _('.replyDialog').style.display = 'none';
  }
}

function open_reply_dialog(id) {
  console.log('open_reply_dialog('+id+')');
  if(!auth) {
    window.location.href = '/login';
    return;
  }
  // get this tweet data
  for(t of tweets) {
    console.log('t.id='+t.id+'/id='+id);
    if(t.id === id) {
      replyTo = t;
      break;
    }
  }
  console.log('replyTo='+JSON.stringify(replyTo));
  set_reply_data('.replyDialog .reply', replyTo);
  $('.replyDialog .replying').html('Replying to @'+replyTo.username);
  // set data
  var dialog = _('.replyDialog');
  var name = (replyTo.name) ? reply.name : '';
  dialog.querySelector('h3').innerHTML = 'Reply to '+name+'@'+replyTo.username;
  dialog.querySelector('.inputReplyTo').value = replyTo.id;
  dialog.style.display = 'block';
}

function set_reply_data(id, data) {
  var r = $(id);
  // set name, username and tweet
  r.attr('id', 'reply-'+data.id);
  r.attr('onclick', 'open_replies(event, '+data.id+')');

  r.find('span.name').html(data.name);
  r.find('span.username').html('@'+data.username);
  r.find('.content > p').html(data.tweet);
  // set replyIcon
  r.find('.replyIcon').attr('onclick', 'open_reply_dialog('+data.id+')');

  // set likeIcon
  r.find('.likeIcon').attr('onclick', 'post_like('+data.id+')');
  r.find('.likeIcon span').html(data.likes);
  if(data.liked) r.find('.likeIcon i').addClass('active');
  else r.find('.likeIcon i').removeClass('active');
  // set retweetIcon
  r.find('.retweetIcon').attr('onclick', 'post_retweet('+data.id+')');
  r.find('.retweetIcon span').html(data.retweets);
  if(data.retweeted) r.find('.retweetIcon i').addClass('active');
  else r.find('.retweetIcon i').removeClass('active');
  // set replying parent link
  if(data.replyTo.length > 0) {
    data.replyTo = JSON.parse(data.replyTo);
    if(data.replyTo.id) {
      console.log('data.replyTo='+JSON.stringify(data.replyTo));
      r.find('.replyingTo').attr('onclick', 'open_replied(event, '+data.replyTo.id+')');
      r.find('.replying span').html('Replying to @'+data.replyTo.username);
      r.find('.replyingTo').show();
    }
  } else {
    r.find('.replyingTo').hide();
  }
}

</script>
