@include('home/timeline-style')
@include('tweets/tweet-style')
@include('tweets/tweet-functions')
<?php
  //$tweets = array();
?>
<div class='timeline'>
  <?php if(isset($tweets)) : ?>
    <ul>
      <?php foreach($tweets as $t) : ?>
        <li>
          @include('tweets/tweet', ['tweet' => $t])
        </li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>
</div>

<script>
var tweets = <?php echo json_encode($tweets); ?>;
</script>
