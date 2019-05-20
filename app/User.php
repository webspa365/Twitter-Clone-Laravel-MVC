<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $attributes = [
        'name' => '',
        'bio' => '',
        'bg' => '',
        'avatar' => '',
        'tweets' => 0,
        'followers' => 0,
        'following' => 0,
        'likes' => 0,
        'retweets' => 0,
        'followed' => false,
    ];
}

/*
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
        $table->string('username')->unique();
        $table->string('email')->unique();
        $table->string('password');
        $table->string('name');
        $table->string('bio');
        $table->string('bg');
        $table->string('avatar');
        $table->integer('tweets');
        $table->integer('following');
        $table->integer('followers');
        $table->integer('likes');
        $table->integer('retweets');
        $table->boolean('followed');
        $table->rememberToken();
        $table->timestamps();
    });
}
*/
