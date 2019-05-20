<?php
  $authId = -1;
  if(Auth::check()) {
    $authId = Auth::user()->id;
  }

?>
<div class='deleteDialog' id='deleteDialog' onclick='close_dialog(event)'>
  <div class='dialog_wrapper'>
    <div class='header'>
      Delete tweet?
    </div>
    <div class='body'>
      <h6></h6>
      <p></p>
      <div class='msg'></div>
    </div>
    <div class='footer'>
      <button class='button btn-danger deleteButton' onclick='delete_tweet()'>Delete</button>
      <button class='button btn btn-default closeButton' onclick='close_dialog(event)'>Cancel</button>
    </div>
  </div>
</div>
@include('dialog/deleteDialog-style')

<script>
var authId = "<?php echo $authId; ?>";
var deleteDialog;

function open_delete_dialog(tweetId) {
  console.log(tweetId);
  var tweet;
  for(var t of tweets) {
    if(t.id === tweetId) {
      deleteDialog = t;
    }
  }
  var dialog = _('.deleteDialog');
  dialog.style.display = 'block';
  dialog.querySelector('body h6').innerHTML = '@'+deleteDialog.username;
  dialog.querySelector('body p').innerHTML = deleteDialog.tweet;
}

function close_dialog(e) {
  var list = e.target.classList.toString();
  if(list.indexOf('deleteDialog') > -1 || list.indexOf('closeButton') > -1) {
    _id('deleteDialog').style.display = 'none';
  }
}

function delete_tweet() {
  $.ajax({
    url: '/tweets/'+deleteDialog.id,
    type: 'DELETE',
    data: {"_token": "{{ csrf_token() }}"},
    success: function(res) {
      console.log(JSON.stringify(res));
      if(res.success && authId) {
        window.location.href = '/profile/tweets/'+authId;
      }
    }
  });
}
</script>
