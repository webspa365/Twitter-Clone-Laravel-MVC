<?php
  $retweeted = '';
  if($tweet->retweeted === 1) $retweeted = 'active';
  $liked = '';
  if($tweet->liked === 1) $liked = 'active';

  $auth = '';
  if(Auth::check()) $auth = Auth::user();

  $avatar = '';
  if($tweet->avatar) $avatar = '/storage/media/'.$tweet->userId.'/avatar/thumbnail.'.$tweet->avatar;

  $replyTo = array();
  if($tweet->replyTo) $replyTo = json_decode($tweet->replyTo);
?>
<div class="{{'tweet tweet-'.$tweet->id}}" username={{$tweet->username}} onclick='open_replies(event, {{$tweet->id}})'>
  @if($tweet->retweetedBy)
    <div v-if='$tweet->retweetedBy !== ""' class='retweeted'>
      <i class='fa fa-retweet'></i> {{'@'.$tweet->retweetedBy}} retweeted
    </div>
  @endif
  @if(isset($replyTo->username))
    <div class='replyingTo replying'>
      <span class='replying' onclick='open_replied(event, {{$replyTo->id}})'>
        Replying to {{'@'.$replyTo->username}}
      </span>
    </div>
  @endif
  <a class='avatar' href={{'/profile/tweets/'.$tweet->userId}}>
    @if(isset($tweet->avatar))
      <img class='avatarImg' src={{$avatar}} onerror="this.style.display='none'" />
    @else
      <i class='fa fa-user'></i>
    @endif
  </a>
  <div class='info'>
    <span class='name'>{{$tweet->name}}</span>
    <span class='username'>
      <a href={{'/profile/tweets/'.$tweet->userId}}>{{'@'.$tweet->username}}</a>
    </span>
    <span class='date'>・</span>
    <div class='toggle' onclick='open_menu(this)'>
      @if(!$tweet->retweetedBy)
        <i class='fa fa-angle-down'></i>
        @include('tweets/tweetMenu', ['id' => 'tweetMenu-'.$tweet->id, 'tweetId' => $tweet->id])
      @endif
      <!--TweetMenu v-show='menu' :$tweet='$tweet' /-->
    </div>
  </div>
  <div class='content'>
    <p>{{$tweet->tweet}}</p>
  </div>
  <div class='icons'>
    <div class='replyIcon' onclick='open_reply_dialog({{$tweet->id}})'>
      <i class='fa fa-comment-o'></i>
      <span class='span'>{{$tweet->replies}}</span>
    </div>
    <div class='retweetIcon' onclick='post_retweet({{$tweet->id}})'>
      <i class="{{'fa fa-retweet '.$retweeted}}"></i>
      <span class='span'>{{$tweet->retweets}}</span>
    </div>
    <div class='likeIcon' onclick='post_like({{$tweet->id}})'>
      <i class="{{'fa fa-heart-o '.$liked}}"></i>
      <span class='span'>{{$tweet->likes}}</span>
    </div>
    <div class='chartIcon'>
      <i class='fa fa-bar-chart'></i>
    </div>
  </div>
  <script>
    var tweet = <?php echo $tweet; ?>;
    var date = from_now(new Date(tweet.created_at).getTime());
    $('.tweet-'+tweet.id).find('.date').html('・'+date);

  </script>
</div>

@include('tweets/tweet-style')
