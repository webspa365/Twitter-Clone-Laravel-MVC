<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Like;
use App\Tweet;
use App\User;

class LikeController extends Controller
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
        error_log('LikeController@store $req->id='.$req->id);
        if(!Auth::check()) {
          return response()->json(['success' => false]);
        } else {
          $auth = Auth::user();
        }

        if(!isset($auth->id) || !isset($req->id)) return response()->json(['success' => false]);
        $userId = $auth->id;
        $tweetId = $req->id;

        $like = Like::where('userId', $userId)->where('tweetId', $tweetId)->first();
        $liked = false;

        if(!isset($like)) {
          error_log('new like');
          $like = new Like;
          $like->userId = $userId;
          $like->tweetId = $tweetId;
          $like->boolean = true;
          $like->save();
          $liked = true;
        } else {
          if(!$like->boolean) {
            error_log('like');
            $like->boolean = true;
            $like->save();
            $liked = true;
          } else {
            error_log('unlike');
            $like->boolean = false;
            $like->save();
            $liked = false;
          }
        }

        error_log('update counts');
        $userLikes = Like::where('userId', $userId)->where('boolean', true)->count();
        $user = User::find($userId);
        $user->likes = $userLikes;
        $user->save();
        $tweetLikes = Like::where('tweetId', $tweetId)->where('boolean', true)->count();
        $tweet = Tweet::find($tweetId);
        $tweet->likes = $tweetLikes;
        $tweet->save();

        return response()->json([
          'success' => true, 'userLikes' => $userLikes, 'tweetLikes' => $tweetLikes, 'liked' => $liked
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
