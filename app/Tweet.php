<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $table = 'tweets';

    protected $fillable = [
      'userId', 'username', 'tweet'
    ];

    protected $attributes = [
      'replyTo' => '',
      'images' => '',
      'video' => '',
      'dir' => '',
      'replies' => 0,
      'retweets' => 0,
      'likes' => 0,
      'hashtags' => '',
      'liked' => false,
      'retweeted' => false,
      'retweetedBy' => '',
      'time' => 0
    ];
}

/*
public function up()
{
    Schema::create('tweets', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('userId');
        $table->string('username');
        $table->string('tweet');
        $table->string('replyTo');
        $table->string('images');
        $table->string('video');
        $table->string('dir');
        $table->integer('replies');
        $table->integer('retweets');
        $table->integer('likes');
        $table->string('hashtags');
        $table->boolean('liked');
        $table->boolean('retweeted');
        $table->string('retweetedBy');
        $table->integer('time');
        $table->timestamps();
    });
}


*/
