<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Relationship;
use App\User;

class RelationshipController extends Controller
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
        error_log('RelationshipController@store $req->id='.$req->id);
        if(!Auth::check()) {
          return response()->json(['success' => false]);
        } else {
          $auth = Auth::user();
        }

        $authId = $auth->id;
        $userId = $req->id;
        if(!isset($authId) || !$userId) return response()->json(['success' => false]);

        $followed = false;
        $follow = Relationship::where('follower', $authId)->where('followed', $userId)->first();
        if(!isset($follow)) {
          error_log('new follow');
          $follow = new Relationship;
          $follow->follower = $authId;
          $follow->followed = $userId;
          $follow->boolean = true;
          $follow->save();
          $followed = true;
        } else {
          if(!$follow->boolean) {
            error_log('follow');
            $follow->boolean = true;
            $follow->save();
            $followed = true;
          } else {
            error_log('unfollow');
            $follow->boolean = false;
            $follow->save();
            $followed = false;
          }
        }

        error_log('update counts');
        $following = Relationship::where('follower', $authId)->where('boolean', true)->count();
        $user = User::find($authId);
        $user->following = $following;
        $user->save();
        $followers = Relationship::where('followed', $userId)->where('boolean', true)->count();
        $user = User::find($userId);
        $user->followers = $followers;
        $user->save();

        return response()->json([
          'success' => true, 'authFollowing' => $following, 'profileFollowers' => $followers, 'followed' => $followed
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
