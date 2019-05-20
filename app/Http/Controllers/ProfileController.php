<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Tweet;
use App\Like;
use App\Retweet;
use App\Relationship;

include app_path().'/Http/Controllers/functions.php';

class ProfileController extends Controller
{
    public function get_tweets(Request $req, $un) {
      $profile = User::where('username', $un)->first();
      $profile = check_profile_by_auth($profile);

      $tweets = Tweet::where('userId', $profile->id)->orderBy('created_at', 'desc')->limit(100)->get();
      if(count($tweets) === 0) {
        return view('profile/profile', ['profile' => $profile, 'tweets' => $tweets]);
      }

      foreach($tweets as $t) {
        $t->time = strtotime($t->created_at);
      }

      // get retweets
      $rows = Retweet::where('userId', $profile->id)->where('boolean', true)->limit(100)->get();
      if(isset($rows)) {
        foreach($rows as $r) {
          $retweet = Tweet::find($r->tweetId);
          if(isset($retweet)) {
            $retweet->time = strtotime($r->updated_at);
            $retweet->retweetedBy = User::find($r->userId)->username;
            $tweets->push($retweet);
          }
        }
      }

      $tweets = check_tweets_by_auth($tweets);
      $tweets = convert_replyTo($tweets);
      $tweets = get_avatars($tweets);
      $tweets = $tweets->sortByDesc('time');

      return view('profile/profile', ['profile' => $profile, 'tweets' => $tweets]);
    }



    public function get_followers(Request $req, $un) {
      $profile = User::where('username', $un)->first();
      $profile = check_profile_by_auth($profile);

      $users = collect([]);
      $rows = Relationship::where('followed', $profile->id)->get();
      if(isset($rows)) {
        foreach($rows as $r) {
          $user = User::find($r->follower);
          $users->push($user);
        }
        if(Auth::check()) {
          $authId = Auth::user()->id;
          foreach($users as $u) {
            $c = Relationship::where('follower', $authId)->where('followed', $u->id)->where('boolean', true)->count();
            if($c > 0) $u->followed = 1;
          }
        }
      }
      return view('profile/profile', ['profile' => $profile, 'users' => $users]);
    }



    public function get_following(Request $req, $un) {
      $profile = User::where('username', $un)->first();
      $profile = check_profile_by_auth($profile);

      $users = collect([]);
      $rows = Relationship::where('follower', $profile->id)->get();
      if(isset($rows)) {
        foreach($rows as $r) {
          $user = User::find($r->followed);
          $user->followed = 1;
          $users->push($user);
        }
      }
      return view('profile/profile', ['profile' => $profile, 'users' => $users]);
    }



    public function get_likes(Request $req, $un) {
      $profile = User::where('username', $un)->first();
      $profile = check_profile_by_auth($profile);

      $likes = Like::where('userId', $profile->id)->where('boolean', true)->limit(100)->get();
      if(!isset($likes)) {
        return view('profile/profile', ['profile' => $profile, 'tweets' => []]);
      } else {
        $tweets = collect([]);
        foreach($likes as $l) {
          $t = Tweet::find($l->tweetId);
          $t->time = strtotime($l->updated_at);
          //array_push($tweets, $t->toArray);
          $tweets->push($t);
          error_log($t);
        }
      }

      // check by auth
      $tweets = check_tweets_by_auth($tweets);
      $tweets = $tweets->sortByDesc('time');

      // get avatars
      $tweets = get_avatars($tweets);

      return view('profile/profile', ['profile' => $profile, 'tweets' => $tweets]);
    }
}



/*
function check_tweets_by_auth($profileId, $tweets) {
  if(Auth::check()) {
    $authId = Auth::user()->id;
    if($authId === $profileId) { // current profile user is auth user
      // check liked or not
      foreach($tweets as $t) {
        $c = Like::where('userId', $authId)->where('tweetId', $t->id)->where('boolean', true)->count();
        if($c > 0) $t->liked = 1;
        else $t->liked = 0;
        $c = Retweet::where('userId', $authId)->where('tweetId', $t->id)->where('boolean', true)->count();
        if($c > 0) $t->retweeted = 1;
        else $t->retweeted = 0;
      }
    }
  }
  return $tweets;

}*/
