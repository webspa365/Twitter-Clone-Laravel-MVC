<script>
function open_menu(t) {
  //console.log(t.children.length);
  _('.replies').style.display = 'none';
  var menu = t.children[1];
  if(menu.style.display === 'none') menu.style.display = 'inline-block';
  else menu.style.display = 'none';
}

function post_like(id) {
  console.log('post_like('+id+')');
  $.ajax({
    url: '/likes/',
    type: 'POST',
    data: {"_token": "{{ csrf_token() }}", id: id},
    success: function(res) {
      console.log(JSON.stringify(res));
      if(res.success) {
        var tweet = $('.tweet-'+id);
        tweet.find('.likeIcon span').html(res.tweetLikes);
        if(res.liked) tweet.find('.likeIcon i').addClass('active');
        else tweet.find('.likeIcon i').removeClass('active');

        // update profile likes
        if(auth) {
          var username = tweet.attr('username');
          if(username === auth.username) {
            $('.profile-likes').html(res.userLikes);
          }
        }

      }
    }
  });
}

function post_retweet(id) {
  console.log('post_retweet('+id+')');
  $.ajax({
    url: '/retweets/',
    type: 'POST',
    data: {"_token": "{{ csrf_token() }}", id: id},
    success: function(res) {
      console.log(JSON.stringify(res));
      if(res.success) {
        var tweet = $('.tweet-'+id);
        tweet.find('.retweetIcon span').html(res.tweetRetweets);
        if(res.retweeted) tweet.find('.retweetIcon i').addClass('active');
        else tweet.find('.retweetIcon i').removeClass('active');
      }
    }
  });
}
</script>
