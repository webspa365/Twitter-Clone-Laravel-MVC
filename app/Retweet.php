<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retweet extends Model
{
    protected $table = 'retweets';

    protected $fillable = [
      'userId', 'tweetId', 'boolean'
    ];

    protected $attributes = [
      'username' => ''
    ];
}

/*
public function up()
{
    Schema::create('retweets', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('userId');
        $table->integer('tweetId');
        $table->string('username');
        $table->boolean('boolean');
        $table->timestamps();
    });
}
*/
