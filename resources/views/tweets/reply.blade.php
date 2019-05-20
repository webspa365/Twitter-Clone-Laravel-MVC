@include('tweets/reply-style')
<div class='reply' id='' onclick=''>
  <div class='replyingTo replying'>
      <span class='replying'></span>
  </div>
  <a class='avatar' href='/profile/tweets/username'>
      <!--img class='avatarImg' src='' /-->
      <i class='fa fa-user'></i>
  </a>
  <div class='info'>
    <span class='name'></span>
    <span class='username'>
      <a href='/profile/tweets/username'></a>
    </span>
    <span class='date'>・</span>
  </div>
  <div class='content'>
    <p class='replyText'>reply text</p>
  </div>
  <div class='icons'>
    <div class='replyIcon' onclick=''>
      <i class='fa fa-comment-o'></i>
      <span>0</span>
    </div>
    <div class='retweetIcon' onclick=''>
      <i class='fa fa-retweet '></i>
      <span>0</span>
    </div>
    <div class='likeIcon' onclick=''>
      <i class='fa fa-heart-o '></i>
      <span>0</span>
    </div>
    <div class='chart'>
      <i class='fa fa-bar-chart'></i>
    </div>
  </div>
  <script>
  /*
    var date = get_now(new Date(tweet.created_at).getTime());
    $('.tweet-'+tweet.id).find('.date').html('・'+date);
  */
  </script>
</div>

<script>
/*
function set_reply_data(replyId, data) {
  var t = $(replyId);
  // set name
  t.find('span.name').html(data.name);
  t.find('span.username').html(data.username);
  t.find('content > p').html(data.tweet);
}
*/
</script>
