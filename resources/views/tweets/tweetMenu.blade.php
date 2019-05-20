<?php
  $delete = true;
?>
<div class='tweetMenu' id={{$id}}>
  <div><div></div></div>
  <ul>
    <li class='menuItem'>Pin to your profile page</li>
    <li class='menuItem'>Report Tweet</li>
    @if($delete)
      <li class='menuItem' onclick='open_delete_dialog({{$tweetId}})'>Delete Tweet</li>
    @endif
  </ul>
</div>
@include('tweets/tweetMenu-style')

<script>
var id = "<?php echo $id ?>";
_id(id).style.display = 'none';


</script>
