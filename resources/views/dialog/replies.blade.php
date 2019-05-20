@include('dialog/replies-style')
<?php
  $msg = '';
?>
<div class='replies' onclick='close_replies(event)'>
    <div class='wrapper'>
      <div class='replied'>
        <!--Tweet v-if='this.$store.state.replied' :data='this.$store.state.replied' /-->
        <!--?= $this->element('../Tweets/reply'); ?-->
        <!--div v-else class='notFound' style='color: #888'><?php echo $msg; ?>t</div-->
        @include('tweets/reply')
      </div>
      <div class='header'>
        <div class='input'>
          <input class='form-control' placeholder='Tweet your reply'>
          <i class='fa fa-image'></i>
        </div>
        <div class='avatar'>
          <!--img src=''-->
          <i class='fa fa-user'></i>
        </div>
      </div>
      <div class='body'>
        <ul>
          <!--li v-for='reply in this.$store.state.replies'><Tweet :data='reply' /></li-->
          <li>

          </li>
        </ul>
      </div>
      <div class='footer'>
        <span>Show more replies</span>
      </div>
    </div>
</div>
<script>
function close_replies(e) {
  var classList = e.target.classList.toString();
  if(classList.indexOf('replies') > -1 || classList.indexOf('closeButton') > -1) {
    //this.msg = '';
    $('.replies .body ul').html('');
    _('.replies').style.display = 'none';
  }
}

function open_replies(e, parentId) {
  classList = e.target.classList.toString();
  console.log('open_replies(e, '+parentId+') classList='+classList);
  if(classList.indexOf('fa') > -1 || classList.indexOf('replying') > -1 || classList.indexOf('menuItem') > -1) {
    return;
  } else {
    _('.replies').style.display = 'block';
    _('.replies .body ul').innerHTML = '';
  }

  get_parent_of_replies(parentId);
  get_replies(parentId);
}

function open_replied(e, parentId) {
  classList = e.target.classList.toString();
  console.log('open_replies('+parentId+') classList='+classList);
  if(classList.indexOf('fa') > -1) {
    return;
  } else {
    _('.replies').style.display = 'block';
    _('.replies .body ul').innerHTML = '';

  }

  get_parent_of_replies(parentId);
  get_replies(parentId);
}

function get_parent_of_replies(parentId) {
  var reply = $('.replies .reply');
  reply.attr('id', 'reply-'+parentId);
  // get data
  for(var t of tweets) {
    if(t.id === parseInt(parentId)) {
      set_reply_data('#reply-'+parentId, t);
      break;
    }
  }
}

function get_replies(parentId) {
  $.ajax({
    url: '/replies',
    type: 'GET',
    data: {"_token": "{{ csrf_token() }}", parentId: parentId},
    success: function(res) {
      console.log(JSON.stringify(res));
      if(res.success) {
        var replies = res.replies;
        var ul = $('.replies .body ul');
        for(var r of replies) {
          var clone = $('.replies .reply').clone();
          clone = '<li class="reply" id="reply-'+r.id+'">'+clone.html()+'</li>';
          ul.append(clone);
          set_reply_data('#reply-'+r.id, r);
          console.log('ul.append(clone); done');
        }
      }
    }
  });
}


</script>
