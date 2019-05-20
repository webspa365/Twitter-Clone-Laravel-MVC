<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Reply;
use App\Tweet;
use App\User;

include app_path().'/Http/Controllers/functions.php';

class ReplyController extends Controller
{
    public function store(Request $req) {
        error_log('ReplyController store() $req->replyTo='.$req->replyTo);
        if(Auth::check() === false) return redirect('/login');

        // save as tweet
        $auth = Auth::user();
        $tweet = new Tweet;
        $tweet->userId = $auth->id;
        $tweet->username = $auth->username;
        $tweet->tweet = $req->text;
        $tweet->replyTo = $req->replyTo;
        $tweet->save();

        update_user_tweets($auth->id);

        // save as reply
        error_log('after $tweet->save() $tweet->id='.$tweet->id);
        $reply = new Reply;
        $reply->replyId = $tweet->id;
        $reply->replyTo = $req->replyTo;
        $reply->save();

        return redirect('profile/tweets/'.$auth->id);
    }



    public function replies(Request $req) {
        error_log('ReplyController replies() $req->parentId='.$req->parentId);
        $ids = array();
        $rows = Reply::where(['replyTo' => $req->parentId])->get();
        //error_log('ReplyController $rows='.json_encode($rows));
        if(isset($rows)) {
          foreach($rows as $r) {
            array_push($ids, $r->replyId);
          }
        }
        $replies = Tweet::whereIn('id', $ids)->get();
        $replies = check_tweets_by_auth($replies);
        $replies = convert_replyTo($replies);
        error_log('ReplyController $replies='.json_encode($replies));

        if(isset($replies)) return response()->json(['success' => true, 'replies' => $replies]);
        else return response()->json(['success' => false]);
    }
}
