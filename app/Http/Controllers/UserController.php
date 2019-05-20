<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
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
        //
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
    public function update(Request $req, $un)
    {
        error_log('UserController@update');
        error_log('$req='.$req->email);

        // get auth user
        $auth = Auth::user();
        if(!isset($auth)) {
          error_log('isset($auth) === false');
          return view('/profile/editProfile');
        }

        // get user to edit
        $user = User::where('username', $un)->first();
        if(!isset($user)) {
          error_log('isset($user) === false');
          return view('/profile/editProfile');
        }

        if($auth->id !== $user->id) {
          error_log('Error: Different user ids.');
        }

        // upload bg and avatar
        $this->validate($req, [
          'username' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'name' => 'nullable|string|max:255',
          'bio' => 'nullable|string|max:1024',
  	    	'bg' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048',
          'avatar' => 'nullable|mimes:jpeg,jpg,png,gif|max:2048', //only allow this type extension file.
    		]);

        if(isset($req->username)) $user->username = $req->username;
        if(isset($req->email)) $user->email = $req->email;
        if(isset($req->name)) $user->name = $req->name;
        if(isset($req->bio)) $user->bio = $req->bio;

        // upload bg
        $bg = $req->file('bg');
        if(isset($bg)) {
          $dir = 'storage/media/'.$auth->id.'/bg';
          $files = glob($dir.'/*');
          //error_log('$files='.json_encode($files));
          if(isset($files)) {
            foreach($files as $f) {
              unlink($f);
            }
          }
          $ext = $bg->extension();
    		  $path = $bg->move($dir, 'bg.'.$ext);
          $img = Image::make($path);
          if($img->height() < $img->width()/4) {
            $w = null;
            $h = 250;
          } else {
            $w = 1000;
            $h = null;
          }
          $img->resize($w, $h, function($constraint) {$constraint->aspectRatio();});
          $img->crop(1000, 250, null, 0);
          $img->backup();
          $img->save($dir.'/bg.'.$ext);
          $img->reset();
          $img->resize(300, 75);
          $img->save($dir.'/thumbnail.'.$ext);
          $user->bg = $ext;
        }

        // upload avatar
        $avatar = $req->file('avatar');
        if(isset($avatar)) {
          $dir = 'storage/media/'.$auth->id.'/avatar';
          $files = glob($dir.'/*');
          //error_log('$files='.json_encode($files));
          if(isset($files)) {
            foreach($files as $f) {
              unlink($f);
            }
          }
          $ext = $avatar->extension();
      		$path = $avatar->move($dir, 'avatar.'.$ext);
          error_log($path);
          $img = Image::make($path);
          if($img->width() > $img->height()) {
            $w = null;
            $h = 150;
          } else {
            $w = 150;
            $h = null;
          }
          $img->resize($w, $h, function($constraint) {$constraint->aspectRatio();});
          $img->crop(150, 150);
          $img->backup();
          $img->save($dir.'/avatar.'.$ext);
          $img->reset();
          $img->resize(75, 75);
          $img->save($dir.'/thumbnail.'.$ext);
          $user->avatar = $ext;
        }

        $user->save();

        //return response()->json(['success' => true, 'user' => $user]);
        return view('profile/profile', ['profile' => $user]);
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
