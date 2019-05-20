<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Retweet;
use App\Tweet;
use App\User;

class RetweetController extends Controller
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
        error_log('RetweetController@store $req->id='.$req->id);
        if(!Auth::check()) {
          return response()->json(['success' => false]);
        } else {
          $auth = Auth::user();
        }

        if(!isset($auth->id) || !isset($req->id)) return response()->json(['success' => false]);
        $userId = $auth->id;
        $tweetId = $req->id;

        $retweet = Retweet::where('userId', $userId)->where('tweetId', $tweetId)->first();
        $retweeted = false;

        if(!isset($retweet)) {
          error_log('new retweet');
          $retweet = new Retweet;
          $retweet->userId = $userId;
          $retweet->tweetId = $tweetId;
          $retweet->boolean = true;
          $retweet->save();
          $retweeted = true;
        } else {
          if(!$retweet->boolean) {
            error_log('retweet');
            $retweet->boolean = true;
            $retweet->save();
            $retweeted = true;
          } else {
            error_log('unretweet');
            $retweet->boolean = false;
            $retweet->save();
            $retweeted = false;
          }
        }

        error_log('update counts');
        $userRetweets = Retweet::where('userId', $userId)->where('boolean', true)->count();
        $user = User::find($userId);
        $user->retweets = $userRetweets;
        $user->save();
        $tweetRetweets = Retweet::where('tweetId', $tweetId)->where('boolean', true)->count();
        $tweet = Tweet::find($tweetId);
        $tweet->retweets = $tweetRetweets;
        $tweet->save();

        return response()->json([
          'success' => true, 'userRetweets' => $userRetweets, 'tweetRetweets' => $tweetRetweets, 'retweeted' => $retweeted
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
