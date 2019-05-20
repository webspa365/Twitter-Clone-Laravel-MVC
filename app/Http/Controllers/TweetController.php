<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use App\Like;
use App\Retweet;
use Illuminate\Support\Facades\Auth;

include app_path().'/Http/Controllers/functions.php';

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        error_log('TweetController@store $req->tweet='.$req->tweet);
        $this->validate($req, [
          'userId' => 'nullable',
          'username' => 'nullable',
          'tweet' => 'required|string|max:1024'
        ]);
        if(Auth::check() === false) return view('auth/logIn');
        $auth = Auth::user();
        $tweet = new Tweet;
        $tweet->userId = $auth->id;
        $tweet->username = $auth->username;
        $tweet->tweet = $req->tweet;
        $tweet->save();

        update_user_tweets($auth->id);

        return redirect('profile/tweets/'.$auth->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $req
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        error_log('TweetController@destroy $id='.$id);

        $auth = Auth::user();
        if(!isset($auth)) return response()->json(['success' => false]);

        $tweet = Tweet::find($id);
        if($auth->id !== $tweet->userId) {
          return response()->json(['success' => false]);
        } else {
          // delete all likes by tweet
          $likes = Like::where('tweetId', $tweet->id)->get();
          if(isset($likes)) {
            foreach($likes as $l) {
              $l->delete();
            }
          }

          // delete all retweets by tweet
          $retweets = Retweet::where('tweetId', $tweet->id)->get();
          if(isset($retweets)) {
            foreach($retweets as $r) {
              $r->delete();
            }
          }
          // delete tweet
          $tweet->delete();

          update_user_tweets($auth->id);

          return response()->json(['success' => true]);
        }


        //return response()->json(['success' => true]);
        //return view('profile/profile');
    }
}
