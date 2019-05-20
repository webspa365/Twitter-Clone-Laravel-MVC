@include('tweets/tweets-style')
@include('tweets/tweet-functions')
<?php
  $auth = '';
  if(Auth::check()) $auth = Auth::user();
?>
<div class='tweets'>
  <div class='header'>
    <ul class='tweets_ul'>
      <li class='li_tweets active' onclick='get_tweets()'>
        <router-link :to="'/profile?user='+this.username">Tweets</router-link>
      </li>
      <li class='li_replies' onclick='get_replies()'>
        <router-link :to="'/profile/replies?user='+this.username">Tweets & replies</router-link>
      </li>
      <li class='li_media' onclick='get_media()'>
        <router-link :to="'/profile/media?user='+this.username">Media</router-link>
      </li>
    </ul>
  </div>
  <div class='body'>
    <ul>
      <?php $arr = array(); ?>
      @foreach($tweets as $t)
        <li>
          @include('tweets/tweet', ['tweet' => $t])
          <?php array_push($arr, $t); ?>
        </li>
      @endforeach
    </ul>
  </div>
  <!--div class='footer' onclick='show_more()'>
    <span>Show more...</span>
  </div-->
  <div class='footer' onclick='back_to_top()'>
    <span>Back to Top</span>
  </div>
</div>
<script>
auth = <?php echo $auth; ?>;
tweets = <?php echo json_encode($arr); ?>;
/*
if(tweets) {

  var arr = [];
  for(var i=0; i<)
}*/
console.log('tweets='+JSON.stringify(tweets.length));

function back_to_top() {
  $([document.documentElement, document.body]).animate({
    scrollTop: $(".profile .nav ").offset().top
  }, 500);
}
</script>
