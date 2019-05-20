<?php

namespace App\Http\Controllers;

use Auth;
use App\Like;
use App\Retweet;
use App\Tweet;
use App\User;
use App\Relationship;

function update_user_tweets($userId) {
  // count tweets
  $count = Tweet::where('userId', $userId)->count();
  $user = User::find($userId);
  $user->tweets = $count;
  $user->save();
}

function check_tweets_by_auth($tweets) {
    if(Auth::check()) {
      $auth = Auth::user();
      foreach($tweets as $t) {
        // check liked or not
        //$l = $th->loadModel('Likes')->find()->where(['userId' => $auth['id'], 'tweetId' => $t->id, 'boolean' => true])->first();
        $l = Like::where(['userId' => $auth['id'], 'tweetId' => $t->id, 'boolean' => true])->first();
        if(isset($l)) {
          $t->liked = 1;
        } else {
          $t->liked = 0;
        }
        // check retweeted or not
        //$r = $th->loadModel('Retweets')->find()->where(['userId' => $auth['id'], 'tweetId' => $t->id, 'boolean' => true])->first();
        $r = Retweet::where(['userId' => $auth['id'], 'tweetId' => $t->id, 'boolean' => true])->first();
        if(isset($r)) {
          $t->retweeted = 1;
        } else {
          $t->retweeted = 0;
        }
      }
    }
    return $tweets;
}

function check_profile_by_auth($profile) {
    if(Auth::check()) {
      $authId = Auth::user()->id;
      $count = Relationship::where(['follower' => $authId, 'followed' => $profile->id, 'boolean' => true])->count();
      if(isset($count) && $count > 0) $profile->followed = 1;
    }
    return $profile;
}

function convert_replyTo($tweets) {
  foreach($tweets as $t) {
    if(isset($t->replyTo)) {
      //$un = $th->loadModel('Tweets')->find()->where(['id' => $t->replyTo])->select('username')->first();
      $un = Tweet::where(['id' => $t->replyTo])->select('username')->first();
      $t->replyTo = json_encode(array('id' => $t->replyTo, 'username' => $un['username']));
    }
  }
  return $tweets;
}

function get_avatars($tweets) {
  foreach($tweets as $t) {
    $avatar = User::where('id', $t->userId)->pluck('avatar')->first();
    $t->avatar = $avatar;
  }
  return $tweets;
}
