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

class TimelineController extends Controller
{
    public function get_timeline(Request $req) {
      if(Auth::check() === false) {
        // get tweets
        $tweets = Tweet::orderBy('created_at', 'desc')->get();

        // get avatars
        $tweets = get_avatars($tweets);

        return view('home/home', ['tweets' => $tweets]);

      } else {
        // if user is logged in
        // get tweets by auth and following
        $auth = Auth::user();
        $ids = array($auth->id);
        $rows = Relationship::where(['follower' => $auth['id']])->orderBy('created_at', 'desc')->limit(100)->get();
        foreach($rows as $r) {
          array_push($ids, $r->followed);
        }
        $tweets = Tweet::whereIn('userId', $ids)->orderBy('created_at', 'desc')->limit(100)->get();

        // get retweets
        $rows = Retweet::whereIn('userId', $ids)->where('boolean', true)->limit(100)->get();
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

        return view('home/home', ['tweets' => $tweets]);
      }
    }
}
